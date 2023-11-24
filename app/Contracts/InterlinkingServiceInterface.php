<?php

namespace App\Contracts;

use App\DTOs\InterlinkItemDTO;
use App\Models\Page;

interface InterlinkingServiceInterface
{
    /**
     * @param Page $page
     * @return array<InterlinkItemDTO>
     */
    public function getInterlinkItems(Page $page): array;
}
