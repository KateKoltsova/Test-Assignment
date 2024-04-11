<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (Str::substr($this->phone, 0, 1) != '+') {
            $this->merge([
                'phone' => '+' . $this->phone,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'email' => ['required', 'string', 'email:rfc', 'max:255', 'regex:^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$^', 'unique:App\Models\User'],
            'phone' => ['required', 'string', 'min:13', 'max:13', 'regex:/^\+380[0-9]{9}$/', 'unique:App\Models\User'],
            'position_id' => ['required', 'numeric', 'exists:positions,id'],
            'photo' => ['required', 'image', 'mimes:jpeg,jpg', 'dimensions:min_width=70,min_height=70', 'max:5120'],
            'token' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'fails' => $validator->errors()->toArray(),
            ], 422)
        );
    }

    public function validationData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position_id' => $this->position_id,
            'photo' => $this->photo,
            'token' => $this->bearerToken()
        ];
    }
}
