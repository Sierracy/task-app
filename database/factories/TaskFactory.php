<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence(3),
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Critical']),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Complete']),
            'assigned_to' => $this->faker->name(),
            'due_date' => $this->faker->dateTimeThisDecade()
            
        ];
    }
}
