<?php

namespace App\Rules;

use App\Enums\PaymentStatus;
use App\Models\Merchant1;
use App\Models\Merchant2;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PaymentStatusRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $values = array_map(fn($case) => $case->value, PaymentStatus::cases());
        if(!in_array($value, $values))
        {
            $fail('Payment Status Not exist');
        }
    }
}
