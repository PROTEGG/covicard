<?php 

include('../tron.php');

// *********************************************
// get data ( expected incoming request = https://kartnbastler.de/kfdsfescsdckmc23mg4432mn6.php
//                                  ?token="
//                                  +splittedDieurl[2]
//                                  +"&hash="
//                                  +resultedHash; )
// and clean $hash
// *********************************************

$token      = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS); 
$hash       = filter_input(INPUT_GET, 'hash', FILTER_SANITIZE_SPECIAL_CHARS);  

$hash       = str_replace(" ", "+", $hash);

// *********************************************
// decrypt token
// *********************************************

$cleartext    = str_replace("%2B", "+", $token);
$cipher       = 'AES-128-CBC';
$ciphertext   = openssl_decrypt($cleartext, $cipher, $key, $options=0, $iv);
if($ciphertext==false){echo "no";}else{
$token        = str_replace("+", "%2B", $ciphertext);}

// *********************************************
// get switcher, hostTablename and token out of token ($token= 't~'.$hostTablename.'~'.$token)
// *********************************************

$tokenSplittet  = preg_split("/~/", $token);

if($tokenSplittet==false){
    echo "no";
}
else{
    $switcher       = $tokenSplittet[0];
    $hostTablename  = $tokenSplittet[1];
    $token          = $tokenSplittet[2];
}  

// *********************************************
// open database
// *********************************************

$db = mysqli_connect("localhost", $uzibo2, $uzibo3, $uzibo2);

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

// *********************************************
// get token and hash from $hostTablename
// *********************************************

if ($tokenSplittet[0] == "t"){

    //$querycontent = mysqli_query($db, "SELECT * FROM $hostTablename WHERE token=?");
    
    $querycontent = "SELECT * FROM $hostTablename WHERE token=?";
    $stmt = $db->prepare($querycontent); 
    $stmt->bind_param("s", $firstsS);
    $firstsS = $token;
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = mysqli_fetch_object($result))                     //$querycontent))
    {
        $control    = $row->control;
        $safedHash  = $row->hash;
    }


    if ($hash==$safedHash){
        echo $switcher.'-'.$control; 
    }
    else echo "no";
}

//***********************************************************
// check click and meet
//***********************************************************

if ($tokenSplittet[0] == "c"){
    
    // set table in which tokens are stored for all clickandmeets    

    $querycontent = "SELECT * FROM $controltable WHERE token =? AND hostId=?"; 
    $stmt = $db->prepare($querycontent); 
    $stmt->bind_param("ss", $firstsS, $secondS);
    $firstsS = $token;
    $secondS = $hostTablename;
    $stmt->execute();
    $result = $stmt->get_result(); 
 
    /* $querycontent = mysqli_query($db, "SELECT * FROM $controltable WHERE token='$token'AND hostId='$hostTablename'"); */
    while($row = mysqli_fetch_object($result))                       //$querycontent))
    {
        $control    = $row->count;
        // $eintrag     = mysqli_query($db, "DELETE FROM $controltable  WHERE token='$token' AND hostId='$hostTablename'");
    
    }
    $control="clkdmfsldk";
    echo $switcher.'-'.$control; 
}

?>