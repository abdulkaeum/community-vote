<?php

namespace Database\Factories;

use App\Models\Channels;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityLinksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'channel_id' => Channels::factory()->create(),
            'title' => $this->faker->sentence(),
            'link' => $this->faker->url(),
            'approved' => 0
        ];
    }
}
