<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
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
            'date' => 'date|required',
            'kelas_id' => 'exists:class,id|required',
            'limit_date' => 'date',
            'type' => 'nullable',
        ];
    }

    public function message()
    {
        return [
            'date.required' => 'masukkan tanggal',
            'kelas_id.required' => 'masukkan kelas',
            'type' => 'masukkan tipe pengajaran'
        ];
    }
}
