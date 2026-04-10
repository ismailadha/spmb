<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('pengguna')->id ?? $this->route('pengguna');

        return [
            'name' => 'required|string|max:255',
            'nik' => [
                'required_if:role,peserta',
                'nullable',
                'string',
                'size:16',
                Rule::unique('users', 'nik')->ignore($userId),
            ],
            'username' => [
                'required_unless:role,peserta',
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($userId),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin_dinas,admin_sekolah,peserta',
            'sekolah_id' => 'required_if:role,admin_sekolah|nullable|exists:sekolah,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'nik' => 'NIK',
            'username' => 'Username',
            'password' => 'Password',
            'role' => 'Role',
            'sekolah_id' => 'Sekolah',
        ];
    }
}
