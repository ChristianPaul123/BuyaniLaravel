<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\ValidationRule;

//NOT USED
class RecaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $value,
        ]);

        if (!$response->json('success')) {
            $fail(__('The reCAPTCHA validation failed. Please try again.'));
        }
    }
}
