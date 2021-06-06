<head>
    <title>COVICARD - Holen Sie sich Ihre COVICARD.</title>
  
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   
    <meta name="description" content="Corona beim Shoppen: Identifizieren - kontaktlos, hygienisch, automatisch, app-los, internetfrei und ANONYM!"/>
	<meta name="robots" content="noindex"/>

<style>

#oben {
 font-family:  Arial;
  background-color: white;
  border: 2px solid #999;
	border-radius: 0.5em;
padding: 20px;
font-size: 20px
} 


</style>
</head>




<table align=center id=oben width=40%>
    <tr><td>

<?php

include('../tron.php');

// *********************************************
// Prepare datas for further use
// *********************************************


// read data from syscreator 

$host          = filter_input(INPUT_POST, 'host', FILTER_SANITIZE_SPECIAL_CHARS); 
$empfaenger    = filter_input(INPUT_POST, 'empfaenger', FILTER_SANITIZE_SPECIAL_CHARS); 
$maxGuestNo    = filter_input(INPUT_POST, 'maxGuestNo', FILTER_SANITIZE_SPECIAL_CHARS); 
$openingTime   = filter_input(INPUT_POST, 'openingTime', FILTER_SANITIZE_SPECIAL_CHARS); 
$closingTime   = filter_input(INPUT_POST, 'closingTime', FILTER_SANITIZE_SPECIAL_CHARS); 

// create unique tablename

$byte=random_bytes (20);
$tablename = bin2hex($byte);

// create unique controlKey

$byte=random_bytes (4);
$controlKey = bin2hex($byte);

// create variables and settings for e-mail

$header = 'From: noreply@covicard.de' . "\n" .
    'Reply-To: noreply@covicard.de' . "\n" .
    'Content-Type: text/html; charset=\"UTF-8\"; format=flowed \n'.
    'X-Mailer: PHP/' . phpversion();

$betreff = 'COVICARD - Click and Meet für '.$host;

// *********************************************
// open database
// *********************************************

$db = mysqli_connect("localhost", "$uzibo2", "$uzibo3", "$uzibo2");

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}
// *********************************************
// check that $control is unique
// *********************************************


$querycontent = mysqli_query($db, "SELECT * FROM $hostTablename WHERE controlKey='$controlKey'");

while($row = mysqli_fetch_object($querycontent))
{$byte=random_bytes (4);
$controlKey = bin2hex($byte);
$querycontent = mysqli_query($db, "SELECT * FROM $hostTablename WHERE controlKey='$controlKey'");
}

// *********************************************
// INSERT dates in hostTable
// *********************************************
$stmt = $db->prepare("INSERT INTO $hostTablename (host, tablename, maxGuestNo, controlKey) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstS, $sencondS, $thirdS, $fourthS);

// set parameters and execute
$firstS = $host;
$sencondS = $tablename;
$thirdS = $maxGuestNo;
$fourthS = $controlKey;
$stmt->execute();

// *********************************************
// CREATE MAIN TABLE * CREATE LINKS * DISPLAY LINKS * SEND MAIL WITH LINKS
// *********************************************

$sql = "CREATE TABLE $tablename (
id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
date DATE DEFAULT NULL,
nb INT(100) NOT NULL,
a INT(3) NOT NULL,
b INT(3) NOT NULL,
c INT(3) NOT NULL,
d INT(3) NOT NULL,
e INT(3) NOT NULL,
f INT(3) NOT NULL,
g INT(3) NOT NULL,
h INT(3) NOT NULL,
i INT(3) NOT NULL,
j INT(3) NOT NULL,
k INT(3) NOT NULL,
l INT(3) NOT NULL,
m INT(3) NOT NULL,
n INT(3) NOT NULL,
o INT(3) NOT NULL,
p INT(3) NOT NULL,
q INT(3) NOT NULL,
r INT(3) NOT NULL,
s INT(3) NOT NULL,
t INT(3) NOT NULL,
u INT(3) NOT NULL,
v INT(3) NOT NULL,
w INT(3) NOT NULL,
x INT(3) NOT NULL,
y INT(3) NOT NULL,
z INT(3) NOT NULL,
zz INT(3) NOT NULL
)";


