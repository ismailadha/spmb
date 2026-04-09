<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SekolahRequest extends FormRequest
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
        return [
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:255|unique:sekolah,npsn,'.$this->route('sekolah'),
            'jenjang' => 'required|in:TK,SD,SMP,SMA',
            'id_provinsi' => 'nullable|exists:provinsi,id',
            'id_kabupaten' => 'nullable|exists:kabupaten,id',
            'id_kecamatan' => 'nullable|exists:kecamatan,id',
            'id_desa' => 'nullable|exists:desa,id',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'website' => 'nullable|url|max:255',
            'telepon' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status_perbatasan' => 'nullable|boolean',
            'status_unggulan' => 'nullable|boolean',
            'status_pilihan_1' => 'nullable|boolean',
            'daya_tampung' => 'required|integer|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
            'daya_tampung.required' => 'Daya tampung wajib diisi.',
            'daya_tampung.integer' => 'Daya tampung harus berupa angka.',
            'npsn.unique' => 'NPSN sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'website.url' => 'Format website tidak valid.',
        ];
    }
}
