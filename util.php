<?php

function importCDNs(){
    ?>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!--    jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <?php
}
function getData($url){


// To create a new TimeStamp
    $date = new DateTime();
    $timestamp=$date->getTimestamp();

    $YourPrivateKey="9819d950921d1ceec9fa9eeef51be8038ee6142e";
    $YourPublicKey="ec9517b5c99f49dad3a3d4ede6b4ca69";

//Add your keys here. It would be better if you include them from an external file in production.
    $keys=$YourPrivateKey.$YourPublicKey;
// Add the timestamp to the keys
    $string=$timestamp.$keys;
//Generate MD5 digest, also hash is faster than md5 function
    $md5=hash('md5', $string);

// create a new cURL resource
    $ch = curl_init();

// set URL and other appropriate options
// Query Iron Man by passing value in name parameter
//curl_setopt($ch, CURLOPT_URL, "http://gateway.marvel.com:80/v1/public/characters?ts=$timestamp&apikey=<YourAPIKEY>&hash=$md5&name=Iron%20man");

    curl_setopt($ch, CURLOPT_URL, "$url?apikey=ec9517b5c99f49dad3a3d4ede6b4ca69&ts=$timestamp&hash=$md5");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json')
    );

    //Execute curl
    $output= curl_exec($ch) or die(curl_error());

    $json = json_decode($output, true);
//    print_r($json);

// close cURL resource, and free up system resources
    curl_close($ch);
return $json ;

}