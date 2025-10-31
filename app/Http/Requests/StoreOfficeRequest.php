<?php

namespace App\Http\Requests;

class StoreOfficeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'ente' => 'required|string',
			'name' => 'nullable|string',
			'phone' => 'nullable|string',
			'mail' => 'nullable|string',
			'address' => 'nullable|string',
			'description' => 'nullable|string',
			'note' => 'nullable|string',
        ];
    }
}
