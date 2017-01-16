<?php

include('octopart_api.php');
include('digikey_api.php');
include('items.php');

// $datasheets = getDatasheets('7ecbb7cb9056a10c');
// foreach ($datasheets as $datasheet) {
//     print $datasheet[0] . ' : ' . $datasheet[1] . "\n";
// }
//
// print "\n";
//

$digikey = digikeyBarcode('1915241000000015468609');
// echo $test['pn'] . "\n";
// echo $test['quantity'] . "\n";

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

