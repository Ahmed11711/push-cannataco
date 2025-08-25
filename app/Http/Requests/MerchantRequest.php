<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:merchants',
            'google_id' => 'nullable|string|max:255|unique:merchants',
            'facebook_id' => 'nullable|string|max:255|unique:merchants',
            'password' => 'required|string|min:8|confirmed',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'address_warehouse' => 'nullable|string|max:255',
            'address_company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:500',
            'status' => 'boolean',
        ];
    }
}
