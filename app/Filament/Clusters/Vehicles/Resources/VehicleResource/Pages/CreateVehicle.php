<?php

namespace App\Filament\Clusters\Vehicles\Resources\VehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Vehicles\Resources\VehicleResource;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;
    protected ?string $heading = 'Véhicule';
}
