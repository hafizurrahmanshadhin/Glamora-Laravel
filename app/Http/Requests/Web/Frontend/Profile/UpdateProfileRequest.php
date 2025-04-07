<?php

namespace App\Http\Requests\Web\Frontend\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        $userId = auth()->id();

        return [
            'first_name'   => 'nullable|string|max:255',
            'last_name'    => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:25|regex:/^\+?[0-9\s\-\(\)]+$/|unique:users,phone_number,' . $userId,
            'address'      => 'nullable|string',
            'avatar'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void {
        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('t-error', 'Validation error occurred.')
        );
    }
}
