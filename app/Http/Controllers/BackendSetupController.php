<?php

namespace App\Http\Controllers;
use Nasution\ZenzivaSms\Client as Sms;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

use Auth;

class BackendSetupController extends Controller
{
    use Helpers;

    protected function displayerors($validator)
    {

        $errorsmessage = [];
        $messages = $validator->messages();

        //dd($messages);
        foreach ($messages->all(':message') as $message)
        {
            $errorsmessage[] = $message;
        }

        return $errorsmessage;
    }

    protected function responsejson($message, $status_code, $success, $code = false)
    {
                          
        return [
                'message'       => $message,
                'status_code'   => $status_code,
                'is_success'	=> $success,
                'id'	        => $code,
        ];
    }

    protected function sendSMS($nohp, $pesan)
    {
        $userkey = 'eum48h';
        $passkey = 'irfanhaerus11';
  
        //$url_sms = "https://reguler.zenziva.net/apps/smsapi.php?userkey=".$userkey."&passkey=".$passkey."&nohp=".$nohp."&pesan=".$pesan."";
        
                
        $sms = new Sms($userkey, $passkey);

        // Simple usage
        $response = $sms->send($nohp, $pesan);
        //dd($response);
    }

    protected function sendEmail($email, $subject, $compose_email)
    {
        
    }

    protected function generatedSecretcode()
    {
        $secretcode = str_random(100);
        return($secretcode);
    }

}