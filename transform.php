<?php

//include extract.php
include 'extract.php';

//make map with lat / lon to location
$city  = [
    '22.3743,88.415' => 'Dhopagachi',
    '23.116785,113.318088' => 'Guangzhou',
    '23.8628276,91.2887362' => 'Kunjaban',
    '19.30455,97.97165' => 'Mae Hong Son',
    '21.2575,105.8514' => 'Hanoi',
];

// new function air_quality_index
function air_quality_color($lastvalue) {
    if ($lastvalue <=  50) {
        return 'good';
    } elseif ($lastvalue <= 100) {
        return 'moderate';
    } elseif ($lastvalue <= 150) {
        return 'unhealthy';
    } elseif ($lastvalue <= 200) {
        return 'dangerous';
    }
   
}

//Transorm data
foreach ($air_quality as $index => $item) {
    $air_quality[$index][''] = round($item['lastValue']);

    //convert lat / lon to location
    $coordinates = $item['latitude'] . ',' . $item['longitude'];
   
   // use map to get location
    $air_quality[$index]['location'] = $city [$coordinates];

    //remove lat / lon
    unset($air_quality[$index]['latitude']);
    unset($air_quality[$index]['longitude']);


// add weather condition
    $air_quality[$index]['air_quality_color'] = air_quality_color($item['lastValue'],);

}

print_r($air_quality);





?>