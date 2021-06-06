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
    
    <b>COVICARD</b><div style="font-family: Verdana; font-size: 40; color: #A927C9">   shopping <br><br></div>
    <div style="font-family: Verdana; font-size: 40; color: black">appfreie Visitenkarte für Alle<br><br></div>
    </td>
</tr>
<tr height =500px valign=center>
    <td height =500px align=center valign=center style="font-family: Verdana; font-size: 80">

    
<br>
    <img src="shopcardex.png" width=288 >
  
 

   



</td></tr></table>



<table align=center><tr height =50><tr><td align=center >





<h1 style="font-size: 30px; font-family: Verdana"><br><br> Buchungsseite jetzt erstellen.</h1><br><br>
</td>
</tr>
</table>

<table width=834px id="oben" align =center valign=center style="background-color: #F5F5F5;">    
<tr><td align =center width=400px valign=center><br>

<form name="suche" id=sender action="syscreator.php" method="post"><br>  

<input style="font-size:30px;font-family: Verdana; width: 400px;" type="text" id=suche name="host" placeholder="Firma"><br><br>
<input style="font-size:30px;font-family: Verdana; width: 400px;" type="text" id=suche name="empfaenger" placeholder="E-Mail-Adresse"><br><br>
<input style="font-size:30px;font-family: Verdana; width: 400px;" type="text" id=suche name="maxGuestNo" placeholder="Max. Kdn./30 min., z.B. 20"><br><br>



<br><br><br>
<button id=schrift3 type="submit" form="sender" style="font-size:30px;font-family: Verdana; width: 400px; padding: 20px;	border: 2px solid #999; border-radius: 0.5em; background-color:  #A927C9; color: white; width: 13em;" >Buchungsseite erstellen</button><br><br><a href="https://covicard.de/calendar.php?host=Galeria Kaufmann&id=7baaf070">DEMO</a><br>

</form><br>
</td></tr></table>
<br><br>
<table id=suche2 align=center width=800px>

  

<tr>
<td  align =center valign=center>





</td>
  
</tr><tr><td id="schrift" align=center valign=top width=80%><br>Verschlüsselte Datenübertragung (SSL/TLS-Verschlüsselung = HTTPS).<br>

Datenverarbeitung auf Server in Europäischer Union.<br><br>
Die COVICARD wird sofort ausgegeben. Nach Ausgabe ausdrucken oder speichern.<br><br><br><br></td>
<tr>
</table>

<table id=schrift width=100%>
    <tr>
    
    <td  width = 80% align=center>
        <h1 style="font-size: 40px; font-family:  Verdana"><br>So sehen die Karten aus.</h1><br><br><br><br>
        <table align=center>
            <tr>
                <td>
    <a href="covicardexample1.png"><img id="infoblock" src="covicardexample1.png"></a> 
    </td>
    <td></td>
    <td>
    <a href="IMG_0557.PNG"><img id="infoblock" src="IMG_0557.PNG"></a>
    </td>
</tr>
<tr>
    <td align=center>COVICARD</td>
    <td width=50px> </td>
    <td align=center>SHOPPING-CARD</td>
</tr>
</table></table>

<table id=schrift width=100%>
<tr>
    <td></td>
    <td  width = 80% align=center>
        <h1 style="font-size:30px;font-family: Verdana;"><br><br>So funktioniert der SCANNER.</h1><br><br><br><br>
    <video src="erklaervideo.mp4" controls  autoplay muted loop width=288px id=suche1>
  Ihr Browser kann dieses Video nicht wiedergeben.<br/>
  Dieser Film zeigt eine Demonstration des video-Elements. 
  Sie können ihn unter <a href="explain.mp4">hier</a> abrufen.
</video></td>
    
    <td></td>
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
        <a href="neu.php" style="font-family: Verdana; font-size: 30px;text-decoration:none; color: #FFD800;" ><b>CARD ERSTELLEN</b></a><br><br>
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
        
        <br>Karte mit Termin<br><br>Ähnlich funktioniert die Karte mit Testzertifikat. <br><br>Der Gastgeber erzeugt eine Tabelle für die Terminsauswahl.  <br>Am Ende der Tabelle findet er einen QR-Code, der direkt zu dieser Seite führt.<br>Er erhält darüber eine E-Mail, die ebenfalls den Link zu der Seite enthält und einen Code, um die Seite direkt auf seinen Seiten als iframe einzubetten.<br><br>Der Gast oder der Gastgeber (Gastwirt, Einzelhandelsgeschäft, Behörde usw.) erstellen die Karte mit Termin<br>des Gasts.<br>Dazu werden Vorname, Nachname und E-Mail-Adesse in ein (1) Feld getippt. Es ist egal, ob Kommas eingegeben werden oder nicht. <br>Man kann die Karte mit dem Drücken der Rückstelltaste (Returntaste, Entertaste) nicht anfordern.<br>Der Kunde erzeugt die Karte, indem er einen Termin anklickt.<br><br>Die Daten werden auf einen Server in Europa übertragen und dort in die Covicard umgewandelt. Die Übertragung ist Https-gesichert. <br><br>Sinn: Die Daten müssen verschlüsselt werden. Dazu ist u.a. ein Schlüssel nötig. Dieser sollte nicht öffentlich bekannt werden. Er ist daher auf einem Server, nicht aber in der Webseite hinterlegt, die jeder ansehen kann.<br><br>Die Daten werden sofort nach der Erstellung der Covicard aktiv wieder gelöscht. Gespeichert wird nur der Token auf der Karte. <br>Die Covicard wird sofort angezeigt. Mit einem Tippen auf die Karte wird automatisch der Download eingeleitet. <br>Die Karte funktioniert auch, wenn sie abfotografiert oder ausgedruckt wird (auch mit Bondrucker) oder wenn von ihr ein Screenshot gemacht wird.<br>Es wird auch eine Standard-Karte ausgegeben.<br><br>Die Scanner-App erfasst den QR-Code auf der Karte mit Termin wie oben beschrieben. <br>Den Code mit dem Token sendet sie gleichzeitig über das Internet an die Datenbank.<br>Der Server überprüft, ob der Token passt und schickt das Prüfergebnis zurück. Das Ergebnis wird bei der Plausibilitätsprüfung angezeigt. <br>Auf der Karte sind der Name des Gastgebers und Datum und Uhrzeit des Termins abgedruckt. Daran überprüft der Gastgeber, ob der Termin für ihn und die konkrete Zeit gilt.<br>
        
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

