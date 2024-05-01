<?php

//include extract.php
include 'extract.php';



//echo "Hello World!";

//print_r($air_quality);


//make map with lat / lon to location
$locations = [
    '22.56,88.36' => 'Kolkata',
    '23.11,113.31' => 'Guangzhou',
    '23.81,90.41' => 'Dhaka',
    '19.3,97.97' => 'Mae Hong Son',
    '21.02,105.84' => 'Hanoi',
];

// new function air_quality_index
function air_quality($lastvalue) {
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

    $[$index]['temperature_2m'] = round($item['temperature_2m']);   
   
    //convert lat / lon to location
    $coordinates = $item['latitude'] . ',' . $item['longitude'];
   
   // use map to get location
    $weather_data[$index]['location'] = $locations[$coordinates];

    //remove lat / lon
    unset($weather_data[$index]['latitude']);
    unset($weather_data[$index]['longitude']);


// add weather condition
    $weather_data[$index]['condition'] = weather_condition($item['precipitation'], $item['cloud_cover']);

}

print_r($weather_data);





?>