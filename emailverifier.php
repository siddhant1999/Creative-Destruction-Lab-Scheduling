<?php

$emailad = $_GET["sqlQuery"]; 

$str = "https://api.hunter.io/v2/email-verifier?email=" . $emailad . "&api_key=06d47e8fe21e1dc631531a0c164539132088d481";

$xml = file_get_contents($str);

header('Content-Type: application/json');
    //$abc = json_encode($xml);
    echo $xml;
?>