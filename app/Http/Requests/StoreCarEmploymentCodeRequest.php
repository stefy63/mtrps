<?php

namespace App\Http\Requests;

class StoreCarEmploymentCodeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|numeric',
            'description' => 'required|string',
            'extended' => 'nullable'
        ];
    }

    protected function prepareForValidation(): void
    {
        $extended = $this->code.' - '.$this->description;
        $this->merge(['extended' => $extended]);
        $this->merge(['description' => strtoupper($this->description)]);
    }
}
