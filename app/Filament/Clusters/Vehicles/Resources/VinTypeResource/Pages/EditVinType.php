<?php

namespace App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource;

class EditVinType extends EditRecord
{
    protected static string $resource = VinTypeResource::class;
    protected ?string $heading = 'Type de matricule';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
