<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Forms\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Group as GroupInfolist;
use Filament\Infolists\Components\Section as SectionInfolist;
use App\Filament\Resources\CustomerResource\RelationManagers\VehiclesRelationManager;

class CustomerResource extends Resource
{
    public $customer;
    protected static ?string $model = Customer::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Main';
    protected static ?string $navigationLabel = 'Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema(static::getDetailsFormSchema())
                    ->columns(3),
                Forms\Components\Section::make('Détails voitures')
                    ->headerActions([
                        Action::make('reset')
                            ->label('Effacer')
                            ->modalHeading('Are you sure?')
                            ->modalDescription('Vous êtes sur le point d\'effacer toutes les véhicules')
                            ->requiresConfirmation()
                            ->color('danger')
                            ->action(fn(Forms\Set $set) => $set('items', [])),
                    ])
                    ->schema([
                        static::getItemsRepeater(),
                    ]),
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
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            VehiclesRelationManager::class,
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                SectionInfolist::make()
                    ->schema([
                        SectionInfolist::make()
                            ->schema([
                                ImageEntry::make('avatar'),
                            ])
                            ->columnSpan(1),
                        SectionInfolist::make('Information du client')
                            ->schema([
                                TextEntry::make('full_name')
                                    ->placeholder('Nkwey Salem Bienvenu')
                                    ->label('Nom complet'),
                                TextEntry::make('email')
                                    ->label('Adresse mail')
                                    ->placeholder('salemnk02@gmail.com'),
                                TextEntry::make('phone')
                                    ->label('Téléphone')
                                    ->placeholder('+243815229941'),
                                TextEntry::make('residence_info')
                                    ->label('Détail de la résidence')
                                    ->placeholder('Av. Orientation C/Masina Q/Sans-fil')
                            ])
                            ->columnSpan(2)
                    ])
                    ->columns(3)
            ]);
    }

    /** @return Forms\Components\Component[] */
    public static function getDetailsFormSchema(): array
    {
        return [
            Group::make()
                ->schema([
                    Section::make()
                        ->schema([
                            FileUpload::make('avatar')
                                // ->imageEditor()
                                ->avatar(),
                        ]),
                ]),
            // Group::make()
            //     ->schema([
            //         Section::make()
            //             ->schema([
            //                 FileUpload::make('avatar')
            //                     ->label('QR CODE')
            //                     // ->imageEditor()
            //                     ->avatar(),
            //             ]),
            //     ]),
            Group::make()
                ->schema([
                    Section::make('Information du client')
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
                                ->maxLength(20),
                            TextInput::make('residence_info')
                                ->label('Détail de la résidence')
                                ->placeholder('Av. Orientation C/Masina Q/Sans-fil')
                                ->required()
                        ])
                ])
                ->columnSpan(['lg' => 2]),
        ];
    }

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('vehicles')
            ->label('La liste de(s) véhicle(s)')
            ->relationship()
            ->schema([
                Section::make()
                    ->schema([
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
                                'manual' => 'Manuelle',
                                'automatic' => 'Automatique',
                            ])
                            ->required(),
                        Textarea::make('description')
                            ->rows(5)
                            ->required(),
                    ])
            ])
            // ->orderColumn('sort')
            ->defaultItems(1)
            ->hiddenLabel()
            ->columns([
                'md' => 10,
            ])
            ->required();
    }
}
