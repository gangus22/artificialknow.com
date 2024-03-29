<?php

namespace App\Filament\Resources;

use App\Contracts\ContentServiceInterface;
use App\Filament\Resources\ContentResource\Pages;
use App\Models\Author;
use App\Models\Content;
use App\Models\Page;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        /** @var ContentServiceInterface $contentService */
        $contentService = app()->make(ContentServiceInterface::class);

        return $form
            ->schema([
                Select::make('page_id')
                    ->helperText('The page the content should belong to.')
                    ->required()
                    ->getOptionLabelFromRecordUsing(fn(Page $page) => $page->id . ' - ' . $page->url)
                    ->relationship('page')
                    ->columnSpan(2),
                TextInput::make('name')
                    ->helperText('Internal name of the content. Not visible to users.')
                    ->columnSpan(2)
                    ->required(),
                Select::make('author_id')
                    ->helperText('The displayed author for the article.')
                    ->required()
                    ->getOptionLabelFromRecordUsing(fn(Author $author) => $author->name)
                    ->relationship('author'),
                $contentService->getFilamentContentBuilder('article'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
