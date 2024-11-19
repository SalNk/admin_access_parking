<?php

namespace App\Filament\Resources\ParkingAccessResource\Pages;

use Filament\Actions;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Utils\GenerateQrCode;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ParkingAccessResource;

class CreateParkingAccess extends CreateRecord
{
    protected static string $resource = ParkingAccessResource::class;
    protected ?string $heading = 'Accès au parking';

    public function getBreadcrumb(): string
    {
        return "Custom title";
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // dd($data);
        if ($data['customer_id'] && $data['vehicle_id']) {

            $vehicule = Vehicle::findOrFail($data['vehicle_id'])->first();
            $customer = Customer::findOrFail($data['customer_id'])->first();

            $formatData =
                'Nom du client : ' . $customer->full_name .
                ' - Modèle du véhicule : ' . $vehicule->model .
                ' - Matricule : ' . $vehicule->vin .
                ' - Couleur : ' . $vehicule->color .
                ' - Heure d\'entrée : ' . $data['entry_time'];

            $qrcode = GenerateQrCode::generateSvg($formatData);

            $data['qrcode'] = $qrcode;

            return $data;
        }
    }
}
