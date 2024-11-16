<?php

namespace App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource;

class ListVinType extends ListRecords
{
    protected static string $resource = VinTypeResource::class;
    protected ?string $heading = 'Types de matricule';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
