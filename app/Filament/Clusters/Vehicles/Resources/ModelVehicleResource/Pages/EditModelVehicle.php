<?php

namespace App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource;

class EditModelVehicle extends EditRecord
{
    protected static string $resource = ModelVehicleResource::class;
    protected ?string $heading = 'Modèle';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
