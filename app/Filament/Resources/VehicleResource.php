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
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Filament\Resources\VehicleResource\Pages\EditVehicle;
use App\Filament\Resources\VehicleResource\Pages\ListVehicles;
use App\Filament\Resources\VehicleResource\Pages\CreateVehicle;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Main';
    protected static ?string $navigationLabel = 'Véhicules';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('customer_id')
                            ->relationship(name: 'customer', titleAttribute: 'full_name')
                            ->label('Client')
                            ->placeholder('Sélectionner le client')
                            ->columnSpanFull(),
                        TextInput::make('model')
                            ->required()
                            ->label('Modèle du véhicule')
                            ->placeholder('Veuillez saisir le modèle du véhicule')
                            ->datalist([
                                'BMW',
                                'Ford',
                                'Mercedes-Benz',
                                'Porsche',
                                'Toyota',
                                'Volkswagen',
                                'Volvo',
                                'Tata Motors',
                                'Citroën',
                                'Suzuki',
                                'Jeep',
                                'Kia',
                                'Lamborghini',
                                'Land Rover',
                                'Range Rover',
                                'Lexus',
                                'Mazda',
                                'Mitsubishi',
                                'Nissan',
                                'Peugeot',
                                'Renault',
                                'Honda',
                                'Hyundai',
                                'Jaguar',
                                'Audi',
                                'Chevrolet',
                            ]),
                        TextInput::make('brand')
                            ->required()
                            ->label('La marque du véhicule')
                            ->placeholder('Veuillez saisir la marque du véhicule'),
                        Select::make('vin_type')
                            ->options([
                                'Plaque normal CGO' => 'Plaque normal CGO',
                                'Plaque présidentiel PR' => 'Plaque présidentiel PR',
                                'Plaque des nations uni UN' => 'Plaque des nations uni UN',
                            ])
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
                                'manual' => 'Manuelle',
                                'automatic' => 'Automatique',
                            ])
                            ->required(),
                        Section::make('Images')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('vehicle-images')
                                    ->multiple()
                                    ->maxFiles(2)
                                    ->hiddenLabel(),
                            ])
                            ->collapsible(),
                        Textarea::make('description')
                            ->rows(5)
                            ->required()
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('vehicle-image')
                    ->label('Image')
                    ->collection('vehicle-images'),
                TextColumn::make('customer.full_name')
                    ->label('Nom du client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model')
                    ->label('Modèle')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('brand')
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
