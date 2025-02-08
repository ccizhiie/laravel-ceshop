<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'foto' =>  'nullable',
            'name' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.nullable' => 'Foto bersifat opsional.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
        ];
    }
}
