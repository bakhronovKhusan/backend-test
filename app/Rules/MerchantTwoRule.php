<?php

namespace App\Rules;

use App\Models\Merchant1;
use App\Models\Merchant2;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MerchantTwoRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!Merchant2::where('merchant_id', $value)->exists())
        {
            $fail('Merchant ID Not exist');
        }
    }
}
