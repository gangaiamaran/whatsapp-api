<?php

declare(strict_types=1);

namespace App\Http\Requests\Messages;

use Illuminate\Foundation\Http\FormRequest;

final class SendMessageRequest extends FormRequest
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
            'chatroom_id' => ['required', 'string', 'exists:chatrooms,id'],
            'content' => ['required', 'string', 'max:2048'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,gif,mp4,mov,avi,mkv'],
        ];
    }
}
