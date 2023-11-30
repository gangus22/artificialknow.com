<?php

namespace App\Filament\Actions\Traits;

use Filament\Notifications\Notification;

trait HasFilamentErrorMessages
{
    final public static function sendErrorMessage(string $message): void
    {
        Notification::make()
            ->title($message)
            ->danger()
            ->send();
    }
}
