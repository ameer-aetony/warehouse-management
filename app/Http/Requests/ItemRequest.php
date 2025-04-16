<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
            'name' => ['required', Rule::unique('items')->ignore($this->id)],
            'commercial_name' => ['required', 'min:3'],
            'category_id' => ['required', 'exists:item_categories,id'],
            'price' => ['required', 'numeric'],
        ];
    }
}
