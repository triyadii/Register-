<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGenerator_ extends BaseController
{
    public function QrCodeGenerator($id = null, $nama = null)
    {
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create($id)
            ->setEncoding(new Encoding('UTF-8'))
            ->setSize(300)
            ->setMargin(10)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(FCPATH . '/iconRego.png')
            ->setResizeToWidth(50);

        // Create generic label
        $label = Label::create('indAAC Sumut 2025')
            ->setTextColor(new Color(0, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $dataUri = $result->getDataUri();

        $result->saveToFile(FCPATH  . '/qrcode_' . $nama . '.png');
        return $this->response->download(FCPATH  . '/qrcode_' . $nama . '.png', null);

        echo '<img src="' . $dataUri . '" alt="Sobatcoding.com">';
    }
}
