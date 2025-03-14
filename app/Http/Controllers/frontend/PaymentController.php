<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showPaymentMethod($id)
    {
        // Lấy thông tin ứng dụng từ database
        $app = App::findOrFail($id);

        // Lấy tất cả phương thức thanh toán từ database
        $paymentMethods = PaymentMethod::where('status', 1)->get();

        // Trả về view với dữ liệu
        return view('frontend.payment.payment_method', compact('paymentMethods', 'app'));
    }

    public function vnPay(Request $request)
    {
        $appId = $request->input('app_id');
        $appName = $request->input('app_name');
        $appPrice = $request->input('app_price');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.vnpay.return', ['app_id' => $appId]);
        $vnp_TmnCode = "9UK0JBZV";//Mã website tại VNPAY
        $vnp_HashSecret = "CNTUB3LHMHMF3Q1J7UQR6OJCXSE51FC5"; //Chuỗi bí mật

        $vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "ABC";
        $vnp_OrderType = "app_payment";
        $vnp_Amount = $appPrice * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            return redirect($vnp_Url);
        }
        // vui lòng tham khảo thêm tại code demo
    }

    public function vnPayReturn(Request $request, $app_id)
    {
        $inputData = $request->all();

        if (!isset($inputData['vnp_SecureHash'])) {
            return redirect()->route('home')->with('error', 'Lỗi xác thực thanh toán');
        }

        $vnp_HashSecret = "CNTUB3LHMHMF3Q1J7UQR6OJCXSE51FC5";
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHashCheck = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $userId = auth()->id();
        $amount = $inputData['vnp_Amount'] / 100;
        $transactionId = $inputData['vnp_TransactionNo'] ?? null;
        $status = ($secureHashCheck === $vnp_SecureHash && $inputData['vnp_ResponseCode'] == "00") ? 'success' : 'failed';

        try {
            DB::beginTransaction(); // Bắt đầu transaction

            $purchase = Purchase::create([
                'user_id' => $userId,
                'app_id' => $app_id,
                'amount' => $amount,
                'payment_status' => $status,
            ]);

            if (!$purchase) {
                throw new \Exception('Không thể tạo đơn hàng!');
            }

            // Đảm bảo transaction_id là duy nhất
            $newTransactionId = $transactionId ? $transactionId . '-' . time() : 'failed-' . time();

            Payment::create([
                'purchase_id' => $purchase->id,
                'payment_method' => 'VNPAY',
                'transaction_id' => $newTransactionId,
                'status' => $status,
            ]);

            DB::commit(); // Lưu thay đổi nếu không có lỗi
            Log::info('VNPAY Transaction', ['data' => $inputData]);

            return redirect()->route('payment.status', ['status' => $status])
                ->with($status === 'success' ? 'success' : 'error', $status === 'success' ? 'Thanh toán thành công!' : 'Thanh toán thất bại!');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác nếu có lỗi
            Log::error('Lỗi xử lý thanh toán VNPAY: ' . $e->getMessage());
            return redirect()->route('payment.status', ['status' => 'failed'])
                ->with('error', 'Có lỗi xảy ra khi xử lý giao dịch!');
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo(Request $request){
        $appId = $request->input('app_id');
        $appName = $request->input('app_name');
        $appPrice = $request->input('app_price');

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = (int) $appPrice;
        $orderId = time() ."";
        $redirectUrl = route('payment.momo.return', ['app_id' => $appId]);
        $ipnUrl = route('payment.momo.return', ['app_id' => $appId]);
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json


        return redirect()->to($jsonResult['payUrl']);

    }
    public function momoReturn(Request $request, $app_id)
    {
        $inputData = $request->all();

        if (!isset($inputData['signature'])) {
            return redirect()->route('home')->with('error', 'Lỗi xác thực thanh toán');
        }

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $amount = $inputData['amount'] ?? "";
        $orderId = $inputData['orderId'] ?? "";
        $transId = $inputData['transId'] ?? "";
        $resultCode = $inputData['resultCode'] ?? "";
        $receivedSignature = $inputData['signature'] ?? "";

        // Chuỗi rawHash đúng thứ tự MoMo yêu cầu
        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . ($inputData['extraData'] ?? "") .
            "&message=" . ($inputData['message'] ?? "") .
            "&orderId=" . $orderId .
            "&orderInfo=" . ($inputData['orderInfo'] ?? "") .
            "&orderType=" . ($inputData['orderType'] ?? "") .
            "&partnerCode=" . $partnerCode .
            "&payType=" . ($inputData['payType'] ?? "") .
            "&requestId=" . ($inputData['requestId'] ?? "") .
            "&responseTime=" . ($inputData['responseTime'] ?? "") .
            "&resultCode=" . $resultCode .
            "&transId=" . $transId;

        $secureHashCheck = hash_hmac("sha256", $rawHash, $secretKey);

        if ($secureHashCheck !== $receivedSignature) {
            Log::error('MoMo Signature Mismatch', [
                'calculated' => $secureHashCheck,
                'received' => $receivedSignature,
                'data' => $inputData
            ]);
            return redirect()->route('payment.status', ['status' => 'failed'])
                ->with('error', 'Xác thực chữ ký thất bại!');
        }

        $userId = auth()->id();
        $status = ($resultCode == "0") ? 'success' : 'failed';

        try {
            DB::beginTransaction(); // Bắt đầu transaction

            // Tạo đơn hàng
            $purchase = Purchase::create([
                'user_id' => $userId,
                'app_id' => $app_id,
                'amount' => (int) $amount,
                'payment_status' => $status,
            ]);

            if (!$purchase) {
                throw new \Exception('Không thể tạo đơn hàng!');
            }

            // Đảm bảo transaction_id là duy nhất
            $newTransactionId = $transId ? $transId . '-' . time() : 'failed-' . time();

            Payment::create([
                'purchase_id' => $purchase->id,
                'payment_method' => 'MoMo',
                'transaction_id' => $newTransactionId,
                'status' => $status,
            ]);

            DB::commit(); // Lưu thay đổi nếu không có lỗi
            Log::info('MoMo Transaction', ['data' => $inputData]);

            return redirect()->route('payment.status', ['status' => $status])
                ->with($status === 'success' ? 'success' : 'error', $status === 'success' ? 'Thanh toán thành công!' : 'Thanh toán thất bại!');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác nếu có lỗi
            Log::error('Lỗi xử lý thanh toán MoMo: ' . $e->getMessage());
            return redirect()->route('payment.status', ['status' => 'failed'])
                ->with('error', 'Có lỗi xảy ra khi xử lý giao dịch!');
        }
    }
    public function momoQr(Request $request){
        $appId = $request->input('app_id');
        $appName = $request->input('app_name');
        $appPrice = $request->input('app_price');

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = (int) $appPrice;
        $orderId = time() ."";
        $redirectUrl = route('payment.momo.return', ['app_id' => $appId]);
        $ipnUrl = route('payment.momo.return', ['app_id' => $appId]);
        $extraData = "";

        $requestId = time() . "";
        //$requestType = "payWithATM";
        $requestType = "captureWallet";
        //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json


        return redirect()->to($jsonResult['payUrl']);

    }
    public function paymentStatus($status)
    {
        return view('frontend.payment.payment_status', compact('status'));
    }

}
