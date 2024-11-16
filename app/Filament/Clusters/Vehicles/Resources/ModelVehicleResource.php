<?php

namespace App\Filament\Clusters\Vehicles\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ModelVehicle;
use Filament\Resources\Resource;
use App\Filament\Clusters\Vehicles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ModelVehicleResource\Pages;
use App\Filament\Resources\ModelVehicleResource\RelationManagers;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages\EditModelVehicle;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages\ViewModelVehicle;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages\ListModelVehicles;
use App\Filament\Clusters\Vehicles\Resources\ModelVehicleResource\Pages\CreateModelVehicle;

class ModelVehicleResource extends Resource
{
    protected static ?string $model = ModelVehicle::class;
    protected static ?string $cluster = Vehicles::class;
    protected static ?string $navigationLabel = 'Modèles';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModelVehicles::route('/'),
            'create' => CreateModelVehicle::route('/create'),
            'view' => ViewModelVehicle::route('/{record}'),
            'edit' => EditModelVehicle::route('/{record}/edit'),
        ];
    }
}
