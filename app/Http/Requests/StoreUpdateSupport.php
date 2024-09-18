<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSupport extends FormRequest
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
            'nome' => 'required|min:1|max:255|unique:products',
            'category_id' => 'required|min:1|max:255',
            'valor' => 'required|min:1|max:255',
            'image => nullable|mimes:png,jpg,jpeg,webp|max:3072',
        ];

        if ($this->Method() === 'PUT') {
            $rules['nome'] = [  
                'required',
                'min:1',
                'max:255',
                Rule::unique('products')->ignore($this->id),
            ];
        }
        
        return $rules;
    }
} 
