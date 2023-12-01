<?php

namespace App\Filament\Actions\Traits;

use Filament\Notifications\Notification;

trait SendsFilamentNotifications
{
    final public static function sendSuccessNotification(string $message): void
    {
        Notification::make()
            ->title($message)
            ->success()
            ->send();
    }

    final public static function sendErrorNotification(string $message): void
    {
        Notification::make()
            ->title($message)
            ->danger()
            ->send();
    }
}
