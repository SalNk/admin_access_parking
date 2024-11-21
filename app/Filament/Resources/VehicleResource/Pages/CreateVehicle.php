<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use Filament\Actions;
use App\Utils\GenerateQrCode;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\VehicleResource;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;
    protected ?string $heading = 'Véhicule';
}
