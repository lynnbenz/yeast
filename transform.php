<?php

//include extract.php
include 'extract.php';

//make map with lat / lon to location
$city  = [
    '22.56,88.36' => 'Kolkata',
    '23.11,113.31' => 'Guangzhou',
    '23.81,90.41' => 'Dhaka',
    '19.3,97.97' => 'Mae Hong Son',
    '21.02,105.84' => 'Hanoi',
];

// new function air_quality_index
function air_quality_color($lastvalue) {
    if ($lastvalue <=  25) {
        return 'good';
    } elseif ($lastvalue <= 50) {
        return 'moderate';
    } elseif ($lastvalue <= 75) {
        return 'unhealthy';
    } elseif ($lastvalue <= 100) {
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