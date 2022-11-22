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
         'g-recaptcha-response' => 'required|captcha'
        ];
    }

}
