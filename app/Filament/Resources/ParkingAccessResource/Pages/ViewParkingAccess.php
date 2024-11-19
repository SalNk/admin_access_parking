<?php

namespace App\Filament\Resources\ParkingAccessResource\Pages;

use App\Filament\Resources\ParkingAccessResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewParkingAccess extends ViewRecord
{
    protected static string $resource = ParkingAccessResource::class;
    protected ?string $heading = 'Accès parking';
    public function getBreadcrumb(): string
    {
        return "Custom title";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
