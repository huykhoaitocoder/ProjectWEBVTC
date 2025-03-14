<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id', 'DESC')->paginate(10);

        return view('Backend.users.list', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('Backend.users.update', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);

        $data->role_id = $request->role_id;

        if($data->save()){
            return redirect()->back()->with('msgSuccess', 'Cập nhật thông tin thành công');
        }
        else{
            return redirect()->back()->with('msgError', 'Cập nhật thông tin thất bại');
        }
    }

    // public function destroy($id)
    // {
    //     $data = User::find($id);
    //     foreach($dataOrder as $item){
    //         $dataOrderdetail = OrderdetailModel::where('order_id', $item->order_id)->get();
    //         foreach($dataOrderdetail as $val){
    //             $val->delete();
    //         }
    //         $item->delete();
    //     }
    //     if($data->delete()){
    //         return response()->json(['msgSuccess'=>'Xóa người dùng thành công']);
    //     }
    //     else{
    //         return response()->json(['msgError'=>'Xóa người dùng thất bại']);
    //     }
    // }
}
