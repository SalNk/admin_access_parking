<?php

namespace App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource;

class CreateBrandVehicle extends CreateRecord
{
    protected static string $resource = BrandVehicleResource::class;
    protected ?string $heading = 'Marque';
}
