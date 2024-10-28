<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CustomerResource;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;
}
