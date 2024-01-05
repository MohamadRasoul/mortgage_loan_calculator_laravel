<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'loan_amount' => ['required','numeric','min:1000'],
            'loan_term' => ['required','numeric','min:1'],
            'interest_rate' => ['required','numeric','min:1','max:99'],
            'monthly_fixed_extra_payment' => ['nullable','numeric','min:10','lt:loan_amount'],
        ];
    }



}
