<?php

namespace App\Domain\Task\Models;

use App\Domain\User\Models\User;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'due_date', 'status', 'parent_task_id'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'due_date' => 'datetime:Y-m-d',
    ];

    protected $attributes = [
        'status'=> "pending"
    ];
    public function subTasks(): HasMany
    {
        return $this->hasMany(Task::class,'parent_task_id');
    }

    public function parentTask(): BelongsTo
    {
        return $this->belongsTo(Task::class,'parent_task_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected static function newFactory()
    {
        return TaskFactory::new();
    }

}
