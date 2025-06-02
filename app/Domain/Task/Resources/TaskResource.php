<?php

namespace App\Domain\Task\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
            'user' => $this->user->name,
            'parent_task' => $this->parent_task_id ? $this->parentTask->title : null,
            'status' => $this->status,
            'sub_tasks' => $this->subTasks,
        ];
    }
}
