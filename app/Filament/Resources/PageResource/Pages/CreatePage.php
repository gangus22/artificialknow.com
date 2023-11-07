<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Contracts\PageServiceInterface;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    /**
     * @throws BindingResolutionException
     */
    protected function handleRecordCreation(array $data): Model
    {
        /** @var PageServiceInterface $pageService */
        $pageService = app()->make(PageServiceInterface::class);

        $page = $pageService->makePageWithCachedURL($data);

        return parent::handleRecordCreation($page->attributesToArray());
    }
}
