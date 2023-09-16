<?php

namespace Database\Factories;

use App\Models\Cluster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cluster>
 */
class ClusterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slug' => fake()->slug(),
            'parent_id' => null
        ];
    }
}