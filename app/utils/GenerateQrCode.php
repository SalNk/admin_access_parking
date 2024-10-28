<?php
namespace App\Utils;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQrCode
{
    static function generateSvg($contentQrCode)
    {
        $qrcode = QrCode::size(200)
            ->color(255, 255, 255)
            ->backgroundColor(0, 0, 0)
            ->generate($contentQrCode);

        $qrCodeToHtml = $qrcode->toHtml();
        $removeXml = preg_replace('/<\?xml.*\?>/', '', $qrCodeToHtml);

        return $removeXml;
    }

    static function generatePng($contentQrCode)
    {
        $qrcode = QrCode::format('png')
            ->color(255, 255, 255)
            ->backgroundColor(0, 0, 0)
            ->generate($contentQrCode);

        return $qrcode;
    }
}