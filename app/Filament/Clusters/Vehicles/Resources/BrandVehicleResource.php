<?php

namespace App\Filament\Clusters\Vehicles\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BrandVehicle;
use Filament\Resources\Resource;
use App\Filament\Clusters\Vehicles;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BrandVehicleResource\Pages;
use App\Filament\Resources\BrandVehicleResource\RelationManagers;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages\EditBrandVehicle;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages\ViewBrandVehicle;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages\ListBrandVehicles;
use App\Filament\Clusters\Vehicles\Resources\BrandVehicleResource\Pages\CreateBrandVehicle;

class BrandVehicleResource extends Resource
{
    protected static ?string $model = BrandVehicle::class;
    protected static ?string $cluster = Vehicles::class;
    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    protected static ?string $navigationLabel = 'Marques';

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
            'index' => ListBrandVehicles::route('/'),
            'create' => CreateBrandVehicle::route('/create'),
            'view' => ViewBrandVehicle::route('/{record}'),
            'edit' => EditBrandVehicle::route('/{record}/edit'),
        ];
    }
}
