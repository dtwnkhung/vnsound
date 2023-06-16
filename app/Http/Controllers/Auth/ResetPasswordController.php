<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request, $token = null)
    {
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'pageConfigs' => $pageConfigs]
        );
    }
    public function changePass(Request $request)
    {
        if (!Hash::check($request->oldPassword, Auth::user()->password)) {
            return back()->withErrors(['oldPassword' => 'Mật khẩu không chính xác'])->withInput();
        }
        if($request->password == $request->oldPassword){
            return back()->withErrors(['password' => 'Mật khẩu mới trùng với mật khẩu cũ'])->withInput();
        }
        if($request->password != $request->password_confirmation){
            return back()->withErrors(['password_confirmation' => 'Xác nhận mật khẩu không chính xác'])->withInput();
        }
        $this->validate($request,
            [
                'password' => 'required|min:6|max:16' ,
            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu mới!',
                'password.min' => 'Mật khẩu có độ dài từ 6-16 kí tự!',
                'password.max' => 'Mật khẩu có độ dài từ 6-16 kí tự!',
            ]
        );
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return redirect('/login')->with('thongbao', 'Cập nhật mật khẩu thành công!');

    }

}
