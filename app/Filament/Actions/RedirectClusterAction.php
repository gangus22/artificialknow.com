<?php

namespace App\Filament\Actions;

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Models\Cluster;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Actions\StaticAction;

class RedirectClusterAction implements CustomActionInterface
{
    public static function make(): StaticAction
    {
        return BulkAction::make('redirectCluster')
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
                ->description('Redirect to which Cluster?')
                ->schema([
                    Select::make('toClusterId')
                        ->label('Destination Cluster')
                        ->required()
                        ->searchable()
                        ->options(Cluster::query()->pluck('url', 'id'))
                ]),
            Step::make('Type')
                ->description('What type of redirect should be created?')
                ->schema([
                    Select::make('clusterRedirectType')
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
                        ->default('Commence redirect? Note: this will redirect EVERY child cluster and page under the original cluster.')
                        ->disabled()
                        ->readOnly()
                ])
        ];
    }

    private static function getActionCallback(): callable
    {
        return function (Collection $records, array $data) {
            $toClusterId = data_get($data, 'toClusterId');
            $redirectType = RedirectType::from(data_get($data, 'clusterRedirectType'));

            if ($toClusterId === null) {
                self::sendErrorMessage('Destination Cluster ID not found!');
                return;
            }

            /** @var Cluster|null $toCluster */
            $toCluster = Cluster::query()->find($toClusterId);

            if ($toCluster === null) {
                self::sendErrorMessage('Destination Cluster not found!');
                return;
            }

            $fromClusterIds = $records->pluck('id');

            if ($fromClusterIds->contains($toCluster->id)) {
                self::sendErrorMessage('Cannot redirect to same Cluster!');
                return;
            }

            /** @var RedirectServiceInterface $redirectService */
            $redirectService = app()->make(RedirectServiceInterface::class);

            try {
                $records->each(fn(Cluster $cluster) => $redirectService->redirectCluster($cluster, $toCluster, $redirectType));
            } catch (Exception $exception) {
                self::sendErrorMessage($exception->getMessage());
                return;
            }

            Notification::make()
                ->title('Cluster(s) successfully redirected.')
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
