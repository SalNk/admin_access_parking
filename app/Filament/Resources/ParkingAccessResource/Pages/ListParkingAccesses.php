<?php

namespace App\Filament\Resources\ParkingAccessResource\Pages;

use App\Filament\Resources\ParkingAccessResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParkingAccesses extends ListRecords
{
    protected static string $resource = ParkingAccessResource::class;
    protected ?string $heading = 'Accès au parking';


    public function getBreadcrumb(): string
    {
        return "Custom title";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
