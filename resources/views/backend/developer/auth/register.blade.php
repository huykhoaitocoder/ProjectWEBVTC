@extends('frontend.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="form-container p-5" style="max-width: 800px; width: 100%; background: white; border-radius: 12px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-top: -304px;">
        <h2 class="text-center mb-4" style="padding-bottom: 24px;">Đăng ký Developer</h2>

        <div class="progress mb-4" style="height: 12px;">
            <div class="progress-bar bg-primary" id="progressBar" style="width: 25%;"></div>
        </div>

        <form id="developerForm">
            <div id="step1">
                <h4>Đầu tiên, nhập tên Developer</h4>
                <input type="text" name="name" id="developer_name" class="form-control form-control-lg mt-4" maxlength="50" placeholder="Tên hiển thị trên VH APK" required>
                <small id="nameError" class="text-danger mt-3"></small>
                <div class="mt-5 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-lg px-5" id="continueBtn" onclick="nextStep(2)" disabled>Tiếp tục</button>
                </div>
            </div>

            <div id="step2" style="display: none;">
                <h4>Xác thực Email</h4>
                
                <input type="email" name="email" id="email" class="form-control form-control-lg mt-4" placeholder="Email" required>
                
                <button type="button" class="btn btn-secondary mt-2" onclick="sendOTP()" id="sendOtpBtn">Gửi mã xác thực</button>
                
                <input type="text" id="otp" class="form-control form-control-lg mt-2" placeholder="Nhập mã OTP" disabled>
                
                <button type="button" class="btn btn-success mt-2" onclick="verifyOTP()" id="verifyOtpBtn" disabled>Xác thực</button>

                <small id="emailStatus" class="text-success mt-2"></small>

                <div class="mt-5 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-lg px-5" onclick="prevStep(1)">Quay lại</button>
                    <button type="button" class="btn btn-primary btn-lg px-5" id="toStep3Btn" onclick="nextStep(3)" disabled>Tiếp tục</button>
                </div>
            </div>


            <div id="step3" style="display: none;">
                <h4>Nhập hồ sơ Developer</h4>

                <input type="text" name="full_name" id="full_name" class="form-control form-control-lg mt-4" placeholder="Họ và tên đầy đủ" required>
                <input type="text" name="phone" id="phone" class="form-control form-control-lg mt-4" placeholder="Số điện thoại" required>
                <input type="text" name="address" id="address" class="form-control form-control-lg mt-4" placeholder="Địa chỉ" required>
                <input type="url" name="website" class="form-control form-control-lg mt-4" placeholder="Website (nếu có)">

                <div class="mt-5 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-lg px-5" onclick="prevStep(2)">Quay lại</button>
                    <button type="button" class="btn btn-primary btn-lg px-5" id="toStep4Btn" onclick="nextStep(4)" disabled>Tiếp tục</button>
                </div>
            </div>

            <div id="step4" style="display: none;">
                <h4>Bước cuối cùng,</h4>
                <p class="mt-4">Vui lòng đồng ý điều khoản để tiếp tục.</p>
                <div class="border p-3 mb-3" style="max-height: 200px; overflow-y: auto; background-color: #f8f9fa;">
                    <p><strong>1. Điều kiện sử dụng</strong><br>
                        Bạn đồng ý không sử dụng dịch vụ cho mục đích vi phạm pháp luật hoặc phát tán nội dung không phù hợp.</p>

                    <p><strong>2. Trách nhiệm của người dùng</strong><br>
                        Bạn chịu trách nhiệm hoàn toàn về nội dung ứng dụng mà bạn tải lên hoặc phân phối.</p>

                    <p><strong>3. Bảo mật</strong><br>
                        Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn, nhưng bạn cũng cần giữ an toàn tài khoản của mình.</p>

                    <p><strong>4. Chính sách hoàn tiền</strong><br>
                        Các giao dịch mua ứng dụng sẽ không được hoàn tiền trừ khi có lỗi nghiêm trọng từ hệ thống.</p>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="agree_terms" required>
                    <label for="agree_terms" class="form-check-label">Tôi đồng ý</label>
                </div>
                <div class="mt-5 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-lg px-5" onclick="prevStep(3)">Quay lại</button>
                    <button type="submit" class="btn btn-success btn-lg px-5">Hoàn thành</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const fullNameInput = document.getElementById("full_name");
    const phoneInput = document.getElementById("phone");
    const addressInput = document.getElementById("address");
    const toStep4Btn = document.getElementById("toStep4Btn");

    function validatePhone(phone) {
        return /^\d{10,11}$/.test(phone);
    }

    function validateFullName(name) {
        return /^[a-zA-ZÀ-Ỹà-ỹ\s]+$/.test(name) && name.trim().length > 2;
    }

    function checkInputs() {
        const isFullNameValid = validateFullName(fullNameInput.value);
        const isPhoneValid = validatePhone(phoneInput.value);
        const isAddressValid = addressInput.value.trim().length > 5;

        if (isFullNameValid && isPhoneValid && isAddressValid) {
            document.getElementById('toStep4Btn').disabled = false;
        } else {
            toStep4Btn.setAttribute("disabled", "true");
        }
    }

    fullNameInput.addEventListener("input", checkInputs);
    phoneInput.addEventListener("input", checkInputs);
    addressInput.addEventListener("input", checkInputs);
});

