<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest 
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
            $rules = ['nome' => 'required|min:1|max:255|unique:employees',
            'setor' => 'required|min:1|max:255',
            'salario' => 'required|min:1|max:255',];

            if ($this->Method() === 'PUT') {
                $rules['nome'] = [  
                    'required',
                    'min:1',
                    'max:255',
                    Rule::unique('employees')->ignore($this->id),
                ];
            }
        
            return $rules;
    }
}