<?php
 include('../tron.php');
  
  $data = filter_input(INPUT_POST, 'pqny', FILTER_SANITIZE_SPECIAL_CHARS); 
  $cleanedData = preg_replace('/\s+/', '+', $data);

  $cleartext= $cleanedData;
  $cipher = 'AES-128-CBC';
  $ciphertext = openssl_encrypt($cleartext, $cipher, $wert, $options=0, $run);
  echo $ciphertext;
?>
 