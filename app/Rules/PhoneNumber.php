<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regexPhoneNumber = '/(84|0[3|5|7|8|9])+([0-9]{8})/';
        if (!preg_match($regexPhoneNumber, $value)) {
            $fail('Trường :attribute không đúng định dạng!');
        }
    }
}
