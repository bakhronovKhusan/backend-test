<?php

namespace App\Rules;


use App\Models\Payment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PaymentOneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if(!Payment::where('id', $value)->where('type','1')->exists())
        {
            $fail('Payment ID Not exist');
        }
    }
}
