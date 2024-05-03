<?php

namespace App\Domain\Task\Services;

use App\Constants\PaginatePer;
use App\Constants\Roles;
use App\Constants\Status;
use App\Domain\Task\Exceptions\PendingTasksException;
use App\Domain\Task\Models\Task;
use App\Domain\Task\Repositories\TaskRespository;
use App\Domain\Task\Requests\TaskRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    protected $taskRespository;

    public function __construct(TaskRespository $taskRespository)
    {
        $this->taskRespository = $taskRespository;
    }

    public function create($data)
    {
        return $this->taskRespository->create($data);
    }

    public function retrieveTasks(Request $request)
    {
        $request->merge(['user_id' => Auth::id()]);

        if (Auth::user()->role->name == Roles::ADMIN) {
            $data = $request->only(['status']);
        } else {
            $data = $request->only(['user_id', 'status']);
        }
        $query = $this->taskRespository->findAllDescending($data);
        if ($request->has('due_date_from') && $request->has('due_date_to')) {
            $query->whereBetween('due_date', [$request->input('due_date_from'), $request->input('due_date_to')]);
        }
        return $query->get();
    }

    public function retrieveTask($id)
    {
        if (Auth::user()->role->name == Roles::ADMIN) {
            return $this->taskRespository->findOneByOrFail(['id' => $id]);
        }
        return $this->taskRespository->findOneByOrFail(['id' => $id, 'user_id' => Auth::id()]);

    }

    public function updateTask($request, $id)
    {
        $task = self::retrieveTask($id);
        if (Auth::user()->role->name == Roles::ADMIN) {
            $data = $request->all();
        } else {
            $data = $request->only('status');
        }
        if ($request->has("status") && $request->status == Status::COMPLETED) {
            if ($this->checkSubtasks($task) >= 1) {
                throw new PendingTasksException();
            };
        }

        $this->taskRespository->update($task, $data);

        $updatedTask = self::retrieveTask($id);
        if ($updatedTask->parent_task_id) {
            $parentTask = self::retrieveTask($updatedTask->parent_task_id);

            if ($this->checkSubtasks($parentTask) == 0 && $parentTask->status != Status::COMPLETED) {
                $this->taskRespository->update($parentTask, ['status' => Status::COMPLETED]);
            };
        }
        return $updatedTask;
    }

    private function checkSubtasks($task)
    {
        return Task::whereHas('subTasks', function ($query) use ($task) {
            $query->where([['parent_task_id', $task->id], ['status', Status::PENDING]]);
        })->count();
    }
}
