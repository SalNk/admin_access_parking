<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Filament\Resources\CustomerResource\RelationManagers\VehiclesRelationManager;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Main';
    protected static ?string $navigationLabel = 'Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                    ->placeholder('Nkwey Salem Bienvenu')
                    ->label('Nom complet')
                    ->required(),
                TextInput::make('email')
                    ->label('Adresse mail')
                    ->placeholder('salemnk02@gmail.com'),
                TextInput::make('phone')
                    ->label('Téléphone')
                    ->placeholder('+243815229941')
                    ->required()
                    ->minLength(9)
                    ->maxLength(12),
                TextInput::make('residence_info')
                    ->label('Détail de la résidence')
                    ->placeholder('Av. Orientation C/Masina Q/Sans-fil')
                    ->required(),
                FileUpload::make('avatar')
                    ->avatar()
                // ->imageEditor()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->circular(),
                TextColumn::make('full_name')
                    ->searchable()
                    ->sortable()
                    ->label('Nom complet'),
                // TextColumn::make('email'),
                TextColumn::make('phone')
                    ->searchable()
                    ->sortable()
                    ->label('Téléphone'),
                TextColumn::make('residence_info')
                    ->label('Détail de la résidence')
                    ->searchable(),
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
            VehiclesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
