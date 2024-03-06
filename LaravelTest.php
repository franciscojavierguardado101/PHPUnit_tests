<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanCreateProjectAndTasks()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task1 = Task::factory()->create(['project_id' => $project->id]);
        $task2 = Task::factory()->create(['project_id' => $project->id]);

        // Assert
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
        $this->assertDatabaseHas('tasks', ['id' => $task1->id]);
        $this->assertDatabaseHas('tasks', ['id' => $task2->id]);
    }

    public function testUserCanMarkTaskAsCompleted()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a project with a task
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        // Act
        $this->patch("/tasks/{$task->id}/complete");

        // Assert
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'completed' => true]);
    }
}
