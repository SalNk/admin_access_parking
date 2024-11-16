<?php

namespace App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource;

class ViewModelVehicle extends ViewRecord
{
    protected static string $resource = ModelVehicleResource::class;
    protected ?string $heading = 'Modèle';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
