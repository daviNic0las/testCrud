<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:1|max:255|unique:students',
            'date_of_birth' => 'required|min:1',
            'category_id' => 'required|min:1|max:255',
            'class' => 'required|min:1|max:255',
            'student_id' => 'required|min:1|unique:students',
            'school' => 'required|min:1|max:255',
            'image => nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ];

            

            if ($this->method() === 'PUT') {
                $rules['name'] = [  
                    'required',
                    'min:1',
                    'max:255',
                    Rule::unique('students')->ignore($this->id),
                ];
            }
        
            return $rules;
    }
} 
