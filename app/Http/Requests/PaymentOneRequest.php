<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatus;
use App\Rules\MerchantOneRule;
use App\Rules\PaymentOneRule;
use App\Rules\PaymentStatusRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PaymentOneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'merchant_id' => ['required', new MerchantOneRule()],
            'payment_id'  => ['required', new PaymentOneRule()],
            'status'      => ['required', new PaymentStatusRule()],
            'amount'      => 'required',
            'amount_paid' => 'required',
            'timestamp'   => 'required',
            'sign'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'merchant_id.required' => 'Merchant ID is required.',
            'payment_id.required'  => 'Payment ID is required.',
            'status.required'      => 'Status is required.',
            'status.in'            => 'Invalid status value.',
            'amount.required'      => 'Amount is required.',
            'amount_paid.required' => 'Amount paid is required.',
            'timestamp.required'   => 'Timestamp is required.',
            'sign.required'        => 'Signature is required.',
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        $errors = [];
        foreach($validator->errors()->messages() as $error) {
            $errors[] = $error[0];
        }

        $json = [
            'status'  => 'error',
            'errors'  => $errors
        ];
        throw new HttpResponseException(response()->json($json));
    }
}
