<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required','string', 'max:255'],
            'last_name' => ['string', 'max:255', 'nullable'],
            'phone_number' => ['required', 'string', 'max:12'],
            'dob' => ['required', 'string'],
            'gender' => ['required']
        ];
    }
}
