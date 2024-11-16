<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Vehicles extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Main';
    protected static ?string $clusterBreadcrumb = 'Véhicules';
}
