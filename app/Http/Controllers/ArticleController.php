<?php

namespace App\Http\Controllers;

use App\Contracts\BreadcrumbsServiceInterface;
use App\Models\Page;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    public function __invoke(Page $page, BreadcrumbsServiceInterface $breadcrumbsService): Response
    {
        return Inertia::render('ArticlePage', [
            'page' => $page,
            'author' => $page->content->author,
            'breadcrumbs' => $breadcrumbsService->generateBreadcrumbs($page),
        ]);
    }
}
