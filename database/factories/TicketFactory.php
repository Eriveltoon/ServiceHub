<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'user_id' => User::factory(),

            'title' => fake()->sentence(),

            'description' => fake()->paragraph(),

            'status' => Ticket::STATUS_OPEN,

            'attachment_path' => null,
        ];
    }
}
