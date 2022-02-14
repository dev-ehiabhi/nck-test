<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:3|max:25',
            'email' => 'required|string|email|max:50|unique:users,email',
            'password' => 'required|string|confirmed|min:6|max:25',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'error' => 'Validation error',
            'message' => $validator->errors()
        ], 400);

        throw (new ValidationException($validator, $response))->errorBag($this->errorBag);
    }
}
