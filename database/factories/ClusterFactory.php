<?php

namespace Database\Factories;

use App\Models\Cluster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cluster>
 */
class ClusterFactory extends Factory
{
    protected $model = Cluster::class;

    public function definition(): array
    {
        return [
            'slug' => fake()->slug(),
            'breadcrumbs_title' => fake()->text(),
            'parent_id' => null,
            'is_redirected' => false,
        ];
    }
}
