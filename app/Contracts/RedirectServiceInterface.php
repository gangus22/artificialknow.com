<?php

namespace App\Contracts;

use App\Enums\RedirectType;
use App\Models\Cluster;

interface RedirectServiceInterface
{
    public function createRedirect(string $from, string $to, RedirectType $type): void;

    public function redirectCluster(Cluster $from, Cluster $to, RedirectType $type): void;
}
