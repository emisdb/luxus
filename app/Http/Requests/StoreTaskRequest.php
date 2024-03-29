<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'completion_date' => 'nullable|date',
            'status' => 'required|in:new,in_progress,complete',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
