<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'date' => 'date',
            'category_id' => 'required|exists:category,id',
            'status' => 'required',
            'file' => 'nullable|file',
            'anonymous' => 'boolean',
            'kelas_id' => 'required|exists:class,id'
        ];
    }
}
