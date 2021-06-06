<?php
$key = "rb!nBwXv4C%Gr^84";
 $iv = "1234567812345678";
 $cleartext="Bernd+Eugen+01524857";
 $Method = 'AES-128-CBC';
 
 $encrypted = openssl_encrypt($cleartext, $Method, $key, OPENSSL_RAW_DATA, $iv);

$encrypted = base64_encode($encrypted);
 echo $encrypted;

$encrypted1 = "+fBWs6+PDt5zdPlGyL8H4raiah8+tek1i9nOkllgc9k=";
echo "<br>".$encrypted1;
$encrypted1 = base64_decode($encrypted1);   		
$decrypted = openssl_decrypt($encrypted1, $Method, $key, OPENSSL_RAW_DATA, $iv);
echo $decrypted;


?>