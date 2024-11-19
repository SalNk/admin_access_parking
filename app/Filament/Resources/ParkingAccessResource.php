<?php

namespace App\Filament\Resources;

use App\Models\Customer;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ParkingAccess;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ParkingAccessResource\Pages;
use Filament\Infolists\Components\Group as GroupInfolist;
use Filament\Infolists\Components\Section as SectionInfolist;
use App\Filament\Resources\ParkingAccessResource\RelationManagers;

class ParkingAccessResource extends Resource
{
    protected static ?string $model = ParkingAccess::class;
    protected static ?string $navigationGroup = 'Parking';
    protected static ?string $navigationLabel = 'Accès parking';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-end-on-rectangle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('customer_id')
                            // ->relationship('customer', 'full_name')
                            // ->searchable()
                            ->columnSpan(2)
                            ->label('Client')
                            ->placeholder('Sélectionner le client')
                            ->options(Customer::all()->pluck('full_name', 'id')->toArray())
                            ->reactive()
                            ->afterStateUpdated(fn(callable $set) => $set('vehicle_id', null)),
                        Select::make('vehicle_id')
                            ->label('Véhicule')
                            ->placeholder('Sélectionner la voiture')
                            ->relationship(
                                name: 'vehicle',
                                modifyQueryUsing: fn(Builder $query) => $query
                                    ->orderBy('model')
                                    ->orderBy('brand')
                                    ->orderBy('color')
                                    ->orderBy('vin')
                            )
                            ->getOptionLabelFromRecordUsing(fn(Model $record)
                                => "{$record->model} - {$record->brand} - {$record->color} - {$record->vin}")

                            // ->options(function (callable $get) {
                            //     $customer = Customer::find($get('customer_id'));
                            //     if ($customer) {
                            //         return $customer->vehicles->pluck('model', 'id');
                            //     }
                            //     return Vehicle::all()->pluck('model', 'id');
                            // })
                            ->reactive(),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'parked' => 'Garée',
                                'exit' => 'Sortie',
                            ])
                            ->default('parked'),
                        TimePicker::make('entry_time')
                            ->label('Heure d\'entrée')
                            ->default('now')
                            ->format('H:i:s'),
                        TimePicker::make('exit_time')
                            ->label('Heure de sortie')
                            ->format('H:i:s')
                            ->disabled(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
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
                TextColumn::make('vehicle.model')
                    ->label('Modèle de la voiture')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vehicle.brand')
                    ->label('Marque')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vehicle.color')
                    ->label('Couleur')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vehicle.vin')
                    ->label('Matricule')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Statut')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        $translations = [
                            'parked' => "Garée",
                            'exit' => "Sortie"
                        ];

                        return $translations[$state] ?? $state;
                    }),
                TextColumn::make('entry_time')
                    ->label('Heure d\'entrée')
                    ->dateTime('H:i:s'),
                TextColumn::make('exit_time')
                    ->label('Heure de sortie')
                    ->default('-')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParkingAccesses::route('/'),
            'create' => Pages\CreateParkingAccess::route('/create'),
            'edit' => Pages\EditParkingAccess::route('/{record}/edit'),
            'view' => Pages\ViewParkingAccess::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = static::$model;

        return (string) $modelClass::where('status', 'parked')->count();
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                SectionInfolist::make()
                    ->columns(3)
                    ->schema([
                        SectionInfolist::make("QR CODE")
                            ->columnSpan(1)
                            ->schema([
                                ViewEntry::make('qrcode')
                                    ->label('QR Code')
                                    ->view('components.qrcode'),
                            ]),
                        SectionInfolist::make('Information du client')
                            ->columnSpan(2)
                            ->schema([
                                TextEntry::make('customer.full_name')
                                    ->label('Nom du client')
                                    ->columnSpan(2),
                                TextEntry::make('vehicle.model')
                                    ->label('Modèle de la voiture'),
                                TextEntry::make('vehicle.brand')
                                    ->label('Marque'),
                                TextEntry::make('vehicle.color')
                                    ->label('Couleur'),
                                TextEntry::make('vehicle.vin')
                                    ->label('Plaque de la voiture'),
                                TextEntry::make('entry_time')
                                    ->label('Heure d\'entrée')
                                    ->dateTime('H:i:s'),
                                TextEntry::make('exit_time')
                                    ->label('Heure de sortie')
                                    ->dateTime('H:i:s'),
                            ])
                    ])
            ]);
    }
}
