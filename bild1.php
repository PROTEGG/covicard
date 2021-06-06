<?php

error_reporting(0);
//ab hier erste Schritte zur Verschlüsselung
/*$suche = $_GET["Bernd"];
$key="3s6v9y$B&E)H@McQ";
$cipher = "aes-128-gcm";
$ciphertext = openssl_encrypt($suche, $cipher, $key);*/


//ab hier der funktionierende QRCode

include('phpqrcode.php'); 
$suche = htmlentities($_GET["Bernd"]);
QRcode::png($suche);
?>
 
