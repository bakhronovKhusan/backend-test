<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatus;
use App\Rules\MerchantOneRule;
use App\Rules\MerchantTwoRule;
use App\Rules\PaymentOneRule;
use App\Rules\PaymentStatusRule;
use App\Rules\PaymentTwoRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PaymentTwoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'project.required'     => 'Project ID is required.',
            'invoice.required'     => 'Invoice ID is required.',
            'status.required'      => 'Status is required.',
            'status.in'            => 'Invalid status value.',
            'amount.required'      => 'Amount is required.',
            'amount_paid.required' => 'Amount paid is required.',
            'rand.required'        => 'Rand is required.',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project'     => ['required', new MerchantTwoRule()],
            'invoice'     => ['required', new PaymentTwoRule()],
            'status'      => ['required', new PaymentStatusRule()],
            'amount'      => 'required',
            'amount_paid' => 'required',
            'rand'        => 'required',
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
