<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class UserRequest extends FormRequest
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
            'avatar' => "image|mimes:png,jpg,jpeg,svg|max:1024|dimensions:min_width:500",
            'name' => 'required',
            'locale' => [
                'required',
                ValidationRule::in(array_keys(User::LOCALE)),
            ]
        ];
    }
}
