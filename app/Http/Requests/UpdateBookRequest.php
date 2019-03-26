<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if($this->has('name')) $rules['name'] = 'required|string|min:2|max:255';
        if($this->has('authorName')) $rules['authorName'] = 'required|string|min:2|max:255|regex:/^[a-zA-Z ]+$/u';
      
        return $rules;
    }
}
