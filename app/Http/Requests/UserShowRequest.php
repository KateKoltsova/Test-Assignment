<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserShowRequest extends FormRequest
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
            $this->getFieldName() => ['required', 'numeric', 'exists:users,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            $this->getFieldName() . '.required' => [
                'error' => 'The :attribute field is required.'
            ],
            $this->getFieldName() . '.numeric' => [
                'error' => 'The :attribute must be an integer.'
            ],
            $this->getFieldName() . '.exists' => [
                'message' => 'The user with the requested identifier does not exist',
                'error' => 'User not found',
                'status' => 404
            ]
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $fails = $validator->errors()->toArray()['user_id'][0];

        if (!isset($fails['status']))
            $fails['status'] = 422;

        if (!isset($fails['message']))
            $fails['message'] = 'Validation failed';

        if (!isset($fails['error']))
            $fails['error'] = 'Validation failed';


        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $fails['message'],
                'fails' => $fails['error'],
            ], $fails['status'])
        );
    }

    /**
     * Get the data for the request.
     *
     * @return array
     */
    public function validationData()
    {
        return [
            'user_id' => $this->route('user')
        ];
    }

    /**
     * Get the name of the field under validation.
     *
     * @return string|null
     */
    protected function getFieldName()
    {
        return 'user_id';
    }
}
