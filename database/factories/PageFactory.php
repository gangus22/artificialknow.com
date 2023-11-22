<?php

namespace Database\Factories;

use App\Enums\MetaDataEnum;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        $path = fake()->slug();
        return [
            'cluster_id' => null,
            'path' => $path,
            'title_tag' => fake()->title(),
            'url' => $path,
            'meta' => json_encode(MetaDataEnum::DEFAULT_VALUE_FOR_EDITOR),
            'is_redirected' => false,
            'visible' => true,
            'indexed' => true,
            'is_splash_page' => false,
        ];
    }
}