document.getElementById('developer_name').addEventListener('input', function () {
    let name = this.value.trim();
    let errorElement = document.getElementById('nameError');
    let continueBtn = document.getElementById('continueBtn');

    if (name.length === 0) {
        errorElement.textContent = "Vui lòng nhập tên Developer.";
        continueBtn.disabled = true;
        return;
    }

    fetch(`/check-developer-name?name=${encodeURIComponent(name)}`)
        .then(response => response.json())
        .then(data => {
            errorElement.textContent = data.message;
            errorElement.style.color = data.exists ? 'red' : 'green';
            continueBtn.disabled = data.exists;
        })
        .catch(() => {
            errorElement.textContent = "Lỗi kết nối, vui lòng thử lại.";
            continueBtn.disabled = true;
        });
});

function nextStep(step) {
    document.querySelectorAll("[id^='step']").forEach(e => e.style.display = "none");
    document.getElementById(`step${step}`).style.display = "block";
    document.getElementById('progressBar').style.width = (step / 4) * 100 + "%";
}

function prevStep(step) {
    nextStep(step);
}

document.getElementById('developerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    formData.append('_token', '{{ csrf_token() }}');

    fetch("{{ route('developer.register') }}", {
        method: "POST",
        body: formData 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            alert("Đăng ký thành công!");
            window.location.href = data.redirect;
        } else {
            alert("Lỗi: " + (data.message || "Đăng ký thất bại"));
        }
    })
    .catch(error => {
        console.error("Lỗi:", error);
        alert("Lỗi hệ thống! Vui lòng thử lại.");
    });
});

function sendOTP() {
    let email = document.getElementById('email').value;
    let sendOtpBtn = document.getElementById('sendOtpBtn');
    let emailStatus = document.getElementById('emailStatus');

    if (!email) {
        emailStatus.innerHTML = "Vui lòng nhập email.";
        emailStatus.classList.remove('text-success');
        emailStatus.classList.add('text-danger');
        return;
    }

    sendOtpBtn.disabled = true; // Chặn spam nút
    emailStatus.innerHTML = "Đang gửi mã...";

    fetch("{{ route('send.otp') }}", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: JSON.stringify({ email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            emailStatus.innerHTML = "Mã OTP đã gửi! Vui lòng kiểm tra email.";
            emailStatus.classList.remove('text-danger');
            emailStatus.classList.add('text-success');
            document.getElementById('otp').disabled = false;
            document.getElementById('verifyOtpBtn').disabled = false;
        } else {
            emailStatus.innerHTML = "Lỗi: " + data.message;
            emailStatus.classList.remove('text-success');
            emailStatus.classList.add('text-danger');
        }
        sendOtpBtn.disabled = false; // Mở lại nút
    })
    .catch(error => {
        emailStatus.innerHTML = "Lỗi hệ thống!";
        emailStatus.classList.remove('text-success');
        emailStatus.classList.add('text-danger');
        sendOtpBtn.disabled = false;
    });
}

function verifyOTP() {
    let email = document.getElementById('email').value;
    let otp = document.getElementById('otp').value;
    let emailStatus = document.getElementById('emailStatus');

    if (!otp) {
        emailStatus.innerHTML = "Vui lòng nhập mã OTP.";
        emailStatus.classList.remove('text-success');
        emailStatus.classList.add('text-danger');
        return;
    }

    fetch("{{ route('verify.otp') }}", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: JSON.stringify({ email, otp })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            emailStatus.innerHTML = "Xác thực thành công!";
            emailStatus.classList.remove('text-danger');
            emailStatus.classList.add('text-success');

            // Mở khóa nút "Tiếp tục"
            document.getElementById('toStep3Btn').disabled = false;
        } else {
            emailStatus.innerHTML = "Mã OTP không hợp lệ hoặc đã hết hạn.";
            emailStatus.classList.remove('text-success');
            emailStatus.classList.add('text-danger');
        }
    })
    .catch(error => {
        emailStatus.innerHTML = "Lỗi hệ thống!";
        emailStatus.classList.remove('text-success');
        emailStatus.classList.add('text-danger');
    });
}
</script>
@endsection
