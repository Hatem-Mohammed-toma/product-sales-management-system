<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        // rules للـ create/update
        // لو في update هحتاج نمرر ID للفئة لتجاهلها في unique
        $categoryId = $this->route('category') ? $this->route('category')->id : null;

        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:categories,code,' . $categoryId,
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'اسم الفئة مطلوب.',
            'code.required' => 'كود الفئة مطلوب.',
            'code.unique'   => 'الكود مستخدم من قبل فئة أخرى.',
        ];
    }
}