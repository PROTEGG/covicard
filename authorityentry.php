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
  background-color: green ;
 
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
    <td align=center style="font-family: Arial; font-size: 80"> 
    
    <b>COVICARD</b><div style="font-family: Arial; font-size: 40; color: green">   Grüner Pass <br><br></div>
    <div style="font-family: Arial; font-size: 40; color: black">appfreie Visitenkarte mit Testbestätigung<br><br><br></div> 

    <img src="IMG_0574.png" width=288 >
  
 

   
    </td>
</tr>
</table>
<table align=center><tr height =50><td></td><td align=center style="font-family: Arial; font-size: 80">





<h1 style="font-size: 60px"><br><br> Ausstellung der Bestätigungen starten.</h1><br>
</td>
</tr>
</table>
<table width=834px id="oben" align =center valign=center style="background-color="#F5F5F5;">    
<tr><td align =center width=400px valign=center ><br>

<form name="sucheDA" id=senderDA action="scannerprecontrol.php" method="post"><br>  

<input style="font-size:40px;" type="text" id=sucheA name="login" placeholder="LOGIN"><br><br>
<input style="font-size:40px;" type="text" id=sucheA name="password" placeholder="PASSWORD"><br><br>

<br><br><br>
<button id=schrift3 type="submit" form="senderDA" style="font-size:40px; padding: 20px;	border: 2px solid #999; border-radius: 0.5em; background-color:  green; color: white; width: 13em;" >STARTEN</button>

</form>



</td></tr><tr><td align=center>

<form name="sucheD" id=senderD action="scannerprecontrol.php" method="post">  

<input  type="hidden" id=suche name="login"     value="MUH">
<input  type="hidden" id=suche name="password"  value="2HC9SRY4T9GH7Y8Q">

<button id=schrift3 type="submit" form="senderD" style="font-size:30px; background-color: white; text-decoration: underline;	border: 0px solid #999;  width: 13em;" >DEMO</button><br>

</form><br><br><br>Mit Demo-Zugang erstellte Testzertifikate sind unbrauchbar! <br><br>Ein Behördenaccount muss per <a href="mailto:bernd.mayer@covicard.de">E-Mail</a> beantragt werden. <br><br></td></tr></table>

<br><br><br>
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
        
  <br>Karte mit Testzertifikat<br><br>Auf der Seite Covicard.de findet sich nur eine Demoversion. Es wird dringend empfohlen, den Generator für die Testzertifikate und die zugehörige Datenbank auf eigenen Servern der Behörde zu installieren und zu betreiben.<br><br>Die Behörde oder ein Beliehener meldet sich mit einem Behördenlogin und einem Behördenpasswort an. Auf dem Server sind diese nur als Hash hinterlegt. Ein Hash ist ein Einbahnstraßen-Code. Ein und derselbe Name führt immer wieder zum selben Hash. Es ist dagegen wirtschaftlich unmöglich, aus dem Hash den Namen zu rekonstruieren. <br><br>Die eigentliche Generatorseite verfügt über einen Scanner. Die Kontaktdaten können damit bequem von einer alten Karte eingelesen werden. <br>Alternativ können sie auch eingetippt werden. <br>Dazu werden Vorname, Nachname und E-Mail-Adresse in ein (1) Feld getippt. Es ist egal, ob Kommas eingegeben werden oder nicht. <br>Man kann die Karte mit dem Drücken der Rückstelltaste (Returntaste, Entertaste), aber auch über Buttons anfordern. <br><br>Die Behörde oder ein Beliehener erzeugt auf diese Weise nur ein Testzertifikat, wenn der Bürger zuvor negativ auf Corona getestet wurde. Die Karte wird an den Bürger automatisch gemailt. Aus dem Namen des Bürgers wird ein Hash gebildet und dieser Hash zusammen mit einem Token und einer Kontrollnummer in der Tabelle abgespeichert. Ein Hash ist ein Einbahnstraßen-Code. Ein und derselbe Name führt immer wieder zum selben Hash. Es ist dagegen wirtschaftlich unmöglich, aus dem Hash den Namen zu rekonstruieren. Die Behörde hat keine Möglichkeit, ein Testergebnis einem Bürger zuzuordnen. Ausnahme: Sie benutzt die Scanner-App.<br><br>Die Scanner-App erfasst den QR-Code auf der Karte mit Testzertifikat wie oben beschrieben. Den Code mit dem Token sendet sie gleichzeitig über das Internet an die Datenbank, zusammen mit einem Hash der Kontaktinformationen. Ein Hash ist ein Einbahnstraßen-Code. Ein und derselbe Name führt immer wieder zum selben Hash. Es ist dagegen wirtschaftlich unmöglich, aus dem Hash den Namen zu rekonstruieren. <br>Der Server überprüft, ob der Token zu diesem Hash passt und schickt das Prüfergebnis zurück. Das Ergebnis wird bei der Plausibilitätsprüfung angezeigt. <br><br>So soll sichergestellt werden, dass die Person, die die Karte mit dem Testzertifikat vorzeigt, auch wirklich die ist, auf die sich das Zertifikat bezieht: Auf der Karte stehen Name und Vorname des Gastes im Klartext. Dass Name und Token zusammengehören, ergibt sich aus der Abfrage über den aus dem Namen gebildeten Hash. Dass Name und Vorname mit dem QR-Code übereinstimmen, kann während der Plausibilitätskontrolle überprüft werden. Dass Name und Vorname zur Person passen, kann anhand des Personalausweises überprüft werden. Eine Fälschung würde nach alldem erfordern: Ein gefälschter Personalausweis, den Algorithmus und das Salz, um aus dem Namen und der E-Adresse einen Hash zu formen, den Schlüssel für die AES 128 cbc Verschlüsselung und die Adresse für die Datenbankabfrage. 
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