if (mysqli_query($db, $sql)) {
   
} else {
  echo "Probleme beim Erstellen der Tabelle.";
}


// *********************************************
// INSERT dates in MAIN TABLE
// *********************************************

// Calculate date

$o=1;
$i=0;

while($o <13){
        
        $preDate        = new Datetime('+'.$i.'day');
        $date           = $preDate->format('Y-m-d');

        $day            = date("l", strtotime($date));
        
       
        
        
        if($day != "Sunday") {
            
            $eintrag     = "INSERT INTO $tablename (date, nb) VALUES ('$date', '$o')";
            $eintragen   = mysqli_query($db, $eintrag); 
          $o++;  
          
        }
        
       $i++;
         
}

// *********************************************
// close database
// *********************************************

mysqli_close($db);
 
// *********************************************
// send Mail
// ********************************************* 
       
$nachricht ='<span style font-family:Arial>Liebes Team von '.$host.',<br><br>
        
        dieser Link führt zur Eurer Buchungsseite. <br><br>
        
        <a href="https://covicard.de/calendar.php?id='.$controlKey.'">https://covicard.de/calendar.php?id='.$controlKey.'</a>
        
        <br><br> Am Ende der Seite findet Ihr einen QR-Code, den Ihr kopieren und in Eure Werbung einbauen könnt. Der QR-Code öffnet die Buchungsseite.<br><br>
        
        Ihr wollt die Buchnungsseite auf Eurer Webseite einbinden? Benutzt den folgenden Code:<br><br>
        <xmp>
         <iframe src="https://covicard.de/calendar.php?id='.$controlKey.'" width="630px" height="1010px" style="border:1px solid black;"></iframe>  
        </xmp>
        <br><br>
        Wenn Ihr die Buchungskarten scannt, könnt Ihr prüfen, ob Sie über Eure Buchungsseite erstellt wurden. Achtet dafür darauf, dass folgender Code eingeblendet wird:<br><br>
        
        <b>'.$controlKey.'</b><br><br>
        
        Auf der Buchungsseite werden die verfügbaren Plätze angezeigt. Wenn Ihr also zulasst, dass Kunden vor Ort buchen, vergesst nicht,  die Buchung durchzuführen.<br><br>
        
        Viele Gr&uuml;&szlig;e, Euer<br><br>
        Bernd Mayer </span>';      
        
        mail($empfaenger, $betreff, $nachricht, $header);

?>

Liebes Team von <?php echo $host ?>,<br><br>
        
        dieser Link führt zur Eurer Buchungsseite. <br><br>
        
        <a href="https://covicard.de/calendar.php?id=<?php echo $controlKey;?>">https://covicard.de/calendar.php?host=<?php echo $host.'&id='.$controlKey;?></a>
        
        <br><br> Am Ende der Seite findet Ihr einen QR-Code, den Ihr kopieren und in Eure Werbung einbauen könnt. Der QR-Code öffnet die Buchungsseite.<br><br>
        
        Ihr wollt die Buchnungsseite auf Eurer Webseite einbinden? Benutzt den folgenden Code:<br><br>
        <xmp>
         <iframe src="https://covicard.de/calendar.php?id="<?php echo $controlKey;?>" width="630px" height="1010px" style="border:1px solid black;"></iframe>
        </xmp>
        <br><br>
       
        
        Auf der Buchungsseite werden die verfügbaren Plätze angezeigt. Wenn Ihr also zulasst, dass Kunden vor Ort buchen, vergesst nicht,  die Buchung durchzuführen.<br><br>
        
        Viele Gr&uuml;&szlig;e, Euer<br><br>
        Bernd Mayer </span>   

<?php
  //header('Content-Type: image/png');
  header('Content-Type: text/html; charset=UTF-8');

  include('phpqrcode.php'); 
  include('../tron.php');
  
  $text='https://covicard.de/calendar.php?id='.$tablename;
  
  $qrcodereader = 'https://kartnbastler.de/bild1.php?Bernd='.$text;

 
  $image=imagecreatefromstring(file_get_contents($qrcodereader));
  
  
  ob_start();
  imagepng($image);
  $imgData=ob_get_clean();
  echo'<br><br><img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'" />';
  
  
  imagedestroy($image);
 

 ?></td></tr></table>