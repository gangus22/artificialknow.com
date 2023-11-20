<?php

namespace App\Filament\Resources;

use App\Enums\MetaDataEnum;
use App\Filament\Actions\RedirectPageAction;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Cluster;
use App\Models\Page;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title_tag')
                    ->helperText('The page\'s title tag.')
                    ->required()
                    ->minLength(3)
                    ->columnSpan(2),
                Select::make('cluster_id')
                    ->helperText('The cluster the page should belong to.')
                    ->disabledOn('edit')
                    ->relationship('cluster')
                    ->getOptionLabelFromRecordUsing(fn(Cluster $cluster) => $cluster->url)
                    ->preload()
                    ->searchable(),
                TextInput::make('path')
                    ->helperText('The path of the page. Leave empty for a pillar page.')
                    ->disabledOn('edit')
                    ->nullable(),
                KeyValue::make('meta')
                    ->helperText('The page\'s title tag and metadata.')
                    ->default(MetaDataEnum::DEFAULT_VALUE_FOR_EDITOR)
                    ->editableKeys(false)
                    ->addable(false)
                    ->deletable(false)
                    ->columnSpan(2),
                Fieldset::make('Indexing')
                    ->schema([
                        Checkbox::make('indexed')
                            ->helperText('Should the page be indexed by search engines?')
                            ->default(false),
                        Checkbox::make('visible')
                            ->helperText('Should the page be visible on the site?')
                            ->default(false),
                    ]),
                Fieldset::make('Routing')
                    ->schema([
                        Checkbox::make('is_splash_page')
                            ->helperText('Check only if the Page has its own controller, and does not wish to use the usual article routing.')
                            ->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->numeric(),
                TextColumn::make('title_tag')
                    ->description(fn(Page $page) => $page->url),
                IconColumn::make('visible')
                    ->boolean(),
                IconColumn::make('indexed')
                    ->boolean(),
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
            ->actions([
                //TODO: replicate action
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                RedirectPageAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
