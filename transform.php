<?php

//include extract.php
include 'extract.php';

//make map with lat / lon to location
$city  = [
    '22.37,88.41' => 'Dhopagachi',
    '23.11,113.31' => 'Guangzhou',
    '23.86,91.28' => 'Kunjaban',
    '19.3,97.97' => 'Mae Hong Son',
    '21.02,105.84' => 'Hanoi',
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

    $air_quality[$index][''] = round($item['lastvalue']);   
   
    //convert lat / lon to location
    $coordinates = $item['latitude'] . ',' . $item['longitude'];
   
   // use map to get location
    $air_quality[$index]['location'] = $city [$coordinates];

    //remove lat / lon
    unset($air_quality[$index]['latitude']);
    unset($air_quality[$index]['longitude']);


// add weather condition
    $air_quality[$index]['air_quality'] = air_quality_color($item['lastvalue'],);

}

print_r($air_quality);





?>