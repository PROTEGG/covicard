 <head>
    <meta http-equiv="cache-control" content="no-cache">
    <meta charset="utf-8">
 </head>

<style>
#schrift {
font-family: Arial;
font-size: 25px
}
#schrift2 {
font-family: Arial;
font-size: 30px
}
#schrift3 {
font-family: Arial;
font-size: 15px
}

#infoblock{
    border: 2px solid black;
  border-radius: 8px;
}
</style>


    


 <table width=100% align=center> 
<tr align=center> 

<td   width=266 height=592 align=right>
<?php
session_start();


if(!isset($_SESSION['wppa'])) {
   die("Bitte erst einloggen");   
}



// *********************************************
// prepare PHPMailer-library
// *********************************************

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 

// *********************************************
// get tron-datas
// *********************************************

include('../tron.php');  

// *********************************************
// Receive scanned data from old testcard oovicard
// *********************************************

$suche           = filter_input(INPUT_POST, 'citizen', FILTER_SANITIZE_SPECIAL_CHARS); 
//echo $suche;
$hostTablename   = htmlEntities($_SESSION['wppa']);
$hostTablename   = filter_var($hostTablename, FILTER_SANITIZE_SPECIAL_CHARS);
$data            = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS); 


// *********************************************
// Prepare datas for further use
// *********************************************
 
 //extract citizen's data
 
  $splittedSuche    = preg_split("/[-]/", $suche);
  $suche            = $splittedSuche[1];
 
  
// decrypt scanned data from old testcard  
  
  $encryptedtext    = $hostTablename;
  $cipher           = 'AES-128-CBC';
  $hostTablename    = openssl_decrypt($encryptedtext, $cipher, $key1, $options=0, $iv1);
  $hostTablename    = filter_var($hostTablename, FILTER_SANITIZE_SPECIAL_CHARS);
  
  if($suche!=""){
  $encryptedtext= $suche;
  $cipher = 'AES-128-CBC';
  $suche = openssl_decrypt($encryptedtext, $cipher, $key, $options=0, $iv);
  $flag=0;
  }else{
   $suche=$data; 
   $flag=1;
 
  }
  
  
  
// check if $suche = testcard (token:table:contactdata) or covicard (contactdata only)
// and strip old token and old table, if testacard
/*if($flag!=1){
if ($splittedSuche=preg_split("/[:]/", $suche)){
    $suche=$splittedSuche[2];
}
}*/


// create unique token

$byte=random_bytes (6);
$token = bin2hex($byte);

// create unique control

$byte=random_bytes (6);
$control = bin2hex($byte);

$date           = date("Y-m-d");



// *********************************************
// open database
// *********************************************

$db = mysqli_connect("localhost", $uzibo2, $uzibo3, $uzibo2);

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}


// *********************************************
// check that $token and $control are unique
// *********************************************


$querycontent = mysqli_query($db, "SELECT * FROM $hostTablename WHERE token='$token'");
while($row = mysqli_fetch_object($querycontent))
{$byte=random_bytes (6);
$token = bin2hex($byte);
$querycontent = mysqli_query($db, "SELECT * FROM $hostTablename WHERE token='$token'");
}

$querycontent = mysqli_query($db, "SELECT * FROM $hostTablename WHERE control='$control'");
while($row = mysqli_fetch_object($querycontent))
{$byte=random_bytes (6);
$token = bin2hex($byte);
$querycontent = mysqli_query($db, "SELECT * FROM $hostTablename WHERE control='$control'");
}

// *********************************************
// create hash
// *********************************************

$in             = $suche;


$out            = hash('sha256', $in.$salt,true); 
$idendityHash   = base64_encode($out);

// *********************************************
// INSERT datas in $hostTablename
// *********************************************

$eintrag     = "INSERT INTO $hostTablename (token, control, date, hash) VALUES ( '$token', '$control', '$date', '$idendityHash')";
$eintragen   = mysqli_query($db, $eintrag);  

