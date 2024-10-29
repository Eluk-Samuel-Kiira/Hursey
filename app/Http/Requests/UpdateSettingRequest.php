<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'app_name' => 'nullable|string|max:255', // Optional string, max length 255
            'app_email' => 'nullable|email|max:255', // Optional email, max length 255
            'app_contact' => 'nullable|string|max:50', // Optional string, max length 50
            'meta_keyword' => 'nullable|string|max:255', // Optional string, max length 255
            'meta_descrip' => 'nullable|string|max:500', // Optional string, max length 500
            'favicon' => 'nullable|string|max:255', // Optional string, max length 255 (or image validation if needed)
            'logo' => 'nullable|string|max:255', // Optional string, max length 255 (or image validation if needed)
            'mail_status' => 'nullable|in:enabled,disabled', // Optional boolean
            'mail_mailer' => 'nullable|string|max:50', // Optional string, max length 50
            'mail_host' => 'nullable|string|max:255', // Optional string, max length 255
            'mail_port' => 'nullable|integer|min:1|max:65535', // Optional integer within valid port range
            'mail_username' => 'nullable|string|max:255', // Optional string, max length 255
            'mail_password' => 'nullable|string|max:255', // Optional string, max length 255
            'mail_encryption' => 'nullable|string|in:tls,ssl', // Optional, can be 'tls' or 'ssl'
            'mail_address' => 'nullable|string|max:255', // Optional string, max length 255
            'mail_name' => 'nullable|string|max:255',
        ];
    }
}
