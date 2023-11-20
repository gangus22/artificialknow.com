<?php

namespace App\Contracts;

use App\Enums\RedirectType;
use App\Exceptions\AlreadyExistingDestinationException;
use App\Models\Cluster;
use App\Models\Page;

interface RedirectServiceInterface
{
    public function createRedirect(string $from, string $to, RedirectType $type): void;

    public function redirectPage(Page $from, Page $to, RedirectType $type): void;

    /**
     * @throws AlreadyExistingDestinationException
     */
    public function redirectCluster(Cluster $from, Cluster $to, RedirectType $type): void;
}
