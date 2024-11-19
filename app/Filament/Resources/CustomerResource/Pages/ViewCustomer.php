<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\CustomerResource\RelationManagers\VehiclesRelationManager;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;
    protected ?string $heading = 'Client';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            VehiclesRelationManager::class,
        ];
    }
}
