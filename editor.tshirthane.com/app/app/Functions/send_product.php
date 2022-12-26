<?php 
function sendProduct($data) {
    $url = "https://www.tshirthane.com/api/v2/product/save";
    $api_key = env("JET_API_KEY");
    $api_secret = env("JET_API_SECRET"); 
    // Data
    $data['products'][] = $data;
    
    // Post data via curl
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        "apikey: ".$api_key,
        "apisecret: ".$api_secret,
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
    $result = curl_exec ($ch); 
    dump($result);
    $err = curl_error($ch); 
    
    curl_close ($ch);
    $response = json_decode($result, true);
 //   dump($response);
    if (is_array($response)) {
    
           dump($response);
    
    } else{ // Hatalı
        echo "Hata";
    }
} 


?>
