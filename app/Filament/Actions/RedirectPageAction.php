<?php

namespace App\Filament\Actions;

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Filament\Actions\Base\CustomFilamentAction;
use App\Filament\Actions\Traits\HasFilamentErrorMessages;
use App\Models\Cluster;
use App\Models\Page;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class RedirectPageAction extends CustomFilamentAction
{
    use HasFilamentErrorMessages;
    
    public static function handle(Model|Page $record, array $data): void
    {
        $toPageClusterId = data_get($data, 'toPageClusterId');
        $toPagePath = data_get($data, 'toPagePath');
        $redirectType = RedirectType::from(data_get($data, 'pageRedirectType'));

        if ($toPageClusterId === null || $toPagePath === null) {
            self::sendErrorMessage('Valid destination Page data not found!');
            return;
        }

        /** @var Cluster|null $cluster */
        $cluster = Cluster::query()->find($toPageClusterId);

        if ($cluster === null) {
            self::sendErrorMessage('Destination Page\'s Cluster not found!');
            return;
        }

        $destinationPage = $record->replicate();
        $destinationPage->cluster()->associate($cluster);
        $destinationPage->path = $toPagePath;
        $destinationPage->cacheUrl();

        $doesDestinationUrlAlreadyExist = Page::query()->where('url', '=', $destinationPage->url)->exists();

        if ($doesDestinationUrlAlreadyExist) {
            self::sendErrorMessage('The path entered already exists under the Cluster! Please use existing Page redirection.');
            return;
        }

        /** @var RedirectServiceInterface $redirectService */
        $redirectService = app()->make(RedirectServiceInterface::class);

        try {
            $redirectService->redirectPage($record, $destinationPage, $redirectType);
        } catch (Exception $exception) {
            self::sendErrorMessage($exception->getMessage());
            return;
        }

        Notification::make()
            ->title('Page successfully redirected to specified URL.')
            ->success()
            ->send();
    }

    public static function getActionName(): string
    {
        return 'redirectPage';
    }

    public static function steps(): array
    {
        return [
            Step::make('To')
                ->description('Create a Page to redirect to')
                ->schema([
                    Select::make('toPageClusterId')
                        ->label('Destination Cluster')
                        ->helperText('The cluster the new page should belong to.')
                        ->options(Cluster::query()->pluck('url', 'id'))
                        ->preload()
                        ->searchable(),
                    TextInput::make('toPagePath')
                        ->label('Path under destination Cluster')
                        ->helperText('The path of the new page.')
                        ->nullable(),
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
                        ->default('Commence redirect? This will create a new Page under the selected Cluster, and move all contents.')
                        ->disabled()
                        ->readOnly()
                ])
        ];
    }
}
