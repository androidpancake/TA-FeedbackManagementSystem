<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplainReplyRequest extends FormRequest
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
            'complaint_id' => 'exists:complaint,id',
            'admin_id' => 'exists:admin,id',
            'reply' => 'required|string'
        ];
    }
}
