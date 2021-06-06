<!--******************************* HEAD **********************************-->


<head>
    <title>COVICARD - appfreie Visitenkarte für Kontaktnachverfolgung</title>
  
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="/IMG_0588.PNG" sizes="32x32">
    <meta name="description" content="Corona: Identifizieren - kontaktlos, hygienisch, automatisch, app-los, internetfrei und ANONYM!"/>
	<meta name="robots" content="noindex"/>

<!--******************************* STYLE **********************************-->

<style>

#tabelle {
 font-family: Verdana;
  border-collapse: collapse;
  background-image: url(brand.PNG);
} 

#infoblock{
    border: 2px solid black;
  border-radius: 8px;
}

 
#oben {
 font-family:  Verdana;
  background-color: white;
  border: 2px solid #999;
	border-radius: 0.5em;
padding: 20px;
font-size: 30px
} 

#schrift {
color:grey;
font-family: Verdana;
font-size: 15px
}

#schrift2 {
font-family: Verdana;
font-size: 40px
}

#schrift3 {
font-family: Verdana;
font-size: 20px
}

#datenschutzschrift {
font-family: Verdana;
font-size: 20px;
color: black;
}

#suche {
width: 13em;
border: 2px solid #999;
border-radius: 0.5em;
font-size: 1.2em;
transition: width 0.5s ease-in-out;
}

#suche1 {
border: 2px solid #999;
border-radius: 0.5em;
font-size: 1.2em;
transition: width 0.5s ease-in-out;
}

#suche2 {
font-size: 1.2em;
transition: width 0.5s ease-in-out;
}

#headline {
font-family: Verdana;
font-size: 60px;
color: black;
}
#buttonMenue{
 background-image: url("menuebuttonW.png");
 top: -2em;
}
#buttonIdea{
 background-image: url("ideaFragW.png");
 top: -2em;
 right: 8em;
}
#buttonNew{
 background-image: url("makeG.png");
 top: 40em;
}

.dropbtn {
  width: 90px;
  height: 75px;
  background-size: cover;
  cursor: pointer;
  background-color: transparent;
  border: none; 
  position: absolute;
  right: 10px;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: grey;
}

.dropdown {
  position: absolute;
  display: inline-block;
  top: 3em;
  right: 2em;
 
}

.menuebar {
  position: absolute;
  display: inline-block;
  top: 0em;
  width: 100%;
  height: 7em;
  background-color: #A927C9  ;
 
}

.dropdown-content {
  display: none;
  position: relative;
  left: 0px;
  background-color: #fbfbfb;
  min-width: 200px;
  max-width: 500px;
  padding: 20px;
  overflow: none;
  
}

.dropdown-content a {
  position: relative;
  left: 5px;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>

<!--******************************* SCRIPT FOR MENUE BUTTONS **********************************-->

<script>

// ****** When Button clicked, open menue ******

function myFunctionMenue() {
  document.getElementById("MenueDropdown").classList.toggle("show");
}

function myFunctionIdea() {
  document.getElementById("IdeaDropdown").classList.toggle("show");
}

function myFunctionNeu() {
  window.location.assign("neu.php")
}

// ****** When tapped in screen, close menue ******
 
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}




</script>

</head>



<!--******************************* Headline **********************************-->

<br><br><br><br><br><br><br><br>



<table align=center width=100%>
<tr height =50>
    <td align=center style="font-family: Verdana; font-size: 80"> 
    
    <b>COVICARD</b><div style="font-family: Verdana; font-size: 40; color: #A927C9">   shopping </div>
    
    </td>
</tr>
</table>

<table  width=100% align=center>
 <tr height=100>
 <td id=schrift2 align=center><br> <div align=center style="font-size: 50px; font-family: Arial; color: grey"><br><br>Danke, hier ist <br></div><div align=center style="font-size: 50px; font-family: Arial; color: #A927C9">Ihre Shopping- <br>und Ihre Covicard <br><br><br></b></div>
  </td>
  </tr>  
  </table>
 
 <table width=100% align=center> 
<tr align=center> 

