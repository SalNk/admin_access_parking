<?php

namespace App\Filament\Clusters\Vehicles\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\VinType;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Vehicles;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VinTypeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VinTypeResource\RelationManagers;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages\EditVinType;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages\ListVinType;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages\ViewVinType;
use App\Filament\Clusters\Vehicles\Resources\VinTypeResource\Pages\CreateVinType;

class VinTypeResource extends Resource
{
    protected static ?string $model = VinType::class;
    protected static ?string $cluster = Vehicles::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Types de matricule';


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
            'index' => ListVinType::route('/'),
            'create' => CreateVinType::route('/create'),
            'view' => ViewVinType::route('/{record}'),
            'edit' => EditVinType::route('/{record}/edit'),
        ];
    }
}
