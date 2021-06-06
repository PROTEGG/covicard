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
width: 16em;
justify-content: center
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
  background-color: green  ;
 
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



<?php
session_start();
include('../tron.php'); 

if(!isset($_SESSION['wppa'])) {
   die("Bitte erst einloggen");   
}else{

$pass         = htmlEntities($_SESSION['appw']);
$tableName    = htmlEntities($_SESSION['wppa']);




// *********************************************
// decrypt $pass and $tableName
// *********************************************
  
  $cleartext=$tableName;
  $cipher = 'AES-128-CBC';
  $tableName = openssl_decrypt($cleartext, $cipher, $key1, $options=0, $iv1);
  

  $cleartext1=$pass;
  $cipher = 'AES-128-CBC';
  $pass = openssl_decrypt($cleartext1, $cipher, $key1, $options=0, $iv1);
 

// *********************************************   
// open database
// *********************************************

$db = mysqli_connect("localhost", $uzibo2, $uzibo3, $uzibo2);

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

$querycontent = mysqli_query($db, "SELECT * FROM $tableName WHERE id ='1'");
while($row = mysqli_fetch_object($querycontent)){
$passIdHash = $row->hash;
}




if(!password_verify($pass, $passIdHash)){ 
  die("Verifikation fehlgeschlagen");    
}else{
 
echo '



<br><br><br>

<table align=center width=100%>
<tr height =50>
    <td align=center style="font-family: Arial; font-size: 80"> 
    
    <b>COVICARD</b><div style="font-family: Arial; font-size: 40; color: green">   Grüner Pass <br><br></div>
    <div style="font-family: Arial; font-size: 40; color: black">appfreie Visitenkarte für Alle<br><br></div>
    </td>
</tr>
</table>
<script>    

//*******************************************
//*******function to sanitize user input tp prevent XSS-Attacks *****
//*******************************************

var sanitizeHTML = function (str) {
	return str.replace(/[^\w. ]/gi, function (c) {
		return \'&#\' + c.charCodeAt(0) + \';\';
	});
};

//*******************************************
//*******wait and click "Scanner-Button"*****
//*******************************************


function promiser() {
  return new Promise(resolve => {
    setTimeout(() => {
      resolve(\'resolved\');
    }, 3000);
  });
}

async function clickScannerButton() {
  const result = await promiser();
  try{
      var ScannerButton=document.getElementById("scannerButton"); 
      ScannerButton.click();
      console.log("klick");
  }
  catch{
      console.log("zu spät");
  }
}

clickScannerButton();


</script>

<script src="html5-qrcode.min3.js"></script>
<br><br><br>
<table align=center width=100%><tr align=center>
<td align=center valign=top>
    <p style="font-size:30px; font-family: Arial; color: green"><br><br>Alte Card scannen oder ...</p>
    <div align=center id="qr-reader" style="vertical-align: middle; justify-content: center; max-width:500; max-height:600px; overflow: hidden; "  border=none></div>
    <div align=center style="font-family: "Arial"; font-size: "10px"; color: red"></div><div align=center id="qr-reader-results"></div><div id="selector"></div> 
    <div align=center id="controllElementes"  style="vertical-align: middle; horizontal-align: middle; border: none"></div> </td></tr><tr><td>
<script>



    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById(\'qr-reader-results\');
        var lastResult, countResults = 0;
        function onScanSuccess(qrCodeMessage) {
            if (qrCodeMessage !== lastResult) {
                ++countResults;
                lastResult = qrCodeMessage;
                qrCodeMessage=sanitizeHTML(qrCodeMessage);
                var form = \'<form id=\"php\" target=\"oframe\" action="tokencreator.php" method=\"post\"><input type=hidden name=\"citizen\" value=\"\'+qrCodeMessage+\'\"></form>\';
                resultContainer.innerHTML=form;
                document.getElementById("php").submit(); 
              
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script></td></tr><tr><td align=center valign=top><p style="font-size:30px; font-family: Arial; color: green"><br><br>... oder Daten neu eingeben.</p>
<form id="php2" target="oframe" action="tokencreator.php" method="post">
<input style="font-size:40px; font-family: Verdana; width: 600px; text-align: center" type="text" id=suche style="justify-content: center" name="data" placeholder="Vorname Nachname E-Mail">
</td></tr><tr><td align=center valign=top border=none><iframe width=400px height=1000px name=oframe frameBorder="0"></iframe></td></tr></table>



</body>
</head>
</html>


'; 
 
}
}
?>
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
         <tr><td align=center valign=center  id=schrift style="background-color: green; color: white">
             
              <br>COVICA 2020 * Bilder und Zeichnungen BEM'20 * <a href = "impressum.htm">Impressum</a> * <a href ="Datenschutz.htm">Datenschutz</a> <br><br>
             </td>
            
         </tr>
     </table> 
</body>