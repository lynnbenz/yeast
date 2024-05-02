<?php

$get_location = $_GET['location'];

/* hier ist unsere URL für die Abfrage der API */    
$url_dhopagachi = "https://api.openaq.org/v2/locations/1236037";
$url_guangzhou = "https://api.openaq.org/v2/locations/7753";
$url_kunjaban = "https://api.openaq.org/v2/locations/11583";
$url_mae_hong_son = "https://api.openaq.org/v2/locations/225648";
$url_hanoi = "https://api.openaq.org/v2/locations/2161312";

$url = '';
if ($get_location == 'dhopagachi') {
    $url = $url_dhopagachi;
} else if($get_location == 'guangzhou') {
    $url = $url_guangzhou;
} else if ($get_location == 'kunjaban'){
    $url = $url_kunjaban;
} else if ($get_location == 'mae_hong_son'){
    $url = $url_mae_hong_son;
} else if ($get_location == 'hanoi') {
    $url = $url_hanoi; 
}

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

curl_close($ch);

// echo $output;


//loop through the data / array with needed information 
$data = json_decode($output, true);
$result = $data['results'][0];

$location = $result['name'];

$lastvalue = '';
$unit = '';

foreach ($result['parameters'] as $measurement) {
    if ($measurement['parameter'] == 'pm25') {
        $lastvalue = $measurement['lastValue'];
        $unit = $measurement['unit'];
    }
}

$air_quality[] = [
    'location' => $location,
    'lastValue' => $lastvalue,
    'unit' => $unit,
    'latitude' => $result['coordinates']['latitude'],
    'longitude' => $result['coordinates']['longitude'],
    ];

// print_r($air_quality);
//echo $air_quality [0]['latitude'];

?>