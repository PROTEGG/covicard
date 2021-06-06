<?php
session_start();

include('../tron.php'); 

// *********************************************
// Receive login
// *********************************************

$login           = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS); 
$password        = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS); 

// *********************************************
// open database
// *********************************************

$db = mysqli_connect("localhost", $uzibo2, $uzibo3, $uzibo2);

if(!$db)
{
  exit();
}


// *********************************************
// check login with db hash
// *********************************************


/*$querycontent = mysqli_query($db, "SELECT * FROM $autID WHERE togger ='$login'");*/

    $querycontent = "SELECT * FROM $autID WHERE togger =?";
    $stmt         = $db->prepare($querycontent); 
    $stmt->bind_param("s", $firstsS);
    $firstsS      = $login;
    $stmt->execute();
    $result       = $stmt->get_result();

while($row = mysqli_fetch_object($result)){
$basser = $row->basser;
}
//echo $basser;
if(password_verify ($password,  $basser)) 
{
     
// create unique tablename

     $byte=random_bytes (8);
     $tableName = bin2hex($byte);
     

// *********************************************
// CREATE TABLE 
// *********************************************

$sql = "CREATE TABLE $tableName (
id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
date DATE DEFAULT NULL,
tablex TEXT NOT NULL,
token TEXT NOT NULL,
control TEXT NOT NULL,
hash TEXT NOT NULL,
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if (mysqli_query($db, $sql)) {
   
} else {
  echo "Probleme beim Erstellen der Tabelle.";
}

$sql = "INSERT INTO $tableName (tablex, hash) VALUES ('0', '0')";
if (mysqli_query($db, $sql)) {
   
} else {
  echo "Probleme beim Anlegen der ersten Zeile.";
}

// *********************************************
// CREATE passID and passIdHash
// *********************************************

     $byte          =   random_bytes (20);
     $passID        =   bin2hex($byte);
 
     $passIdHash    =   password_hash($passID, PASSWORD_DEFAULT);

// *********************************************
// Insert passIdHash in table
// *********************************************
 

     $sql           =   "UPDATE $tableName SET hash='$passIdHash' WHERE id=1";    
     $hell          =   mysqli_query($db, $sql);

// *********************************************
// encrypt $passID encrypt $tableName
// *********************************************
  
  $cleartext    =   $passID;
  $cipher       =   'AES-128-CBC';
  $passID       =   openssl_encrypt($cleartext, $cipher, $key1, $options=0, $iv1);
  
  //echo $passID.'<br>';
  
  $cleartext1   =   $tableName;
  $cipher       =   'AES-128-CBC';
  $tableName    =   openssl_encrypt($cleartext1, $cipher, $key1, $options=0, $iv1);
  
  //echo $tableName.'<br>';
  
 // *********************************************
// Create new qr-code-data and encrypt it
// *********************************************
  
  $_SESSION['wppa'] = $tableName;
  $_SESSION['appw'] = $passID;
 // $tableName=$_SESSION['wppa'];
  //echo $tableName;


  $target="Location: scanner.php";
 
header($target); 
    
}
 ?>