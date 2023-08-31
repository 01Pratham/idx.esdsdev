<?php

if (isset($_POST['action']) && $_POST['action'] == 'push') {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://swayatta.esds.co.in:31199/mobile_crm/opportunity/create_quotation.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => base64_decode($_POST['data']),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/plain'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $arrResp = json_decode($response,true);
    
    echo $arrResp['result']['message'];

}
?>