<?php

namespace App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource;

class EditBrandVehicle extends EditRecord
{
    protected static string $resource = BrandVehicleResource::class;
    protected ?string $heading = 'Marque';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
