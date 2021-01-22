<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_view_can_be_rendered()
    {
        $task->Task::factory()->create(['user_id' => 1]);

        $response = $this->get('/edit/'.$task->id);

        $response->assertStatus(200);
    }

}
