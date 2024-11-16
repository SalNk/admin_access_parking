<?php

namespace App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource;

class CreateModelVehicle extends CreateRecord
{
    protected static string $resource = ModelVehicleResource::class;
    protected ?string $heading = 'Modèle';
}
