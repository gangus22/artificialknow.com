<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an XML sitemap.';

    public function handle(): void
    {
        $pagesForSitemap = Page::query()
            ->where('indexed', '=', true)
            ->where('visible', '=', true)
            ->where(fn(Builder $query) => $query->has('content')->orWhere('is_splash_page', '=', true))
            ->get();

        Sitemap::create()
            ->add($pagesForSitemap)
            ->writeToDisk('public', 'sitemap.xml');
    }
}
