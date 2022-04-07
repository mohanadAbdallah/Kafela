<?php

namespace App\Jobs;

use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class sendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::where('role', 'sponsor')->wherenotnull('sponsor_pay_end')
            ->select('id','phone',DB::raw('DATEDIFF(sponsor_pay_end,"'.Carbon::today()->format('Y-m-d').'") as date_diff'))
            ->get();
        $settings = Setting::first();

        $message_user_name = isset($settings->message_user_name) && $settings->message_user_name != null ? $settings->message_user_name: '';
        $message_password = isset($settings->message_password) && $settings->message_password != null ? $settings->message_password: '';
        $message_sender_name = isset($settings->message_sender_name) && $settings->message_sender_name != null ? $settings->message_sender_name: '';

        if($message_user_name != ''){
            foreach ($users as $user){
                if($user->phone != '' ){
                    if($user->date_diff <= 5 && $user->ensure_type == 1){
                        $send = $this->sendSMS($message_user_name, $message_password, $settings->message_monthly_pay, $user->phone, $message_sender_name);
                    }elseif ($user->date_diff <= 30 && $user->ensure_type == 2){
                        $send = $this->sendSMS($message_user_name, $message_password, $settings->message_yearly_pay, $user->phone, $message_sender_name);
                    }else if($user->date_diff <= 15 && ($user->ensure_type != 2 && $user->ensure_type != 1)){
                        $send = $this->sendSMS($message_user_name, $message_password, $settings->message_by_month_pay, $user->phone, $message_sender_name);
                    }
                }
            }
        }else{
            throw new \Exception('لا يوجد اسم مستخدم لارسال الرسائل');
        }



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
        $message = json_decode(nl2br($ret),true);
        if($message['Code'] && $message['Code'] != 100) throw new \Exception($message['MessageIs']);

        return nl2br($ret);
    }
}
