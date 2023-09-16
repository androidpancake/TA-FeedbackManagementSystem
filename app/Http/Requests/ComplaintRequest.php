<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'subject' => 'required|string',
            'content' => 'required|string',
            'date' => 'nullable|date',
            'category_id' => 'required|exists:category,id',
            'status' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ];
    }

    public function message()
    {
        return [
            'category_id.required' => 'Silahkan pilih kategori',
            'subject.required' => 'Subjek tidak boleh kosong',
            'content.required' => 'Komentar tidak boleh kosong',
            'file.required' => 'Harus menambahkan file',
            'file.mimes' => 'Format file hanya jpg, jpeg, png, pdf'
            // You can specify other custom messages here
        ];
    }
}
