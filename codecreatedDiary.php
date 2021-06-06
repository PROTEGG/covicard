<head>
    <title>COVICARD - appfreie Visitenkarte für Kontaktnachverfolgung</title>
  
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="/IMG_0588.PNG" sizes="32x32">
    <meta name="description" content="Corona beim Weggehen: Identifizieren - kontaktlos, hygienisch, automatisch, app-los, internetfrei und ANONYM!"/>
	<meta name="robots" content="noindex"/>

<style>
#tabelle {
 font-family: Arial;
  border-collapse: collapse;
  background-image: url(brand.PNG);
} 

#infoblock{
    border: 2px solid black;
  border-radius: 8px;
}

 
#oben {
 font-family:  Arial;
  background-color: white;
  border: 2px solid #999;
	border-radius: 0.5em;
padding: 20px;
font-size: 30px
} 

#schrift {
font-family: Arial;
font-size: 15px
}

#schrift2 {
    color: #FF6A00;
font-family: Arial;
font-size: 40px
}

#schrift3 {
font-family: Arial;
font-size: 20px
}

#datenschutzschrift {
font-family: Arial;
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

    color: orange;
	font-size: 1.2em;
	transition: width 0.5s ease-in-out;
}

#headline {
font-family: Arial;
font-size: 60px;
color: black;
}

</style>
</head>

<body bgcolor=black  >
    
    <a  href="menue.htm"><img src="menuebutton.PNG" width = 100dp height= 100dp  padding=50px style="right: 3em; top: 3em; position: absolute;"></a>

<table  width=100% align=center>
 <tr height=100>
 <td id=schrift2 align=center><br>Eingetragen!<br><br>
  Möchte Ihr Kontakt eine Covicard?<br><br>
  Hier wäre sie:<br><br><br>
  </td>
  </tr>  
  </table>
 
 <table width=100% align=center> 
<tr> 

<td   width=266 height=592 align=center>
<?php
  //header('Content-Type: image/png');
  header('Content-Type: text/html; charset=UTF-8');
  
  include('phpqrcode.php'); 
  include('../tron.php');
  
  $suche = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
 
  
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
   
  $cardcode=$first."-".$ciphertext;

  $qrcodereader = 'https://kartnbastler.de/bild1.php?Bernd='.$cardcode;
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
  $image2=imagecreatefromstring(file_get_contents("image2.png"));

  imagecopy($image2, $image, 40, 130, 0, 0, 150, 150);
  imagecopy($image2, $image3, 180, 150, 0, 0, 60, 160);

  
  //imagepng($image2);
  //imagepng($image2, 'covicard.png');
  
  ob_start();
  imagepng($image2);
  $imgData=ob_get_clean();
 // echo'<img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'" />';
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
    <td id=schrift2 align=center>
        <br><br>Lifehack: <br><br><br></r>Finger auf Card legen und verschicken oder speichern.<br>
    </td>
</tr>


</table>


<table id=schrift width=100% align = center>
<tr height=100 id=schrift>
    <td id=schrift2 align=center><br><br><br><br><br><br><br></td></tr>
</table>
<table id=schrift width=100% align = center>    
    
    
<tr height=50><td></td></tr>
<tr>
    
    <td  id=schrift width=80% align=center> 
   
   
    <table id=schrift align=center>
 
   
    <tr><td>IOS (Apple) - <b>Speichern</b> </td>
    <td>Finger auf Grafik legen und dort ruhen lassen:<br>"Zu Fotos" hinzufügen" => Covicard jederzeit unter Homebildschirm => App "Fotos" auffinden und aufrufen<br><br></td></tr>
     
     <tr><td> IOS(Apple) - Social-Media und <b>Senden</b></td><td> Finger auf Grafik legen und dort ruhen lassen:<br>"Teilen..." => Social-Media-App oder E-Mail-Programm aussuchen, Empfänger auswählen => senden<br><br></td></tr>
    
    <tr><td><br><br>Android (Samsung, LG, Huawei u.a.) - <b>Speichern</b></td><td><br><br>Finger auf Grafik legen und dort ruhen lassen:<br> "Speichern eines Bilds" => Covicard jederzeit unter Homebildschirm => Fotoapp auffinden und aufrufen oder "Bild herunterladen" => Covicard unter Downloads auffinden und aufrufen<br><br></td></tr>
    <tr><td>Android (Samsung, LG, Huawei u.a.) - Social-Media und <b>Senden</b></td><td> Finger auf Grafik legen und dort ruhen lassen:<br>"Bild senden" => Social-Media-App oder E-Mail-Programm aussuchen, Empfänger auswählen => senden<br><br></td></tr>
    
    </table>
       
    </td>   
</tr>
</table>

     <table width=100%>
         <tr height = 200><td></td>
             <td width=80% id=schrift3 align=center valign=bottom>
              COVICA 2020 * Bilder und Zeichnungen BEM'20 * <a href = "impressum.htm">Impressum</a> * <a href ="Datenschutz.htm">Datenschutz</a>  
             </td>
             <td></td>
         </tr>
     </table>  
 