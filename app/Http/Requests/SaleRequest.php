<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'code'     => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required'     => 'كود المنتج مطلوب.',
            'code.max'          => 'كود المنتج يجب ألا يتجاوز 50 حرفاً.',
            'quantity.required' => 'الكمية مطلوبة.',
            'quantity.integer'  => 'الكمية يجب أن تكون رقم صحيح.',
            'quantity.min'      => 'الكمية يجب ألا تقل عن 1.',
        ];
    }
}
