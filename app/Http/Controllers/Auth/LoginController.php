<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Setting;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        $settings = Setting::find(1);

        session(
            ['app_name'=>$settings->website_name ?? 'موقع كافل']
        ); session(
            ['app_logo'=>$settings->logo ?? '']
        );
        return view('auth.login');
    }
    public function showForgetPassword()
    {
        return view('auth.forget_password');
    }
    public function showSendOtp()
    {
        return view('auth.send_otp');
    }
    public function showChangePassword()
    {
        return view('auth.change_password');
    }
    public function showRegisterSponsorForm()
    {
        return view('auth.register_sponsor');
    }
    public function showSendOtpRegister()
    {
        return view('auth.send_otp_register');
    }
    public function registerSponsorForm(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required',
            'name' => 'required'
        ]);
        $users = User::where('phone',$request->phone)->get();
        if(count($users) > 0){
            return view('auth.register_sponsor')->with('phone','رقم الجوال موجود حالياً');
        }
        $count = User::where('role','sponsor')->count();
        $user = new User();
        $user->is_accepted = 0;
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->sponsor_file_no = '7000'.($count+1);
        $user->password = Hash::make($request->password);
        $user->otp = rand(00000,10000);
        $user->email = rand(00000,10000);
        $user->role = 'sponsor';
        $user->save();
        $settings = Setting::first();
        $message_user_name = isset($settings->message_user_name) && $settings->message_user_name != null ? $settings->message_user_name: 'aytamleith';
        $message_password = isset($settings->message_password) && $settings->message_password != null ? $settings->message_password: 'aytamleith';
        $message_sender_name = isset($settings->message_sender_name) && $settings->message_sender_name != null ? $settings->message_sender_name: 'AYTAMLEITH';

        $send = $this->sendSMS($message_user_name, $message_password, $user->otp.'رمز تفعيل الاشتراك هو ', $user->phone, $message_sender_name);
        return redirect(route('send.otp.register'));

    }
    public function changePasswordStore(Request $request)
    {
        $this->validate($request, [
            'password' => 'required'
        ]);
        $user_id = session()->get('otp_user');
        $users = User::where('id',$user_id)->first();
            if($users){
                $users->password = Hash::make($request->password);
                $users->save();
                return redirect(route('login'));
            }else{
                return back();
            }

    }
    public function sendOtpRegister(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required'
        ]);
        $users = User::where('otp',$request->otp)->first();
            if($users){
                $users->is_accepted = 1;
                $users->otp = '';
                $users->save();
                return view('auth.login')->with('register','تم تفعيل الاشتراك بنجاح');
            }else{
                return back();
            }

    }
    public function sendOtp(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required'
        ]);
        $users = User::where('otp',$request->otp)->first();
            if($users){
                session(
                    ['otp_user'=>$users->id]
                );
                return redirect(route('change.password'));
            }else{
                return back();
            }

    }
    public function forgetPassword(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required'
        ]);
        $users = User::where('phone',$request->phone)->first();
            if($users){
                if($users->phone != ''){
                    $settings = Setting::first();
                    $users->otp = rand(00000,10000);
                    $users->save();
                    $message_user_name = isset($settings->message_user_name) && $settings->message_user_name != null ? $settings->message_user_name: 'aytamleith';
                    $message_password = isset($settings->message_password) && $settings->message_password != null ? $settings->message_password: 'aytamleith';
                    $message_sender_name = isset($settings->message_sender_name) && $settings->message_sender_name != null ? $settings->message_sender_name: 'AYTAMLEITH';

                    $send = $this->sendSMS($message_user_name, $message_password, $users->otp.'رمز تغيير كلمة المرور الخاص بك هو ', $users->phone, $message_sender_name);
                    return redirect(route('send.otp'));
                }
            }

        return view('auth.login')->with('fail','عذراً, الموقع متوقف عن العمل. ');
    }
    public function Login(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required'
        ]);

        $users = User::where('phone',$request->phone)->first();
        if($users){
            if($users->is_accepted == 0){
                return redirect(route('send.otp.register'));
            }
        }
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'is_accepted' => 1], $request->get('remember'))) {
            $settings = Setting::find(1);
            if($settings->is_website_on == 0){
                if(auth()->user()->role != 'admin'){
                    Auth::logout();
                    return view('auth.login')->with('fail','عذراً, الموقع متوقف عن العمل. ');
                }
            }

            return redirect()->intended('/home');
        }
        return $this->sendFailedLoginResponse($request);
    }
    public function username()
    {
        return 'phone';
    }

    protected function sendSMS($oursmsusername, $oursmspassword, $messageContent, $mobileNumber, $senderName)
    {
        $user = $oursmsusername;
        $password = $oursmspassword;
        $sendername = $senderName;
        $text = urlencode($messageContent);
        $to = $mobileNumber;

        $url = "http://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E&return=json";
        $ret = file_get_contents($url);
        return nl2br($ret);
    }
}
