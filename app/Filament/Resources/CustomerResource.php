<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Group as GroupInfolist;
use Filament\Infolists\Components\Section as SectionInfolist;
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
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                GroupInfolist::make()
                    ->schema([
                        SectionInfolist::make()
                            ->schema([
                                ImageEntry::make('avatar'),
                            ]),
                    ]),
                GroupInfolist::make()
                    ->schema([
                        SectionInfolist::make()
                            ->schema([
                                ViewEntry::make('qrcode')
                                    ->label('QR Code')
                                    ->view('components.qrcode'),
                            ]),
                    ]),
                GroupInfolist::make()
                    ->schema([
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
                    ])
                    ->columnSpan(['lg' => 2]),
            ]);
    }
}
