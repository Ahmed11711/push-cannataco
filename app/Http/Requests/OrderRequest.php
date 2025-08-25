<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'track_id' => 'required|exists:tracks,id',
            'name_sender' => 'nullable|string|max:255',
            'phone_sender' => 'nullable|string|max:20',
            'address_sender' => 'nullable|string|max:255',
            'email_sender' => 'nullable|email|max:255',
            'name_received' => 'nullable|string|max:255',
            'phone_received' => 'nullable|string|max:20',
            'email_received' => 'nullable|email|max:255',
            'delivered_at' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.name' => 'nullable|string|max:255',
            'items.*.weight' => 'required|numeric|min:0.01',
            'items.*.shipping_method_id' => 'required|exists:shipping_methods,id',
            'items.*.note' => 'nullable|string|max:255',
        ];
    }
}
