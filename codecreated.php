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
font-size: 40px
}

#schrift2 {
font-family: Verdana;
font-size: 30px;
color: grey;
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
 background-image: url("menuebutton.PNG");
 top: -2em;
}
#buttonIdea{
 background-image: url("ideaFrag.png");
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
  background-color: #FF6A00;
 
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
  window.location.assign("#formular")
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


<br><br><br><br><br><br><br><br><br>
<table  width=100% align=center>
 <tr height=100>
 <td id=schrift align=center><br>Danke - <?php
 
  $suche = $_POST["data"];
  
  $daten =preg_split("/[\s,]+/", $suche);
  $first=$daten[0];
  $sur=$daten[1];
  $phone=$daten[2];
  
  
  echo $first;
  ?>
  - hier ist Deine <br><br> 
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
  
  $suche = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);//htmlentities($_POST["data"]);
 
  
  $daten =preg_split("/[\s,]+/", $suche);
  $first=$daten[0];
  $sur=$daten[1];
  $phone=$daten[2];
  
  $first_name="*".substr($first, 1, 3)."***";
  $surname="**".substr( $sur, 2, 3)."***";
  $phonemail="****".substr($phone, 4, 3)."***";
  $token="";
  
  $cleartext= $suche;
  $cipher = 'AES-128-CBC';
  $ciphertext = openssl_encrypt($cleartext, $cipher, $key, $options=0, $iv);
  $ciphertext = str_replace("+", "%2B", $ciphertext);
   
  $cardcode=$first."-".$ciphertext."-".$token;

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
  $image2=imagecreatefromstring(file_get_contents("IMG_0620.PNG"));
  $image2=imagescale($image2, 320, 657, IMG_BILINEAR_FIXED);
  
  imagecopy($image2, $image, 40, 150, 0, 0, 150, 150);
  imagecopy($image2, $image3, 200, 160, 0, 0, 60, 160);

  
  //imagepng($image2);
  //imagepng($image2, 'covicard.png');
 
  /*ob_start();
  imagepng($image2);
  $imgData=ob_get_clean();
  echo'<img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'" />';*/
  ob_start();
  imagepng($image2);
  $imgData=ob_get_clean();
  echo '<a href="data:image/png;base64,'.base64_encode($imgData).'" download="myCovicard"><img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'"></a>';
 
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
        <br><br> Speichern?  Antippen oder Anklicken.  <br><br>Geht nicht? Screenshot! <br><br> Nicht mein Handy? Abfotografieren!<br><br>Teilen? Finger darauflegen und kurz warten. 
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
        <a href="index.html" style="font-family: Arial; font-size: 30px; text-decoration:none; color: black;" ><b>HOME</b></a><br><br>
        <a href="neu.php" style="font-family: Arial; font-size: 30px;text-decoration:none; color: #FF6A00;" ><b>CARD ERSTELLEN</b></a><br><br>
        <a href="gastro.html" style="font-family: Arial; font-size: 30px;text-decoration:none; color: #8A7B57;" ><b>GASTRO</b></a><br><br>
        <a href="scannerDiary3.php" style="font-family: Arial; font-size: 30px;text-decoration:none; color: orange;" ><b>TAGEBUCH</b></a><br><br>
        <a href="clickandmeet.php" style="font-family: Arial; font-size: 30px;text-decoration:none; color: #A927C9;" ><b>CLICK & MEET</b></a><br><br>
        <a href="authorityentry.php" style="font-family: Arial; font-size: 30px;text-decoration:none; color: green;" ><b>GRÜNER PASS</b></a><br><br><br>_______________________<br><br><br>
        <a href="fileGetter.php" style="font-family: Arial; font-size: 30px;text-decoration:none; color: grey;" >ENTSCHLUESSELER</a><br><br>
        <a href="download.htm" style="font-family: Arial; font-size: 30px;text-decoration:none; color: black;" >Download Scanner-App</a><br><br>
        <a href="labelcreator.php" style="font-family: Arial; font-size: 30px;text-decoration:none;color: black;">Türschild</a><br><br>
        <a href="anleitung.php" style="font-family: Arial; font-size: 30px;text-decoration:none; color: black;" >Anleitung</a><br><br>
        <a href="datenschutzvorgenerator.htm" style="font-family: Arial; font-size: 30px;text-decoration:none; color: black;" >Datenschutz-<br>erklärungsgenerator</a><br><br>
        <a href="impressum.htm" style="font-family: Arial; font-size: 30px;text-decoration:none;color: black;">Impressum</a><br><br>
        <a href="Datenschutz.htm" style="font-family: Arial; font-size: 30px;text-decoration:none;color: black;">Datenschutz</a><br><br>
    </div>

    <div id="IdeaDropdown" class="dropdown-content" style="font-family: Arial; font-size: 20px; text-decoration:none; color: black;" >
        <br><br>
        <b>So geht’s:</b><br><br>

Ich gebe meinen Vornamen, Nachnamen und 
meine E-Mail-Adresse ein. Ich habe keine E-Mail-Adresse,
dann nehme ich meine Telefonnummer.<br><br>

Ob ich „FÜR’S HANDY“ oder „ODER AUF PAPIER“ wähle,
das ist egal. Beide funktionieren genauso.
Der einzige Unterschied ist, dass auf der Visitenkarte 
„ODER AUF PAPIER“ meine Daten auch noch gedruckt
dastehen und ich gleich 9 Karten bekomme. Dann
kann ich z.B. meinem Wirt die Visitenkarte auch einfach 
in die Hand drücken.<br><br>



Die Visitenkarte wird sofort ausgeworfen. Ich 
speichere sie mir dann in die Bildergalerie; dazu muss ich 
sie nur antippen. Oder ich drucke sie mir einfach aus.<br><br>

<b>Sicherheit und Datenschutz:</b><br><br>

Den QR-Code kann JEDER lesen, der einen QR-
Code-Reader auf seinem Handy hat. Der QR-Code 
enthält meine Daten aber zum Teil in verschlüsselter Form.
Nur meinen Vornamen kann ich im Klartext lesen. Die Daten sind mit AES-128-CBC
verschlüsselt.<br><br>

Wenn jemand die restlichen Daten lesen möchte, muss
er hier die Seite oder eine der Apps hacken,
um an den Schlüssel zu kommen. Das ist zwar möglich,
aber warum der Aufwand: Der Angreifer kennt dann meine E-Mail-Adresse –
wow!<br><br>

Aber weiß er dann nicht auch, wo ich war und mit wem ich mich 
getroffen habe? Nein. Wenn der Angreifer wissen möchte, wo ich war 
und mit wem ich mich getroffen habe, muss 
er alle Handys aller Lokale, Geschäfte und Personen in meiner 
Region hacken. Die Daten liegen ja verstreut auf den einzelnen
Geräten und nicht auf einem einzigen Server.
<br><br>
        
    </div>
    
</div>

</div>
<!--******************************* LEGAL-BAR **********************************-->

<table style="width: 100%; font-family: Verdana; font-size: 6;  margin-left: auto; margin-right: auto; left: 0; right: 0;  top:110em; text-align: center; ">
         <tr height = 100px><td></td></tr>
         <tr><td align=center valign=center  id=schrift style="background-color: #FF6A00;  font-family: Verdana; font-size: 12;">
             
              <br>COVICA 2020 * Bilder und Zeichnungen BEM'20 * <a href = "impressum.htm">Impressum</a> * <a href ="Datenschutz.htm">Datenschutz</a> <br><br>
             </td>
            
         </tr>
     </table> 
</body> 
</body> 
 