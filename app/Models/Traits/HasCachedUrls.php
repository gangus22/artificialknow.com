<?php

namespace App\Models\Traits;

use App\Models\Cluster;
use Illuminate\Support\Str;

/**
 * @template T
 */
trait HasCachedUrls
{
    public function getPrefixParentRelationshipName(): string
    {
        return 'parentCluster';
    }

    public function getUrlFallback(): string
    {
        return 'slug';
    }

    public function getUrlAttributeOnParent(): string
    {
        return 'url';
    }

    public function getLocalAttributeToCache(): string
    {
        return 'url';
    }

    public function cacheUrl(): void
    {
        /** @var T|null $prefixParent */
        $prefixParent = $this->{$this->getPrefixParentRelationshipName()};

        $fallback = $this->{$this->getUrlFallback()};

        if ($prefixParent === null) {
            $this->{$this->getLocalAttributeToCache()} = $fallback;
            return;
        }

        if ($fallback === null) {
            $this->{$this->getLocalAttributeToCache()} = $prefixParent->{$this->getUrlAttributeOnParent()};
            return;
        }

        $urlPrefix = Str::finish($prefixParent->{$this->getUrlAttributeOnParent()}, '/');
        $this->{$this->getLocalAttributeToCache()} = str($fallback)->prepend($urlPrefix)->toString();
    }
}
