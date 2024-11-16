<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\VehicleResource;

class EditVehicle extends EditRecord
{
    protected static string $resource = VehicleResource::class;
    protected ?string $heading = 'Véhicule';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
