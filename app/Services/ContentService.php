<?php

namespace App\Services;

use App\Contracts\ContentServiceInterface;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ContentService implements ContentServiceInterface
{

    public function getFilamentContentBuilder(string $name): Builder
    {
        return Builder::make('article')
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
                                        self::getHiddenUuidField(),
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
                                        self::getHiddenUuidField(),
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
                                        self::getHiddenUuidField(),
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
            ]);
    }

    private static function getHiddenUuidField(): Component
    {
        return TextInput::make('id')
            ->uuid()
            ->hidden()
            ->required()
            ->formatStateUsing(fn() => Str::uuid()->toString());
    }
}
