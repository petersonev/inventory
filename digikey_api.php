<?php

require_once 'config_local.php';

$client = new \SoapClient('https://services.digikey.com/Mobile/MobileV1.asmx?wsdl');
$client->__setSoapHeaders([
    new \SoapHeader(
        'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
        'Security',
        [
            'UsernameToken' => [
                'Username' => DIGI_USER,
                'Password' => DIGI_PASSWORD
            ]
        ]),
    new \SoapHeader(
        'http://services.digikey.com/MobileV1',
        'PartnerInformation',
        [
            'PartnerID' => DIGI_PARTNER_ID
        ]),
    new \SoapHeader(
        'http://services.digikey.com/MobileV1',
        'CustomerNumber',
        0
    ),
    new \SoapHeader(
        'http://services.digikey.com/MobileV1',
        'Language',
        'en'
    ),
]);

function digikeyBarcode($barcode) {
    global $client;

    $lookup = substr($barcode, 0, 7);
    $quantity = substr($barcode, 8, 8);


    try {
        $part = $client->GetProductInfo(['partId' => $lookup]);
        return [
            'pn' => $part->GetProductInfoResult->ManufacturerPartNumber,
            'source' => 'digikey',
            'source_pn' => $part->GetProductInfoResult->DigiKeyPartNumber,
            'manufacturer' => $part->GetProductInfoResult->Manufacturer,
            'description' => $part->GetProductInfoResult->Description,
            'quantity' => (int)$quantity
        ];
    } catch (Exception $e) {
        // print "problem\n";
        return NULL;
    }

}