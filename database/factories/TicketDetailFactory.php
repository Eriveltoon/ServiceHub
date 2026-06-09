<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::factory(),

            'technical_data' => [
                'priority' => fake()->randomElement([
                    'low',
                    'medium',
                    'high',
                ]),
            ],
        ];
    }
}
