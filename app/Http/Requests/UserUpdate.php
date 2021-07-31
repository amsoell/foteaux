<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user() && auth()->id() == request()->route('user')?->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:255',
                Rule::requiredIf(fn () => ! request()->is('api/*')),
            ],
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->ignore(request()->route('user') ?? null),
                Rule::requiredIf(fn () => ! request()->is('api/*')),
            ],
            'username' => [
                'max:20',
                'alpha_num',
                Rule::unique('users')->ignore(request()->route('user') ?? null),
                Rule::requiredIf(fn () => ! request()->is('api/*')),
            ],
            'photo' => [
                'nullable',
                'mimes:jpg,jpeg,png',
                'max:1024',
            ],
        ];
    }
}
