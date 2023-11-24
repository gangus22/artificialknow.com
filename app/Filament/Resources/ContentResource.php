<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Models\Author;
use App\Models\Content;
use App\Models\Page;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
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
                Builder::make('article')
                    ->required()
                    ->columnSpan(2)
                    ->blocks([
                        Block::make('chapter')
                            ->schema([
                                TextInput::make('title')
                                    ->required(),
                                TextInput::make('slug')
                                    ->required(),
                                Builder::make('parts')
                                    ->columnSpan(2)
                                    ->blocks([
                                        Block::make('heading')
                                            ->schema([
                                                TextInput::make('text')
                                                    ->label('content')
                                                    ->required(),
                                                Select::make('level')
                                                    ->options([
                                                        3 => 'h3',
                                                        4 => 'h4',
                                                    ])
                                                    ->mutateDehydratedStateUsing(fn($state) => (int)$state)
                                                    ->required(),
                                            ]),
                                        Block::make('paragraph')
                                            ->schema([
                                                RichEditor::make('htmlContent')
                                                    ->disableToolbarButtons([
                                                        'h1',
                                                        'h2',
                                                        'h3',
                                                        'attachFiles',
                                                        'codeBlock'
                                                    ])
                                                    ->label('Paragraph')
                                                    ->required(),
                                            ]),
                                        Block::make('image')
                                            ->schema([
                                                FileUpload::make('url')
                                                    ->getUploadedFileNameForStorageUsing(
                                                        fn(TemporaryUploadedFile $file): string => str($file->getFilename())
                                                            ->prepend(str($file->getClientOriginalName())->beforeLast('.')->append('-')->toString()),
                                                    )
                                                    ->label('Image')
                                                    ->image()
                                                    ->required()
                                                    ->disk('public'),
                                                TextInput::make('alt')
                                                    ->label('Alt text')
                                                    ->required(),
                                            ]),
                                    ])
                            ])
                    ])
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
