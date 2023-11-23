<?php

namespace App\Filament\Resources;

use App\Filament\Actions\RedirectClusterAction;
use App\Filament\Resources\ClusterResource\Pages;
use App\Models\Cluster;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClusterResource extends Resource
{
    protected static ?string $model = Cluster::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('parent_id')
                    ->helperText('Optional parent cluster. Keep in mind, clusters can only get 2 parents deep!')
                    ->disabledOn('edit')
                    ->relationship('parentCluster')
                    ->getOptionLabelFromRecordUsing(fn(Cluster $cluster) => $cluster->url)
                    ->preload()
                    ->searchable(),
                TextInput::make('slug')
                    ->helperText('URL slug of the cluster.')
                    ->disabledOn('edit')
                    ->required()
                    ->prefix('/')
                    ->maxLength(255),
                TextInput::make('breadcrumbs_title')
                    ->helperText('The title displayed in the Breadcrumbs.')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('slug')
                    ->description(fn(Cluster $cluster) => $cluster->url),
                TextColumn::make('breadcrumbs_title'),
                TextColumn::make('pages_count')
                    ->counts('pages'),
                IconColumn::make('is_redirected')
                    ->boolean()
                    ->trueIcon('heroicon-o-arrows-right-left')
                    ->trueColor('warning')
                    ->falseIcon('heroicon-o-x-mark')
                    ->falseColor('gray')
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([
                RedirectClusterAction::make()
                    ->visible(fn() => auth()->user()->can('create redirects')),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClusters::route('/'),
            'create' => Pages\CreateCluster::route('/create'),
            'edit' => Pages\EditCluster::route('/{record}/edit'),
        ];
    }
}
