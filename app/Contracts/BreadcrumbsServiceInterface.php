<?php

namespace App\Contracts;

use App\DTOs\BreadcrumbItemDTO;
use App\Models\Page;

interface BreadcrumbsServiceInterface
{
    /**
     * @param Page $page
     * @return array<BreadcrumbItemDTO>
     */
    public function generateBreadcrumbs(Page $page): array;
}
