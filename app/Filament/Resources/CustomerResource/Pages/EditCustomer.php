<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use App\Utils\GenerateQrCode;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerResource;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;
    protected ?string $heading = 'Client';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string|null
    {
        return static::getResource()::getUrl('view', [
            'record' => $this->record
        ]);
    }
}
