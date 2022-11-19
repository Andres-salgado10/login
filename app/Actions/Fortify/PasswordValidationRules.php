<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;
use Illuminate\Validation\Rules;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required',
        Rules\Password::min(12)
        ->Letters(2)
        ->mixedcase(4)
        ->numbers(2)
        ->symbols(1)
        ->uncompromised(), 
         'string', new Password, 'confirmed',
         'g-recaptcha.response'=>function($atrribute,$value,$fail){
            $secretkey=config('services.recapchat.secret');
            $response=$value;
            $userIP=$SERVER['REMOTE_ADDR']
            $url="https://www.google.com/recaptcha/api/siteverify METHOD: POST";
            $response =\file_get_contents($url);
            $response=json_decode($response);
            if(!$response->success){
                session::flash('g-recaptcha-response','por favor marcar el recaptcha');
                session::flash('alert-class','alert-danger');
                $fail($attribute.'google recaptcha failed')
            }


         }];
    }

}
