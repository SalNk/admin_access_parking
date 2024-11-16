<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\VehicleResource;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;
    protected ?string $heading = 'Véhicules';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
