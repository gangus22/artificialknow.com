<?php

namespace App\Filament\Actions;

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Models\Page;
use Exception;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class CreateFunnelRedirectAction implements CustomActionInterface
{
    public static function make(): StaticAction
    {
        return BulkAction::make('funnelPageRedirect')
            ->label('Funnel Page Redirect')
            ->icon('heroicon-o-funnel')
            ->steps(self::getSteps())
            ->action(self::getActionCallback());
    }

    /**
     * @return array<Step>
     */
    private static function getSteps(): array
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

    private static function getActionCallback(): callable
    {
        return function (Collection $records, array $data) {
            $toPageId = data_get($data, 'toPageId');
            $redirectType = RedirectType::from(data_get($data, 'pageRedirectType'));

            if ($toPageId === null) {
                self::sendErrorMessage('Destination Page ID not found!');
                return;
            }

            /** @var Page|null $toPage */
            $toPage = Page::query()->find($toPageId);

            if ($toPage === null) {
                self::sendErrorMessage('Destination Page not found!');
                return;
            }

            $fromPageIds = $records->pluck('id');

            if ($fromPageIds->contains($toPage->id)) {
                self::sendErrorMessage('Cannot redirect to same Page!');
                return;
            }

            /** @var RedirectServiceInterface $redirectService */
            $redirectService = app()->make(RedirectServiceInterface::class);

            try {
                $records->each(fn(Page $page) => $redirectService->redirectPage($page, $toPage, $redirectType));
            } catch (Exception $exception) {
                self::sendErrorMessage($exception->getMessage());
                return;
            }

            Notification::make()
                ->title('Pages successfully redirected.')
                ->success()
                ->send();
        };
    }

    private static function sendErrorMessage(string $message): void
    {
        Notification::make()
            ->title($message)
            ->danger()
            ->send();
    }
}
