<?php

namespace App\Filament\Actions;

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Filament\Actions\Base\CustomFilamentBulkAction;
use App\Filament\Actions\Traits\SendsFilamentNotifications;
use App\Models\Page;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Collection;

class CreateFunnelRedirectAction extends CustomFilamentBulkAction
{
    use SendsFilamentNotifications;

    public static function getActionName(): string
    {
        return 'funnelRedirectPages';
    }

    static function canRun(): bool
    {
        return auth()->user()->can('create redirects');
    }

    public static function handle(Collection $records, array $data): void
    {
        $toPageId = data_get($data, 'toPageId');
        $redirectType = RedirectType::from(data_get($data, 'pageRedirectType'));

        if ($toPageId === null) {
            self::sendErrorNotification('Destination Page ID not found!');
            return;
        }

        /** @var Page|null $toPage */
        $toPage = Page::query()->find($toPageId);

        if ($toPage === null) {
            self::sendErrorNotification('Destination Page not found!');
            return;
        }

        $fromPageIds = $records->pluck('id');

        if ($fromPageIds->contains($toPage->id)) {
            self::sendErrorNotification('Cannot redirect to same Page!');
            return;
        }

        /** @var RedirectServiceInterface $redirectService */
        $redirectService = app()->make(RedirectServiceInterface::class);

        try {
            $records->each(fn(Page $page) => $redirectService->redirectPage($page, $toPage, $redirectType));
        } catch (Exception $exception) {
            self::sendErrorNotification($exception->getMessage());
            return;
        }

        self::sendSuccessNotification('Pages successfully redirected.');
    }

    public static function steps(): array
    {
        return [
            Step::make('To')
                ->description('Redirect selected page(s) to which page?')
                ->schema([
                    Select::make('toPageId')
                        ->label('Destination Page')
                        ->required()
                        ->searchable()
                        ->options(Page::query()->pluck('url', 'id'))
                ]),
            Step::make('Type')
                ->description('What type of redirect should be created?')
                ->schema([
                    Select::make('pageRedirectType')
                        ->label('Redirect type')
                        ->required()
                        ->options([
                            RedirectType::Temporary->value => 'Temporary (302)',
                            RedirectType::Permanent->value => 'Permanent (301)',
                        ]),
                ]),
            Step::make('Confirm')
                ->schema([
                    Textarea::make('notice')
                        ->default('Commence redirect?')
                        ->disabled()
                        ->readOnly()
                ])
        ];
    }
}
