<?php

include 'octopart_api.php';
include 'digikey_api.php';
include 'items.php';

/*
// $datasheets = getDatasheets('7ecbb7cb9056a10c');
// foreach ($datasheets as $datasheet) {
//     print $datasheet[0] . ' : ' . $datasheet[1] . "\n";
// }
//
// print "\n";
//

$digikey = digikeyBarcode('2785378000000050359276');
// echo $test['pn'] . "\n";
// echo $test['quantity'] . "\n";

if ($digikey == NULL) {
    exit("Unable to find barcode\n");
}

$uids = getUIDs($digikey['pn']);
// $uids = getUIDs('712-1462-1-ND');
foreach ($uids as $uid => $mpn) {
    // print $mpn . ' : ' . $uid . "\n";
    $info = getInfo($uid);
    // $info = getInfo('7ecbb7cb9056a10c');
    print 'MPN: ' . $info['mpn'] . "\n";
    print 'Quantity: ' . $digikey['quantity'] . "\n";
    print $info['description'] . "\n";
    print $info['manufacturer'][0] . " ({$info['manufacturer'][1]})\n";
    foreach ($info['specs'] as $spec) {
        print '- ' . $spec['name'] . ' : ' . $spec['value'] . "\n";
    }
    // print json_encode($info['specs']);
}
*/

// $connection = New mysqli(HOST, USER, PASSWORD, DATABASE);
// if(! $connection ) {
//     die('Could not connect: ' . mysql_error());
// }
// echo 'Connected successfully';
// $connection->close();

// print digikeyBarcode('2785378000000050359276')['pn'] . "\n";

$input = fopen("input.txt", "r") or die("Unable to open file!");
while(!feof($input)) {
    $line = fgets($input);
    if (strlen($line) == 24) {
        $digikey = digikeyBarcode($line);
        if ($digikey == NULL) {
            print "Unknown\n";
        } else {
            print $digikey['pn'] . "\n";
        }
        // sleep(1);
    } else {
        print $line;
    }
}
fclose($input);