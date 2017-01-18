<?php

require_once 'config_local.php';

function getDatasheets($uid) {
    $url = "http://octopart.com/api/v3/parts/";
    $url .= $uid;
    $url .= "?apikey=" . OCTO_APIKEY;
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

function getInfo($uid) {
    $url = "http://octopart.com/api/v3/parts/";
    $url .= $uid;
    $url .= "?apikey=" . OCTO_APIKEY;
    $url .= "&include[]=short_description";
    $url .= "&include[]=specs";
    // more includes?
    $url .= "&hide[]=offers";
    $content = file_get_contents($url);
    $json = json_decode($content, true);

    $out = array();
    $out['mpn'] = $json['mpn'];
    $out['description'] = $json['short_description'];
    $out['manufacturer'] = array($json['manufacturer']['name'],
            $json['manufacturer']['homepage_url']);

    $out['specs'] = array();
    foreach ($json['specs'] as $name => $spec) {
        $out['specs'][$name] = array('name' => $spec['metadata']['name'],
                'value' => $spec['display_value']);
    }

    return $out;
}

function getUIDs($search, $exact = TRUE) {
    $url = "http://octopart.com/api/v3/parts/match";
    $url .= "?apikey=" . OCTO_APIKEY;
    $url .= "&hide[]=offers";

    $queries = '[
        {"mpn": "' . $search . '",
         "reference": "line1"}
    ]';
    $json_q = json_decode($queries, true);
    $url .= "&queries=" . urlencode(json_encode($json_q));
    if ($exact) {
        $url .= '&exact_only=true';
    }

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