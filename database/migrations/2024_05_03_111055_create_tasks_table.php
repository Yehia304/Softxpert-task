<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Task\Enums\TaskStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id')->unsigned()->index();
            $table->Integer('parent_task_id')->unsigned()->index()->nullable();
            $table->string('title');
            $table->text('description');
            $table->dateTime('due_date');
            $table->enum('status', TaskStatus::getTaskStatuses());
            $table->timestamps();
            $table->foreign('user_id')->references('id')
                ->on('users')->cascadeOnDelete();
            $table->foreign('parent_task_id')->references('id')
                ->on('tasks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