// *********************************************
// Analyse citizen's data and split in title, firstname, surname and mail-adress
// *********************************************

  header('Content-Type: text/html; charset=UTF-8');
  
  include('phpqrcode.php'); 
  
  $firstarray=preg_split("/[\s,]+/", $suche);
  $numberofelements= count($firstarray);  
  $phone=$firstarray[$numberofelements-1];
  $numberofelementsminus1=$numberofelements-1;
  
  
  
  if ($firstarray[0]=="Dr." or $firstarray[0]=="Dr" or $firstarray[0]=="dr."){
      $first=$firstarray[0]." ".$firstarray[1];
      $firstname = $firstarray[1];
      $sur=$sur.$firstarray[2];
      for($i=3; $i<$numberofelementsminus1; $i++){
          $sur=$sur." ".$firstarray[$i];
        
          
      }
     
      
  }  else { 
      $checker=$firstarray[0]." ".$firstarray[1];
      if ($checker=="Prof. Dr." or $checker=="Prof Dr" or $checker=="prof. dr."){
      $first=$checker." ".$firstarray[2];
      $firstname = $firstarray[2];
      $sur=$sur.$firstarray[3];
      for($i=4; $i<$numberofelementsminus1; $i++){
          $sur=$sur." ".$firstarray[$i];
        
          
      }
     
      
        } else {
      
      
     $first=$firstarray[0];
     $firstname = $firstarray[0];
     $sur=$sur.$firstarray[1];
     for($i=2; $i<$numberofelementsminus1; $i++){
          $sur=$sur." ".$firstarray[$i];
      }
  }
  }

  
  $first_name=$first;
  $surname=$sur;
  $phonepart=preg_split("/[@]/", $phone);
  $phonemail=$phonepart[0];
  if ($phonepart[1]!=null){
  $phonemail1="@".$phonepart[1];}else{
  $phonemail1=$phonepart[1];    
  }
  
// *********************************************
// Create new qr-code-data and encrypt it
// *********************************************
  
  //$cleartext= 't'.$token.":".$hostTablename.':'.$suche;
  $cleartext=$suche;
  //echo $cleartext;
  $cipher = 'AES-128-CBC';
  $ciphertext = openssl_encrypt($cleartext, $cipher, $key, $options=0, $iv);
  $ciphertext = str_replace("+", "%2B", $ciphertext);
  
  
  $token= 't~'.$hostTablename.'~'.$token;
  
  $cleartexttwo = $token;
  $token = openssl_encrypt($cleartexttwo, $cipher, $key, $options=0, $iv);
  $token = str_replace("+", "%2B", $token);
  
  
  $covicode =  $firstname.'-'.$ciphertext.'-'.$token;
  
  //echo $covicode.'<br>';


// *********************************************
// Create image with qr-code
// *********************************************

  $qrcodereader = 'https://kartnbastler.de/bild1.php?Bernd='.$covicode;
  $image=imagecreatefromstring(file_get_contents($qrcodereader));

// *********************************************
// create card-image
// *********************************************
  
  
  $im = @imagecreatetruecolor(250, 78)
      or die('Cannot Initialize new GD image stream');
  $text_color = imagecolorallocate($im, 255, 255, 255);
  imagefill($im, 0, 0, $text_color);
  $text_color = imagecolorallocate($im, 0, 0, 0);
  imagestring($im, 4, 3, 0, $first_name, $text_color);
  imagestring($im, 4, 3, 17, $surname, $text_color);
  $text_color = imagecolorallocate($im, 255, 255, 255);
  $im=imagescale ($im, 175, 60);
  $image3=imagerotate($im, -8, $text_color);
  $image2=imagecreatefromstring(file_get_contents("IMG_0574.png"));
  $image=imagescale ($image, 140, 140);
  $image=imagerotate($image, -8, $text_color);
 
  imagecopy($image2, $image, 66, 300, 0, 0, 145, 145);
  imagecopy($image2, $image3, 63, 470, 0, 0, 120, 40);

// *********************************************
// Print citizen's data to screen
// *********************************************
  
        echo '
  <table align= center valign=top style="font-family: Arial; font-size: 12px; color: black;">
  <tr><td width=100px>Vorname</td><td>'.$first_name.'</td></tr>
  <tr><td>Familienname</td><td>'.$surname.'</td></tr>
  <tr><td>E-Mail-Adresse</td><td>'.$phone.'</td></tr>
  <tr><td colspan="2" style="color: green;"><br>Karte an E-Mail-Adresse versendet.</td></tr>
  
 
  </table><br>
  
  ';
  
 // *********************************************
// print card to screen
// ********************************************* 
  ob_start();
  imagepng($image2);
  $imgData=ob_get_clean();
  
 
  echo'<div   width=266 height=592 align=center><img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'" /></div>';
 
 // *********************************************
