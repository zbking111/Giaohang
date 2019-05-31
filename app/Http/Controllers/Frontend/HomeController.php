<?php

namespace App\Http\Controllers\Frontend;

use App\Libs\Configs\StatusConfig;
use App\Models\Contact;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->customerModel = new User();
        $this->contactModel = new Contact();
    }

    public function index() {
       return view('Frontend.Contents.index');
    }

    public function signup () {
        return view('Frontend.Contents.auth.signup');
    }

    public function service () {
        return view('Frontend.Contents.service');
    }

    public function introduction () {
        return view('Frontend.Contents.introduct');
    }

    public function faq () {
        return view('Frontend.Contents.faq');
    }

    public function contact () {
        return view('Frontend.Contents.contact');
    }

    public function postContact (Request $request) {

        $this->_validateContact($request);
        DB::beginTransaction();
        try {
            $this->contactModel->name    = $request->name;
            $this->contactModel->email   = $request->email;
            $this->contactModel->phone   = $request->phone;
            $this->contactModel->message = $request->messages;
            $this->contactModel->save();
            DB::commit();
            return redirect()->back()->with('actions', 'success');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }

    public function signupPost (Request $request) {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required',
            'address'  => 'required',
            'password' => 'required|same:confirm_password',
        ], [
            'name.required'     => 'Tên của bạn không được để trống',
            'email.required'    => 'Email của bạn không được để trống',
            'phone.required'    => 'Số điện thoại của bạn không được để trống',
            'address.required'  => 'Địa chỉ của bạn không được để trống',
            'password.required' => 'Mật khẩu của bạn không được để trống',
            'password.same'     => 'Mật khẩu nhập lại chưa đúng',
            'email.email'       => 'Email không đúng định dạng',
            'email.unique'      => 'Email đã được sử dụng',
        ]);
        DB::beginTransaction();
        try {
            $this->customerModel->code            = $this->generateRandomString(5);
            $this->customerModel->name            = $request->name;
            $this->customerModel->email           = $request->email;
            $this->customerModel->phone           = $request->phone;
            $this->customerModel->address         = $request->address;
            $this->customerModel->atm             = $request->atm;
            $this->customerModel->company         = $request->company;
            $this->customerModel->company_address = $request->company_address;
            $this->customerModel->company_email   = $request->company_email;
            $this->customerModel->company_phone   = $request->company_phone;
            $this->customerModel->note            = $request->note;
            $this->customerModel->password        = Hash::make($request->password);
            $this->customerModel->is_customer     = 1;
            $this->customerModel->avatar          = $request->avatar;
            $this->customerModel->status          = 'DISABLE';
            $this->customerModel->save();
            DB::commit();
            return redirect()->route('home.index')
                ->with(['status'=> 'success', 'messages' => "Đăng kí khách hàng thành công! Hãy đợi nhân viên liên hệ với bạn"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('home.index')
                ->with(['status'=> 'errors', 'messages' => "Thêm mới khách hàng thất bại!"]);
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $checked = $this->customerModel::where('code', $randomString)->first();
        if (!empty($checked)) {
            generateRandomString();
        }
        return $randomString;
    }

    public function _validateContact($request) {
        $this->validate($request ,[
            'name'    => 'required | max: 255',
            'email'   => 'required | max: 255',
            'phone'   => 'required | numeric',
            'messages' => 'required',
        ], [
            'phone.numeric'      => 'Số điện thoại không đúng định dạng',
            'phone.size'      => 'Số điện thoại không được quá dài',
        ], [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'message' => 'Tin nhắn',
        ]);
    }

}
