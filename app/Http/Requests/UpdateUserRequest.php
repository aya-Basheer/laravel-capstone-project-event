<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Only organizers can update users.
        return Auth::user() && Auth::user()->isOrganizer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'phone' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'role_id' => 'sometimes|integer|exists:roles,id',
            'status' => 'sometimes|string|in:active,inactive,suspended',
            'password' => 'sometimes|string|min:8|confirmed', // For password resets by admin
        ];
    }
}
