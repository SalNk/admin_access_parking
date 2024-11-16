<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Vehicles;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VehicleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Filament\Resources\VehicleResource\Pages\EditVehicle;
use App\Filament\Resources\VehicleResource\Pages\ListVehicles;
use App\Filament\Resources\VehicleResource\Pages\CreateVehicle;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Main';
    protected static ?string $navigationLabel = 'Voitures';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('customer_id')
                            ->relationship(name: 'customer', titleAttribute: 'full_name')
                            ->label('Client')
                            ->placeholder('Sélectionner le client'),
                        TextInput::make('model')
                            ->required()
                            ->label('Modèle du véhicule')
                            ->placeholder('Veuillez saisir le modèle du véhicule'),
                        TextInput::make('brand')
                            ->required()
                            ->label('La marque du véhicule')
                            ->placeholder('Veuillez saisir la marque du véhicule'),
                        TextInput::make('vin_type')
                            ->required()
                            ->label('Type de matricule')
                            ->placeholder('Veuillez saisir le type de matricule'),
                        TextInput::make('vin')
                            ->required()
                            ->label('Le matricule')
                            ->placeholder(placeholder: 'Veuillez saisir le matricule'),
                        TextInput::make('color')
                            ->required()
                            ->label('Couleur')
                            ->placeholder('Veuillez saisir la couleur du véhicule'),
                        Select::make('transmission')
                            ->options([
                                'MANUAL' => 'Manuel',
                                'AUTOMATIC' => 'Automatique',
                            ])
                            ->required(),
                        Textarea::make('description')
                            ->rows(5)
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.full_name')
                    ->label('Nom du client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model_vehicles.name')
                    ->label('Modèle')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('brand_vehicles.name')
                    ->label('Marque')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vin')
                    ->label('Plaque d\'immatriculation')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('color')
                    ->label('Couleur'),
                TextColumn::make('transmission')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => ListVehicles::route('/'),
            'create' => CreateVehicle::route('/create'),
            'edit' => EditVehicle::route('/{record}/edit'),
        ];
    }
}
