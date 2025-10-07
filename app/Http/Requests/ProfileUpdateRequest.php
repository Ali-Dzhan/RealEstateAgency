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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];

        if ($this->user()->role === 'agent') {
            $rules = array_merge($rules, [
                'first_name' => ['nullable', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:20'],
            ]);
        }

        if ($this->user()->role === 'client') {
            $rules = array_merge($rules, [
                'phone' => ['nullable', 'string', 'max:20'],
            ]);
        }

        return $rules;
    }
}
