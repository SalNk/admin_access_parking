<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class VehiclesRelationManager extends RelationManager
{
    protected static string $relationship = 'vehicles';
    protected static ?string $title = 'Liste des Véhicules';

    public function form(Form $form): Form
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
                                'manual' => 'Manuelle',
                                'automatic' => 'Automatique',
                            ])
                            ->required(),
                        Textarea::make('description')
                            ->rows(5)
                            ->required(),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('model')
            ->columns([
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
                TextColumn::make('transmission'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
