<?php

$location = $_GET['location'];

/* hier ist unsere URL für die Abfrage der API */    
$url_kolkata = "https://api.openaq.org/v2/locations/8172";
$url_guangzhou = "https://api.openaq.org/v2/locations/7753";
$url_dhaka = "https://api.openaq.org/v2/locations/2445";
$url_mae_hong_son = "https://api.openaq.org/v2/locations/225648";
$url_hanoi = "https://api.openaq.org/v2/locations/2161312";

$url = '';
if ($location == 'kolkata') {
    $url = $url_kolkata;
} else if($location == 'guangzhou') {
    $url = $url_guangzhou;
} else {$location == 'dhaka';
    $url = $url_dhaka;
} else {$location == 'mae_hong_son';
    $url = $url_mae_hong_son;
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
    $location = $item['location'];
    $lastvalue = $item['lastvalue'];
    $unit = $item['current']['unit'];
    $parameter = $item['current']['parameter'];
    

    $air_quality[] = [
        'location' => $location,
        'lastvalue' => $lastvalue,
        'unit' => $unit,
        'parameter' => $parameter,
        ];
    
}

//print_r($air_quality);
//echo $air_quality [0]['latitude'];

?>