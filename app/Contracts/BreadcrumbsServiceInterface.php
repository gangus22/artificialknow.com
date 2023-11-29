<?php

namespace App\Contracts;

use App\DTOs\BreadcrumbsItemDTO;
use App\Models\Page;

interface BreadcrumbsServiceInterface
{
    /**
     * @param Page $page
     * @return array<BreadcrumbsItemDTO>
     */
    public function generateBreadcrumbs(Page $page): array;
}
