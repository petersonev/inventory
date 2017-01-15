<?php

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

?>