<td   width=266 height=592 align=right>
<?php
error_reporting(0);
  //header('Content-Type: image/png');
  header('Content-Type: text/html; charset=UTF-8');

  include('phpqrcode.php'); 
  include('../tron.php');
  
// *********************************************
// Prepare data

$data       = filter_input(INPUT_GET, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
$id         = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$datetime   = filter_input(INPUT_GET, 'datetime', FILTER_SANITIZE_SPECIAL_CHARS);

//open database

$db = mysqli_connect("localhost", $uzibo2, $uzibo3, $uzibo2);

if(!$db)
{
  exit();
}

//get individual data from gaesteliste

$querycontent = "SELECT host, tablename, maxGuestNo, openingTime, closingTime FROM $admintable WHERE controlKey =?"; 
$stmt = $db->prepare($querycontent); 
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result(); 

while($row = mysqli_fetch_object($result))
{ $host = $row->host;
$maxGuestNo = $row->maxGuestNo;
$openingtime = $row->openingTime;
$closingtime = $row->closingTime;
 $tablename= $row->tablename;
}


//create unique token

$byte  = random_bytes (4);
$token = bin2hex($byte);
  
  $suche = $host." ".$datetime;
 
  $secondarray=preg_split("/[\s,+]+/", $data);
  $firstname=$secondarray[0];
 
   $firstarray=preg_split("/[\s,+]+/", $datetime);
   $suche2=$firstarray[0].' '.$firstarray[1];
  $number=(int)$firstarray[2];
  $date=$firstarray[0];
  $date=date("Y-m-d", strtotime($date));
  //echo $tablename;
  //echo $number;
  //echo $datetime;
 
 
  $time=array(0,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','p','q','r','s','t','u','v','w','x','y','z','zz');
  

// *********************************************
// INSERT dates in $tablename
// *********************************************

$requestedTime=$time[$number];

$querycontent = mysqli_query($db, "SELECT * FROM $tablename WHERE date='$date'");
while($row = mysqli_fetch_object($querycontent))
{$actualNumberOfGuests = $row->$requestedTime;

}

$actualNumberOfGuests++;

$eintrag     = mysqli_query($db, "UPDATE $tablename SET $requestedTime = '$actualNumberOfGuests' WHERE date='$date'");

// *********************************************
// INSERT dates in $controlltable
// *********************************************

 $eintrag     = mysqli_query($db, "INSERT INTO $controltable (hostId, token, count) values ('$id', '$token', '0')");


// *********************************************
// close database
// *********************************************

mysqli_close($db);
  
  $cleartext= $data;
 
  $cipher = 'AES-128-CBC';
  $ciphertext = openssl_encrypt($cleartext, $cipher, $key, $options=0, $iv);
  $ciphertext = str_replace("+", "%2B", $ciphertext);
  
  
  $token='c~'.$id.'~'.$token;
  
  
  $cleartext= $token;
 
  $ciphertexttwo = openssl_encrypt($cleartext, $cipher, $key, $options=0, $iv);
  $token = str_replace("+", "%2B", $ciphertexttwo);
   
  
  $covicode =  $firstname.'-'.$ciphertext.'-'.$token;
  


  $qrcodereader = 'https://kartnbastler.de/bild1.php?Bernd='.$covicode;
  $image=imagecreatefromstring(file_get_contents($qrcodereader));
  
  
  $im = @imagecreatetruecolor(200, 60)
      or die('Cannot Initialize new GD image stream');
  $text_color = imagecolorallocate($im, 255, 255, 255);
  imagefill($im, 0, 0, $text_color);
  $text_color = imagecolorallocate($im, 0, 0, 0);
  imagestring($im, 4, 3, 0, $host, $text_color);
  imagestring($im, 4, 3, 17, $suche2, $text_color);
  
  $image3=imagerotate($im, 270, 0);
  $image2=imagecreatefromstring(file_get_contents("IMG_0557.PNG"));

  imagecopy($image2, $image, 23, 366, 0, 0, 200, 200);
  imagecopy($image2, $image3, 195, 386, 0, 0, 60, 190);

  
  //imagepng($image2);
  //imagepng($image2, 'covicard.png');
  
  ob_start();
  imagepng($image2);
  $imgData=ob_get_clean();
 echo '<a href="data:image/png;base64,'.base64_encode($imgData).'" download="covicard"><img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'"></a>';
  
  imagedestroy($im);
  imagedestroy($image);
  imagedestroy($image2);
  imagedestroy($image3);

 ?>
 
 </td><td width=70px> </td><td   width=266 height=592 align=left>
     
     <?php
 
  error_reporting(0);
  $suche = htmlentities($_GET["data"]);
 
  
  $daten =preg_split("/[\s,]+/", $suche);
  $first=$daten[0];
  $sur=$daten[1];
  $phone=$daten[2];
  
  $first_name="*".substr($first, 1, 3)."***";
  $surname="**".substr( $sur, 2, 3)."***";
  $phonemail="****".substr($phone, 4, 3)."***";
  
  $cleartext= $suche;
  $cipher = 'AES-128-CBC';
  $ciphertext = openssl_encrypt($cleartext, $cipher, $key, $options=0, $iv);
  $ciphertext = str_replace("+", "%2B", $ciphertext);
   
  $covicodezwei =  $firstname.'-'.$ciphertext.'-';

  $qrcodereader = 'https://kartnbastler.de/bild1.php?Bernd='.$covicodezwei;
  $image=imagecreatefromstring(file_get_contents($qrcodereader));
  
  
  $im = @imagecreatetruecolor(160, 60)
      or die('Cannot Initialize new GD image stream');
  $text_color = imagecolorallocate($im, 255, 255, 255);
  imagefill($im, 0, 0, $text_color);
  $text_color = imagecolorallocate($im, 0, 0, 0);
  imagestring($im, 4, 3, 0, $first_name, $text_color);
  imagestring($im, 4, 3, 17, $surname, $text_color);
  imagestring($im, 4, 3, 34, $phonemail, $text_color);
  $image3=imagerotate($im, 270, 0);
  $image2=imagecreatefromstring(file_get_contents("IMG_0620.PNG"));
  $image2=imagescale($image2, 288, 592, IMG_BILINEAR_FIXED);
  
  imagecopy($image2, $image, 40, 130, 0, 0, 150, 150);
  imagecopy($image2, $image3, 180, 150, 0, 0, 60, 160);

  
  //imagepng($image2);
  //imagepng($image2, 'covicard.png');
  
  ob_start();
  imagepng($image2);
  $imgData=ob_get_clean();

   echo '<a href="data:image/png;base64,'.base64_encode($imgData).'" download="covicard"><img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'"></a>';
  imagedestroy($im);
  imagedestroy($image);
  imagedestroy($image2);
  imagedestroy($image3);

 ?>
     
     
 </td>

</tr>

</table>

<table align=center>

<tr height=100>
    <td id=schrift2 align=center valign=right>
         <div align=center style="font-size: 30px; font-family: Arial; color: grey"><br><br><br><br>Speichern? <br></div><div align=center style="font-size: 30px; font-family: Arial; color: #A927C9">Mit einem Finger kurz auf eine Card tippen.<br><br><br></div>
        <div align=center style="font-size: 30px; font-family: Arial; color: grey">Funktioniert nicht? Screenshot!<br></div>
        <div align=center style="font-size: 30px; font-family: Arial; color: #A927C9"> iphoneX und aufwärts: Powertaste und gleichzeitig Leisertaste.<br> Andere iPhones: Powertaste und gleichzeitig Homebutton.<br>
        Android: Powertaste und gleichzeitig Leisertaste.<br><br><br></div>
        <div align=center style="font-size: 30px; font-family: Arial; color: grey">Funktioniert auch nicht?<br>
        <div align=center style="font-size: 30px; font-family: Arial; color: #A927C9">Seite abfotografieren - die Cards funktionieren auch als Fotos.</div>
    </td>
</tr>


</table>

<!--******************************* MENUE **********************************-->

<div class="menuebar">

<div class="dropdown">
    
  <button onclick="myFunctionMenue()" class="dropbtn" id=buttonMenue> </button>
  <button onclick="myFunctionIdea()" class="dropbtn" id=buttonIdea> </button>
  <button onclick="myFunctionNeu()" class="dropbtn" id=buttonNew> </button>
  
  <div id="MenueDropdown" class="dropdown-content">
        <a href="index.html" style="font-family: Verdana; font-size: 30px; text-decoration:none; color: black;" ><b>HOME</b></a><br><br>
        <a href="neu.php" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: #FF6A00;" ><b>CARD ERSTELLEN</b></a><br><br>
        <a href="gastro.html" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: #8A7B57;" ><b>GASTRO</b></a><br><br>
        <a href="scannerDiary3.php" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: orange;" ><b>TAGEBUCH</b></a><br><br>
        <a href="clickandmeet.php" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: #A927C9;" ><b>CLICK & MEET</b></a><br><br>
        <a href="authorityentry.php" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: green;" ><b>GRÜNER PASS</b></a><br><br><br>_______________________<br><br><br>
        <a href="fileGetter.php" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: grey;" >ENTSCHLUESSELER</a><br><br>
        <a href="download.htm" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: black;" >Download Scanner-App</a><br><br>
        <a href="labelcreator.php" style="font-family: Verdana; font-size: 30px;text-decoration:none;color: black;">Türschild</a><br><br>
        <a href="anleitung.php" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: black;" >Anleitung</a><br><br>
        <a href="datenschutzvorgenerator.htm" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: black;" >Datenschutz-<br>erklärungsgenerator</a><br><br>
        <a href="impressum.htm" style="font-family: Verdana; font-size: 30px;text-decoration:none;color: black;">Impressum</a><br><br>
        <a href="Datenschutz.htm" style="font-family: Verdana; font-size: 30px;text-decoration:none;color: black;">Datenschutz</a><br><br>
    </div>

    <div id="IdeaDropdown" class="dropdown-content" style="font-family: Verdana; font-size: 20px; text-decoration:none; color: black;" >
        
        <b>Das Problem:</b><br><br>

        Kann meine Oma eine App installieren?<br>
        Soll man mit einem Klick erfahren können,
        wo ich war?<br>
        Habe ich noch genügend Akku?<br><br>

        <b>Die Lösung:</b><br><br>

        Die gute alte <i>Visitenkarte – mit QR-Code®* </i>
        bereit für das 21. Jahrhundert.<br>
        „Zack“ mit dem Handy gescannt.<br>
        Speicherung auf dem Handy, keine Reise durchs Internet und 
        kein zentraler Server.<br><br>

        <b>Die Details:</b><br><br>

        Ich klicke auf „NEU“, und gebe meinen
        Vornamen, Nachnamen und meine E-Mail-Adresse ein.<br>
        Sofort bekomme ich meine Visitenkarte.<br>
        Meine Visitenkarte kann ich dann ausdrucken oder
        in meiner Bildergalerie speichern.<br>

        Jeder scannt jeden. Wenn ich die Visitenkarten meiner 
        Freunde und Bekannten scanne, nehme ich den Scanner 
        hier auf den Seiten. <br>Die Profis, also mein Wirt oder 
        der Klamottenladen, nehmen dafür  Apps. Die 
        sind sicherer. Und genau auf ihre Bedürfnisse zugeschnitten.<br><br>
        
    </div>
    
</div>

</div>
<!--******************************* LEGAL-BAR **********************************-->

<table style="width: 100%; font-family: Verdana; font-size: 6;  margin-left: auto; margin-right: auto; left: 0; right: 0;  top:110em; text-align: center; ">
         <tr height = 300px><td></td></tr>
         <tr><td align=center valign=center  id=schrift style="background-color: #A927C9; color: white">
             
              <br>COVICA 2020 * Bilder und Zeichnungen BEM'20 * <a href = "impressum.htm">Impressum</a> * <a href ="Datenschutz.htm">Datenschutz</a> <br><br>
             </td>
            
         </tr>
     </table> 
</body>

