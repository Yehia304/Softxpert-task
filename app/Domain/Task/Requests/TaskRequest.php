<?php

namespace App\Domain\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|string|unique:tasks',
            'description' => 'required|string|max:500',
            'user_id' => 'required|integer|exists:users,id',
            'due_date' => 'required|date|after:yesterday',
            'parent_task_id' => 'nullable|exists:tasks,id',
        ];
    }
}
