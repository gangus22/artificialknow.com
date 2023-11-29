<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasCachedUrls
{
    public function getPrefixParentRelationshipName(): string
    {
        return 'parentCluster';
    }

    public function getPathForUrl(): string
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

    /**
     * @template T
     */
    public function cacheUrl(): void
    {
        /** @var T|null $prefixParent */
        $prefixParent = $this->{$this->getPrefixParentRelationshipName()};

        $cachedUrlAttribute = $this->getLocalAttributeToCache();

        $path = $this->{$this->getPathForUrl()};

        if ($prefixParent === null) {
            $this->{$cachedUrlAttribute} = $path;
            return;
        }

        $parentUrl = $prefixParent->{$this->getUrlAttributeOnParent()};

        $urlPrefix = Str::finish($parentUrl, '/');
        $this->{$cachedUrlAttribute} = str($path)->prepend($urlPrefix)->rtrim('/')->toString();
    }
}
