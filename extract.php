<?php

$location = $_GET['location'];

/* hier ist unsere URL für die Abfrage der API */    
$url_kolkata = "https://api.openaq.org/v2/locations/8172";
$url_guangzhou = "https://api.openaq.org/v2/locations/7753";
$url_dhaka = "https://api.openaq.org/v2/locations/2445";
$url_yerevan = "https://api.openaq.org/v2/locations/370669";
$url_hanoi = "https://api.openaq.org/v2/locations/2161312";

$url = '';
if ($location == 'kolkata') {
    $url = $url_kolkata;
} else if($location == 'guangzhou') {
    $url = $url_guangzhou;
} else {$location == 'dhaka';
    $url = $url_dhaka;
} else {$location == 'yerevan';
    $url = $url_yerevan;
} else {$location == 'hanoi';
    $url = $url_hanoi;
}

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

curl_close($ch);

// echo $output;





//loop through the data / array with needed information 
$data = json_decode($output, true);
foreach ($data as $item) {
    $latitude = $item['latitude'];
    $longitude = $item['longitude'];
    $temperature = $item['current']['temperature_2m'];
    $precipitation = $item['current']['precipitation'];
    $cloud_cover = $item['current']['cloud_cover'];


    $weather_data[] = [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'temperature_2m' => $temperature,
        'precipitation' => $precipitation,
        'cloud_cover' => $cloud_cover
    ];
    
}

//print_r($weather_data);
//echo $weather_data[0]['latitude'];

?>