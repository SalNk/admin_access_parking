<?php

namespace App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource;

class CreateVinType extends CreateRecord
{
    protected static string $resource = VinTypeResource::class;
    protected ?string $heading = 'Type de matricule';
}
