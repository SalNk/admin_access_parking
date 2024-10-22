<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VehicleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VehicleResource\RelationManagers;

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
                            ->label('Modèle')
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
                        TextInput::make('vin')
                            ->required()
                            ->label('Matricule'),
                        TextInput::make('color')
                            ->required()
                            ->label('Couleur'),
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
                TextColumn::make('model')
                    ->label('Modèle')
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
