<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param User $user
     * @return bool
     */
    public function authorize(User $user)
    {
        if (auth()->user()->role == $user->getAdminRole()) {
            return true;
        }

        return false;
    }

    /**
     *
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:inventories,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @param Validator $validator
     * @return void
     * @throws ValidationException
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
