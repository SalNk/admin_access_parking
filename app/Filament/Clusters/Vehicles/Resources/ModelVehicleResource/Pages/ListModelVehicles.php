<?php

namespace App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource;

class ListModelVehicles extends ListRecords
{
    protected static string $resource = ModelVehicleResource::class;
    protected ?string $heading = 'Modèles';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
