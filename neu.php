<!--******************************* HEAD **********************************-->


<head>
    <title>COVICARD - appfreie Visitenkarte für Kontaktnachverfolgung</title>
  
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
   
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
    border: 2px solid #FFD800;
  border-radius: 8px;
 
}
#infoblock1{
    border: 2px solid grey;
  border-radius: 8px;
 
}
 
#oben {
 font-family:  Verdana;

  border: 2px solid #999;
	border-radius: 0.5em;
padding: 20px;
background: rgba(255, 216, 0, 0.05);
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
  background-color: #FFD800  ;
 
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
    
    <b>COVICARD</b><div style="font-family: Verdana; font-size: 40; color: #FFD800">   CARD ERSTELLEN <br><br></div>
    <div style="font-family: Verdana; font-size: 40; color: black">appfreie Visitenkarte für Alle<br><br></div><br>
    </td>
</tr>


</table>



<table width = 80% align=center>
<tr height =600px>
    <td align=center valign=center>
        
        
      <img src="eingabe.png"  style=" -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);" width=250px>  
        
        
    </td>
    <td width=100px> 
    <img src="pfeil.png" style="transform: rotate(-90deg);opacity: 0.5;" width=50px>
    </td>
    
    <td align=center >
  
   <img src="covicardexample1.png" id=infoblock width=250px>
   
   </td>  
   <td width=100px> 
    <img src="pfeil.png" style="transform: rotate(-90deg);opacity: 0.5;" width=50px>
    </td>
     <td align=center valign=center>
        
        
      <img src="IMG_05859.png" style=" -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);" width=250px>  
        
        
    </td>
</tr>
<tr height =200><td></td></tr>
</table>






<div align =center valign=center id="formular" style="position: relative; 
left: 50%;
transform: translateX(-50%); width: 834px">
<div style="left: -5px; transform: rotate(-35deg); cursor: pointer;
  background-color: transparent;
  border: none; 
  position: absolute;">
    
<img src="stampstore.png " width= 200px> 
    
</div>

  
<table width=834px id="oben" align =center valign=center >    

<tr>
    
    <td align =center width=400px valign=center><br>

    <form name="suche" id=sender action="codecreated.php" method="post"><br>  
    
        <div style="font-family: Verdana; font-size: 10px; color: grey; ">  1. eingeben:</div>
    
        <input style="font-size:40px; font-family: Verdana; width: 600px; text-align: center" type="text" id=suche name="data" placeholder=" Vorname Nachname E-Mail">
        
        <br><br><br>
        
        <div style="font-family: Verdana; font-size: 10px; color: grey;">2. anklicken:</div>
        
        <button id=schrift3 type="submit" form="sender" style="font-size:30px;	font-family: Verdana;border: 2px solid #999; border-radius: 0.5em; background-color: #FFD800; color: black; width: 400px;"> CARD FÜR'S HANDY</button>
        
        <br><br>
        
        <button id=schrift3 type="submit" form="sender" formaction="multiplecards.php" style="font-size:30px;font-family: Verdana;	border: 2px solid #999; border-radius: 0.5em; background-color: grey; color: white; width: 400px;" >PAPIERCARDS</button>
        
        <br><br>
        
    </form>

    </td>

</tr>

</table>
</div>

<br><br>

<table id=suche2 align=center width=400px>

<tr>
    <td  align =center valign=center>
        
    </td>
</tr>
 
<tr>
    <td id="schrift" align=center valign=top width=80%><br>
    
    Verschlüsselte Datenübertragung (SSL/TLS-Verschlüsselung = HTTPS).<br>

    Datenverarbeitung auf Server in Europäischer Union.<br><br>
    Die COVICARD wird sofort ausgegeben. Nach Ausgabe ausdrucken oder speichern.<br><br><br><br>
    
    </td>
<tr>
</table>

