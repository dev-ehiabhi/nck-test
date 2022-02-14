<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cart' => 'required|array',
            'cart.*.inventory_id' => 'required|exists:inventories,id',
            'cart.*.quantity' => 'required|integer'
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
