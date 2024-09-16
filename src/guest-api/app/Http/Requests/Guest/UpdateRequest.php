<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => "required|string|max:30|regex:/^[a-zA-Z\s\-\'`]+$/u",
            'surname' => "required|string|max:30|regex:/^[a-zA-Z\s\-\'`]+$/u",
            'phone' => "required|string|unique:guests,phone|regex:/^[0-9\s]+$/u",
            'email' => 'string|email|unique:guests,email',
            'country_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя гостя - обязательное поле',
            'name.string' => 'Имя гостя - должно быть строкой',
            'name.max' => 'Имя гостя - максимальное количество символов: 30',
            'name.regex' => 'Имя гостя - используются запрещенные специальные символы',

            'surname.required' => 'Фамилия гостя - обязательное поле',
            'surname.string' => 'Фамилия гостя - должно быть строкой',
            'surname.max' => 'Фамилия гостя - максимальное количество символов: 30',
            'surname.regex' => 'Фамилия гостя - используются запрещенные специальные символы',

            'phone.required' => 'Номер телефона гостя - обязательное поле',
            'phone.string' => 'Номер телефона гостя - должно быть строкой',
            'phone.unique' => 'Номер телефона гостя уже существует',
            'phone.regex' => 'Номер телефона гостя - используются запрещенные специальные символы',

            'email.email' => 'Не соблюден формат эл. почты',
            'email.string' => 'Эл. почта гостя - должно быть строкой',
            'email.unique' => 'Эл. почта гостя уже существует',

            'country_id.integer' => 'Эл. почта - ожидается ID страны',        ];
    }
}
