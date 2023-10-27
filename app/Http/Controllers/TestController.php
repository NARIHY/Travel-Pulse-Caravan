<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TestController extends Controller
{
    public function test()
    {
        $array = [
            'BEGIN:VCARD',
            'VERSION:3.0',
            'FN:Brique Web',
            'ORG:Agence de création et marketing digital',
            'TEL:+261340589197',
            'EMAIL:contact@briqueweb.com',
            'URL:https://www.briqueweb.com',
            'ADR:Tana 101 Madagascar',
            'END:VCARD',
        ];


        $string = implode("\n", $array);

        $qrCode = QrCode::size(150)
                        ->color(0, 0, 0)
                        ->generate($string);
        return view('test', [
            'qrCode' => $qrCode
        ]);
    }
}
