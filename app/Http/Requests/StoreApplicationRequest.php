<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'contact_email' => 'required|email',
            'contact_phone' => ['required','string','regex:/^\+?[1-9]\d{1,14}$/'],
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'country' => 'nullable|string|max:100',
            'comments' => 'nullable|string|max:2000',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,pdf|max:5120', // 5MB each
            'files' => 'nullable|array|max:10'
        ];
    }

    public function messages()
    {
        return [
            'contact_phone.regex' => 'Phone must be in international E.164 format (e.g. +201234567890).',
            'files.*.mimes' => 'Files must be images or PDFs.',
        ];
    }
}
