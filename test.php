<?php
// $url = "http://octopart.com/api/v3/parts/search";
// $url .= "?apikey=13835558";
// $url .= "&q=solid+state+relay";
// // $url .= "&pretty_print=true";
//
// // echo $url;
// $content = file_get_contents($url);
// $json = json_decode($content, true);
// print $json["hits"] . "\n";

// $url = "http://octopart.com/api/v3/parts/match";
// $url .= "?apikey=13835558";
//
// $queries = '[
//     {"q": "160-1030-ND",
//      "reference": "line1"}
// ]';
//
// $json_q = json_decode($queries, true);
// // print json_encode($json_q);
// // $url .= '&queries=' . http_build_query($json_q);
// $url .= "&queries=" . urlencode(json_encode($json_q));
//
// $url .= "&include[]=datasheets";
// $url .= "&hide[]=offers";
//
// // print $url . "\n";
//
// $content = file_get_contents($url);
// $json = json_decode($content, true);
// foreach ($json['results'] as $result) {
//     // echo $result['reference'] . "\n";
//     foreach ($result['items'] as $item) {
//         print $item['mpn'] . "\n";
//         print $item['uid'] . "\n";
//         foreach ($item['datasheets'] as $datasheet) {
//             print "\t" . $datasheet['url'] . "\n";
//         }
//     }
// }

require('config_local.php');

function getDatasheets($uid) {
    global $apikey;

    $url = "http://octopart.com/api/v3/parts/";
    $url .= $uid;
    $url .= "?apikey=" . $apikey;
    $url .= "&include[]=datasheets";
    $url .= "&hide[]=offers";
    $content = file_get_contents($url);
    $json = json_decode($content, true);

    $out = array();
    foreach ($json['datasheets'] as $datasheet) {
        try {
            $sources = $datasheet['attribution']['sources'][0]['name'];
        } catch (Exception $e) {
            $sources = '';
        }
        array_push($out, array($sources, $datasheet['url']));
    }
    // print $url;
    return $out;
}

function getUIDs($search) {
    global $apikey;

    $url = "http://octopart.com/api/v3/parts/match";
    $url .= "?apikey=" . $apikey;
    $url .= "&hide[]=offers";

    $queries = '[
        {"q": "' . $search . '",
         "reference": "line1"}
    ]';
    $json_q = json_decode($queries, true);
    $url .= "&queries=" . urlencode(json_encode($json_q));

    $content = file_get_contents($url);
    $json = json_decode($content, true);

    $out = array();
    foreach ($json['results'] as $result) {
        foreach ($result['items'] as $item) {
            $out[$item['uid']] = $item['mpn'];
        }
    }

    return $out;
}

$datasheets = getDatasheets('7ecbb7cb9056a10c');
foreach ($datasheets as $datasheet) {
    print $datasheet[0] . ' : ' . $datasheet[1] . "\n";
}

print "\n";

$uids = getUIDs('160-1030-ND');
foreach ($uids as $uid => $mpn) {
    print $mpn . ' : ' . $uid . "\n";
}

?>