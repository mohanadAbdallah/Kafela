<?php

namespace App\Http\Controllers;

use App\Jobs\sendMessage;
use App\Setting;
use App\User;
use App\UserColumnVisibility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function settings()
    {
        $settings = Setting::find(1);
        $visibility = UserColumnVisibility::first();
        return view('settings.settings', compact('settings', 'visibility'));
    }


    public function settings_update(Request $request)
    {
        if($request->logo != ''){
            $logo = $request->logo->store('logo');
            $settings = Setting::updateOrCreate(
                ['id' => 1],
                [
                    'id' => 1,
                    'logo' => $logo,
                ]
            );
            session(
                ['app_logo'=>$logo ?? '']
            );
        }
        $settings = Setting::updateOrCreate(
            ['id' => 1],
            [
                'id' => 1,
                'message_monthly_pay' => $request->message_monthly_pay,
                'message_yearly_pay' => $request->message_yearly_pay,
                'message_by_month_pay' => $request->message_by_month_pay,
                'message_thanks_sponsor' => $request->message_thanks_sponsor,
                'message_orphan_received' => $request->message_orphan_received,
                'name_characters_count' => $request->name_characters_count,
                'date_send_messages' => $request->date_send_messages,
                'message_user_name' => $request->message_user_name,
                'message_password' => $request->message_password,
                'message_sender_name' => $request->message_sender_name,
                'website_name' => $request->website_name,
                'is_website_on' => $request->is_website_on,
            ]
        );

        UserColumnVisibility::destroy(1);
        $newVisibility = new UserColumnVisibility();
        $newVisibility->id = 1;
        foreach ($request->visibility ?? [] as $item) {
            $newVisibility->$item = $item;
        }
        $newVisibility->save();
        session(
            ['app_name'=>$request->website_name ?? 'موقع كافل']
        );

        return response(['result' => 'success', 'settings' => $settings]);
    }

    public function messages()
    {
        $settings = Setting::find(1);

        return view('settings.messages',compact('settings'));
    }

    public function messages_store(Request $request)
    {
        header("Content-Type: text/html; charset=utf-8");
        $message = $request->message_text;
        if($message == ''){
            return response(['result'=>'fail','message'=> 'يجب ملئ حقل الرسالة']);
        }
        if(request()->get('receive_type') == 'orphans_has_sponsor'){
            $users = User::where('role', 'orphan')->get();
            $usersFiltered = [];
            foreach ($users as $user) {
                if ( count($user->sponsors) > 0) {
                    array_push($usersFiltered, $user);
                }
            }
            $users = $usersFiltered;
        }
        else if(request()->get('receive_type') == 'sponsor_has_orphans'){
            $users = User::where('role', 'sponsor')->get();
            $usersFiltered = [];
            foreach ($users as $user) {
                if ( count($user->orphans) > 0) {
                    array_push($usersFiltered, $user);
                }
            }
            $users = $usersFiltered;
        }else{
            $users = User::where('role', request()->get('receive_type'))->get();
        }


        $settings = Setting::first();

        $message_user_name = isset($settings->message_user_name) && $settings->message_user_name != null ? $settings->message_user_name: '';
        $message_password = isset($settings->message_password) && $settings->message_password != null ? $settings->message_password: '';
        $message_sender_name = isset($settings->message_sender_name) && $settings->message_sender_name != null ? $settings->message_sender_name: '';

        if($message_user_name != '')
        foreach ($users as $user) {
            $phone_no = '';
            $send = '';
            if (request()->get('receive_type') == 'orphan') {
                $phone_no = $user->mother_phone;
            } else {
                $phone_no = $user->phone;
            }
            if ($phone_no != '')
                $send = $this->sendSMS($message_user_name, $message_password, $message, $phone_no, $message_sender_name);

        }
        return response(['result' => 'success','message'=> 'تم ارسال الرسالة بنجاح']);
    }
    public function messages_send_pay_store(Request $request)
    {
        header("Content-Type: text/html; charset=utf-8");
        $message_thanks_sponsor = $request->message_thanks_sponsor;
        $message_orphan_received = $request->message_orphan_received;
        $month_date = Carbon::createFromFormat('Y-m-d', $request->month_date)->format('Y-m-d');
        $users = User::where('role', 'sponsor')->where(DB::raw('DATEDIFF(sponsor_pay_end,"'.$month_date.'")'),'>=',1)->get();



        $settings = Setting::first();

        $message_user_name = isset($settings->message_user_name) && $settings->message_user_name != null ? $settings->message_user_name: '';
        $message_password = isset($settings->message_password) && $settings->message_password != null ? $settings->message_password: '';
        $message_sender_name = isset($settings->message_sender_name) && $settings->message_sender_name != null ? $settings->message_sender_name: '';

        if($message_user_name != '')
        foreach ($users as $user) {
            if ($user->phone_no != '')
            $send = $this->sendSMS($message_user_name, $message_password, $message_thanks_sponsor, $user->phone_no, $message_sender_name);

            foreach ($user->orphans as $orphan) {
               if ($orphan->mother_phone != '')
                   $send = $this->sendSMS($message_user_name, $message_password, $message_orphan_received, $orphan->mother_phone, $message_sender_name);

            }


        }
        return response(['result' => 'success','message'=> 'تم ارسال الرسالة بنجاح']);
    }

    public function sendNow()
    {
        sendMessage::dispatch();
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

    public function ck_upload_image(Request $request)
    {
        if ($_COOKIE['ckCsrfToken'] == $_POST['ckCsrfToken']) {

            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);


            //set variables
            $tmpName = $_FILES['upload']['tmp_name'];
            $filename = $_FILES['upload']['name'];
            $size = $_FILES['upload']['size'];
            $data = date('d-m-Y-H-i-s');
            $filePath = public_path() . "/uploads/pages/" . $data . '-' . $filename;
            $fileurl = url('/') . "/uploads/pages/" . $data . '-' . $filename;
            $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $type = $_GET['type'] ?? 'image';
            $funcNum = isset($_GET['CKEditorFuncNum']) ? $_GET['CKEditorFuncNum'] : null;

            if ($type === 'image') {
                $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png');
            } else {
                //file
                $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'doc', 'docx');
            }

            //contrinue only if file is allowed
            if (in_array($fileExtension, $allowedfileExtensions)) {

                //contunie if file is less then the desired size
                if ($size < 20 * MB) {

                    if (move_uploaded_file($tmpName, $filePath)) {


                        $data = ['uploaded' => 1, 'fileName' => $filename, 'url' => $fileurl];

                        if ($type === 'file') {

                            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath');</script>";
                            exit();
                        }

                    } else {

                        $error = 'There has been an error, please contact support.';

                        if ($type == 'file') {
                            $message = $error;

                            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                            exit();
                        }

                        $data = array('uploaded' => 0, 'error' => array('message' => $error));

                    }

                } else {

                    $error = 'The file must be less than 20MB';

                    if ($type == 'file') {
                        $message = $error;

                        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                        exit();
                    }

                    $data = array('uploaded' => 0, 'error' => array('message' => $error));

                }

            } else {

                $error = 'The file type uploaded is not allowed.';

                if ($type == 'file') {
                    $funcNum = $_GET['CKEditorFuncNum'];
                    $message = $error;

                    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                    exit();
                }


                $data = array('uploaded' => 0, 'error' => array('message' => $error));

            }

            //return response
            echo json_encode($data);
        }

    }
}
