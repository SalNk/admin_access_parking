<?php

namespace App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource;

class ListBrandVehicles extends ListRecords
{
    protected static string $resource = BrandVehicleResource::class;
    protected ?string $heading = 'Marques';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