// create unique filename and save card in format .png to harddrive of server
// *********************************************

  $date           = date("YmdHis");
  $filename       = $phone.$date.".png";
 
 imagepng($image2, $filename);



// *********************************************
// PSend mail to citizen with card in format .png
// *********************************************

    $mailhost       = 'smtp.hostinger.com';                     
    $mailUsername   = 'bernd.mayer@covicard.de';                    
    $mailPassword   = 'Bas123tard#47';                              
    $mailPort       =  587; 

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                           
    $mail->Host       = $mailhost;                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = $mailUsername;                    
    $mail->Password   = $mailPassword;                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = $mailPort;                                   

    //Recipients
    $mail->setFrom($mailUsername);
    $mail->addAddress($phone);     //Add a recipient
                 //Name is optional
    $mail->addReplyTo($mailUsername);
  

  
    $mail->addAttachment($filename);    //Optional name

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Ihre Testcard';
    $mail->Body    = '<style="font-family: "Arial"; color: black; font-size: "10px";">Sehr geehrte Bürgerin,<br>sehr geehrter Bürger,<br><br>anbei erhalten Sie Ihre heutige Testcard. <br><br>Sie ist 24 Stunden gültig. <br><br>Bitte zeigen Sie zusammen mit der Testcard Ihren Personalausweis. Damit wird sichergestellt, dass nur Sie sich mit der Testcard ausweisen können. <br><br> Auf der Karte sind gespeichert:<br>><li>Eine Zeichenfolge (z.B. H4ssekbnht123), die es nur einmal gibt und Ihnen ganz persönlich zugeordnet ist; die Zeichenfolge wird beim Scannen mit unserer Datenbank abgeglichen. Ist sie vorhanden, ist dies der Nachweis, dass Sie negativ getestet worden sind. In unserer Datenbank ist nur die Zeichenfolge und eine Kontrollnummer gespeichert, nicht dagegen Ihre übrigen Daten, wie z.B. Ihr Name oder Ihre Adresse. Selbst wenn wir aufzeichnen würden (was wir aber NICHT tun), wann, wie oft und wo Ihre Testcard gescannt wird: Wir könnten die Daten nicht auf Sie zurückführen. </li><li>Eine ID-Nummer, die uns identifiziert.</li><li>Ihre Kontaktdaten</li><br>Bitte beachten Sie die beiliegende Datenschutzerklärung.<br><br> Wenn Sie noch Fragen haben, sprechen Sie uns gerne an.<br><br> Mit freundlichen Grüßen<br><br> Ihre Stadt<br><br> ';
    $mail->AltBody = 'Sehr geehrte Bürgerin,\nsehr geehrter Bürger,\n\nanbei erhalten Sie Ihre heutige Testcard.\n\nSie ist 24 Stunden gültig. \n\nBitte zeigen Sie zusammen mit der Testcard Ihren Personalausweis. Damit wird sichergestellt, dass nur Sie sich mit der Testcard ausweisen können. \n\n Auf der Karte sind gespeichert:\n\nEine Zeichenfolge (z.B. H4ssekbnht123), die es nur einmal gibt und Ihnen ganz persönlich zugeordnet ist; die Zeichenfolge wird beim Scannen mit unserer Datenbank abgeglichen. Ist sie vorhanden, ist dies der Nachweis, dass Sie negativ getestet worden sind. In unserer Datenbank ist nur die Zeichenfolge und eine Kontrollnummer gespeichert, nicht dagegen Ihre übrigen Daten, wie z.B. Ihr Name oder Ihre Adresse. Selbst wenn wir aufzeichnen würden (was wir aber NICHT tun), wann, wie oft und wo Ihre Testcard gescannt wird: Wir könnten die Daten nicht auf Sie zurückführen. \n\nEine ID-Nummer, die uns identifiziert.\n\nIhre Kontaktdaten.\n\nBitte beachten Sie die beiliegende Datenschutzerklärung.\n\n Wenn Sie noch Fragen haben, sprechen Sie uns gerne an.\n\n Mit freundlichen Grüßen\n\n Ihre Stadt\n\n';

    $mail->send();

  
} catch (Exception $e) {
    echo "E-Mail konnte nicht verschickt werden. ";
}

// *********************************************
// clean up
// *********************************************
  
  imagedestroy($im);
  imagedestroy($image);
  imagedestroy($image2);
  imagedestroy($image3);
  unlink($filename);

 ?>

 </td>

</tr>

</table>






  
 
