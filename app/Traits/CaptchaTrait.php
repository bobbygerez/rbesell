<?php 

namespace App\Traits;

use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

trait CaptchaTrait {

    public function captchaCheck($data)
    {

        $response = $data['gRecaptchReponse'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);


        //$resp true or false
        if ($resp) {
            return 1;
        } else {
            return '';
        }

    }

}