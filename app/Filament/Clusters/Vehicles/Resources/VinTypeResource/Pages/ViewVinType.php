<?php

namespace App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource;

class ViewVinType extends ViewRecord
{
    protected static string $resource = VinTypeResource::class;
    protected ?string $heading = 'Type de matricule';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
