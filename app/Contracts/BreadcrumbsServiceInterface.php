<?php

namespace App\Contracts;

use App\Models\Page;

interface BreadcrumbsServiceInterface
{
    /**
     * @param Page $page
     * @return array<string, string>
     */
    public function generateBreadcrumbs(Page $page): array;
}
