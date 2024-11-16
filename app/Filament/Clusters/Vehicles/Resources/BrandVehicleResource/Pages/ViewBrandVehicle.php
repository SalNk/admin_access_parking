<?php

namespace App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource;

class ViewBrandVehicle extends ViewRecord
{
    protected static string $resource = BrandVehicleResource::class;
    protected ?string $heading = 'Marque';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
