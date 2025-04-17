<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseTransactionRequest extends FormRequest
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

            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'transaction_type_id' => ['required', 'exists:warehouse_transaction_types,id'],
            'items' => ['required', 'array'],
            'items.*.item_id' => ['required','exists:items,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.comment' => ['nullable', 'string'],
        ];
    }
}
