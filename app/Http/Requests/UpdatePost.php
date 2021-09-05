<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alias' => 'alpha_dash|max:255',
            'title.*' => ['required', 'regex:/^[0-9A-Za-zА-Яа-яґҐЁёІіЇїЄє\'’ʼ.,:;-_]+$/u'],
            'content.*' => ['required', 'regex:/^[0-9A-Za-zА-Яа-яґҐЁёІіЇїЄє\'’ʼ.,:;-_\s\ ]+$/u'],
            'short_description.*' => ['required', 'max:400', 'regex:/^[0-9A-Za-zА-Яа-яґҐЁёІіЇїЄє\'’ʼ.,:;-_\s\ ]+$/u'],
            'imageBig' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'imageSmall' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
