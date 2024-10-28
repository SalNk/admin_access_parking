<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use App\Utils\GenerateQrCode;
use Filament\Resources\Pages\CreateRecord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Filament\Resources\CustomerResource;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {


        $formatData =
            'Nom complet : ' . $data['full_name'] .
            'Adresse mail : ' . $data['email'] .
            'Téléphone : ' . $data['phone'] .
            'Détail de la résidence : ' . $data['residence_info'] .
            'Voitures : ' . ' ';

        $qrcode = GenerateQrCode::generateSvg($formatData);

        $data['qrcode'] = $qrcode;

        return $data;
    }
}