<table id=schrift width=100%>
    <tr>
    
    <td  width = 80% align=center>
        <h1 style="font-size: 40px"><br>So sieht die COVICARD aus.</h1><br><br><br><br>
        <table align=center>
            <tr>
                <td>
                <a href="covicardexample1.png"><img id="infoblock1" src="covicardexample2.png" width= 250px></a> 
                </td>
                <td></td>
                <td>
                <a href="covicardexample2.png"><img id="infoblock1" src="covicardexample1.png"width= 250px></a>
                </td>
            </tr>
            <tr>
                <td align=center>FÜR'S HANDY</td>
                <td width=50px> </td>
                <td align=center>AUF PAPIER</td>
            </tr>
        </table>
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
        <a href="neu.php" style="font-family: Arial; font-size: 30px;text-decoration:none; color: #FFD800;" ><b>CARD ERSTELLEN</b></a><br><br>
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
<br><br>Technisches:<br><br>Überblick<br><br>Es gibt drei Arten von Covicards: Die Standardkarte, eine Karte mit Testzertifikat und eine Karte mit Termin. <br>Die letzten beiden Karten sind immer auch Standardkarten und können immer auch als Standardkarte benutzt werden. <br>Die Karte mit Testzertifikat kann nur eine Behörde herstellen. <br>Eine Karte mit Termin kann nur erzeugt werden, wenn der Gastgeber (Gastwirt, Einzelhandelsgeschäft, Behörde usw.) eine Terminbuchungsseite eingerichtet hat.<br><br>Standardkarte<br><br>Der Gast oder der Gastgeber (Gastwirt, Einzelhandelsgeschäft, Behörde usw.) erstellen die Covicard des Gasts im Internet unter covicard.de/neu.php. <br>Dazu werden Vorname, Nachname und E-Mail-Adesse in ein (1) Feld getippt. Es ist egal, ob Kommas eingegeben werden oder nicht. <br>Man kann die Karte mit dem Drücken der Rückstelltaste (Returntaste, Entertaste), aber auch über Buttons anfordern. <br>Es kann gewählt werden zwischen einer Karte, auf der neben dem QR-Code auch Namen und Adresse aufgedruckt sind, oder einer Karte nur mit QR-Code.<br><br>Sinn: Vielleicht möchte der Gast nicht, dass seine Daten elektronisch erfasst werden. Vielleicht will oder kann der Gastgerber (auch) keine App benutzen. Wie auch immer: Was ist leichter für eine Kontaktdatenerfassung, als einfach eine Visitenkarte zu hinterlassen.<br><br>Die Daten werden auf einen Server in Europa übertragen und dort in die Covicard umgewandelt. Die Übertragung ist Https-gesichert. <br><br>Sinn: Die Daten müssen verschlüsselt werden. Dazu ist u.a. ein Schlüssel nötig. Dieser sollte nicht öffentlich bekannt werden. Er ist daher auf einem Server, nicht aber in der Webseite hinterlegt, die jeder ansehen kann.<br><br>Die Daten werden sofort nach der Erstellung der Covicard aktiv wieder gelöscht. Es gibt keine zentrale Speicherung von Daten (Ausnahme: Karte mit Testzertifikat oder Termin, siehe unten)!<br>Die Covicard wird sofort angezeigt. Mit einem Tippen auf die Karte wird automatisch der Download eingeleitet. <br>Die Karte funktioniert auch, wenn sie abfotografiert oder ausgedruckt wird (auch mit Bondrucker) oder wenn von ihr ein Screenshot gemacht wird.<br><br>Auf einer Covicard finden sich im QR-Code die folgenden Informationen: Vorname im Klartext / Vorname, Nachname und E-Mail-Adresse als verschlüsselter Code ( AES 128 cbc) / ggf. (bei einer Karte mit Testzertifikat oder Termin) eine individuelle Buchstaben- und Zahlenkombination, der sogenannte Token, und eine Speicheradresse, unter der die Kombination überprüft werden kann, ebenfalls als verschlüsselter Code (AES 128 cbc). <br><br>Der QR-Code kann mit jedem QR-Code-Reader ausgelesen werden. 
        
    </div>
    
</div>

</div>
<!--******************************* LEGAL-BAR **********************************-->

<table style="width: 100%; font-family: Verdana; font-size: 6;  margin-left: auto; margin-right: auto; left: 0; right: 0;  top:110em; text-align: center; ">
         <tr height = 100px><td></td></tr>
         <tr><td align=center valign=center  id=schrift style="background-color: #FFD800;" >
             
              <br>COVICA 2020 * Bilder und Zeichnungen BEM'20 * <a href = "impressum.htm">Impressum</a> * <a href ="Datenschutz.htm">Datenschutz</a> <br><br>
             </td>
            
         </tr>
     </table> 

</body>