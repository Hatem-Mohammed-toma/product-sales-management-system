<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:products,code,' . $this->product?->id,
            'category_id' => 'required|exists:categories,id',
            'quantity'    => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
            'cost'        => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'        => 'اسم المنتج مطلوب.',
            'name.max'             => 'اسم المنتج يجب ألا يزيد عن 255 حرف.',

            'code.required'        => 'كود المنتج مطلوب.',
            'code.max'             => 'كود المنتج يجب ألا يزيد عن 100 حرف.',
            'code.unique'          => 'هذا الكود مستخدم من قبل، اختر كود آخر.',

            'category_id.required' => 'الفئة مطلوبة.',
            'category_id.exists'   => 'الفئة غير موجودة.',

            'quantity.required'    => 'الكمية مطلوبة.',
            'quantity.integer'     => 'الكمية يجب أن تكون رقمًا صحيحًا.',
            'quantity.min'         => 'الكمية يجب ألا تقل عن 1.',

            'price.required'       => 'السعر مطلوب.',
            'price.numeric'        => 'السعر يجب أن يكون رقمًا.',
            'price.min'            => 'السعر يجب ألا يقل عن 0.',
            'cost.required'        => 'التكلفة مطلوبة.',
            'cost.numeric'         => 'التكلفة يجب أن تكون رقمًا.',
            'cost.min'             => 'التكلفة يجب ألا تقل عن 0.',
            
        ];
    }
}