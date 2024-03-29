<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckFileUploadFileMultiple implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('Trường hình ảnh liên quan không được để trống!');
        }

        if (empty($value[0])) {
            $fail('Trường hình ảnh liên quan không được để trống!');
        }
    }
}