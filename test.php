<?php

require('octopart_api.php');
require('items.php');

// $datasheets = getDatasheets('7ecbb7cb9056a10c');
// foreach ($datasheets as $datasheet) {
//     print $datasheet[0] . ' : ' . $datasheet[1] . "\n";
// }
//
// print "\n";
//
$uids = getUIDs('712-1462-1-ND');
foreach ($uids as $uid => $mpn) {
    // print $mpn . ' : ' . $uid . "\n";
    $info = getInfo($uid);
    // $info = getInfo('7ecbb7cb9056a10c');
    print 'MPN: ' . $info['mpn'] . "\n";
    print $info['description'] . "\n";
    print $info['manufacturer'][0] . " ({$info['manufacturer'][1]})\n";
    foreach ($info['specs'] as $spec) {
        print '- ' . $spec['name'] . ' : ' . $spec['value'] . "\n";
    }
    // print json_encode($info['specs']);
}

