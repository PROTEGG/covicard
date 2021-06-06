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
  background-color: grey;
 
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


function dodrop(event)
{
  //***************get the data from file which is dropped in drop area    
   
  // load data in variable d
  var d = event.dataTransfer;
  // get the files which are contained in data-variable dt which result in an array that is stored in variable f
  var f = d.files;
  // unfortunately, XMLHttpRequest does not accept a file; therefore, it get wrapped in a Formdata, so frist step create instance of formdata, which is stored in variable u
  let u = new FormData(); 
  //put the first file in the Array-Variable f to formdata which is contained in varible u 
  u.append('contactDetails', f[0], f[0].name);
  
  var fileName=f[0].name;
  //output(fileName);


  var r;
  //create a databridge to send to PHP and recieve from php via http-request, therefor create a instance of XMLHttpRequest which is stored in vairable h
  var   h = new XMLHttpRequest();
        h.onreadystatechange = function() {
            if(this.readyState==4 && this.status==200){
            r = h.responseText;   
            output('Hier ist die entschlüsselte Datei:<br><br><a href=\"'+r+'\"><img src="filesymbolG.png" width=100px></a>');
            }
        };
  
        h.open('POST','fileEncrypter1.php', true);
        h.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        h.send(u);
  
  

    
    
}

function output(text)
{
  document.getElementById("fileshower").innerHTML += text;
  //dump(text);
}


</script>

</head>



<!--******************************* Headline **********************************-->

<br><br><br><br><br><br><br><br>


<table align=center valign=center width=800px >

    <tr height =50 valign=center>
        <td align=center valign=center style="font-family: Arial; font-size: 80"> 
    
            <b>COVICARD</b><div style="font-family: Arial; font-size: 40; color: grey">ENTSCHLÜSSLER<br><br></div>
            <div style="font-family: Arial; font-size: 40; color: black"> appfreie Visitenkarte für Jung und Alt<br><br></div>
        </td>
    </tr>
<tr><td align=center>
<div id="div1" ondrop="dodrop(event)" ondragover="allowDrop(event)">  
<div valign=center id="output" style="valign: center; width: 700px; height: 900px;  background-image: url('IMG_0627.PNG'); background-size: cover;background-size: contain;"
     ondragenter="document.getElementById('output').textContent = ''; event.stopPropagation(); event.preventDefault();"
     ondragover="event.stopPropagation(); event.preventDefault();"
     ondrop="event.stopPropagation(); event.preventDefault();
     dodrop(event);">
  
</div>
   
  </div>

<div valign=center id="fileshower" style="valign: center; min-height: 200px; white-space: pre;"></div>  



    
     <nav style="position: absolute; right: 35px; top: 800px; background-color: #90EE90; padding: 2px; color: grey">DEMO<br><br>
      <a  href= "uploadfiles/demoFile.csv" download id="file1"  data-downloadurl="application/csv:uploadfiles/demoFile.csv:uploadfiles/demoFile.csv" ><img src=" filesymbol.png" width=70px></a><br><br>Anklicken<br>speichern<br>per drag and<br> drop<br> auf den <br> Bauch ziehen!
    </nav>
    

 <script>
 var filedetails;
 var file1 = getElementByID("file1");
    if(typeof file1.dataset === "undefined"){
        filedetails = file1.getAttribute("data-downloadurl");
    }
    else{
        filedetails = file1.dataset.downloadurl;
    }
    
    file1.addEventListener("dragstart",function(evt){evt.dataTransfer.setData("DownloadURL",filedetails);}, false);
    
    </script>




<!--
<form action="fileEncrypter1.php" method="post" enctype="multipart/form-data">
  Datei mit verschlüsselten Daten auswählen oder ...<br><br>
  <input type="file" name="contactDetails" id="fileToUpload">
  <input type="submit" value="Hochladen" name="submit">
</form> -->
<br><br><br><br>  </td>
</tr>
</table>
<!--******************************* MENUE **********************************-->

<div class="menuebar" align=center>

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
         <tr><td align=center valign=center  id=schrift style="background-color: grey; color: white">
             
              <br>COVICA 2020 * Bilder und Zeichnungen BEM'20 * <a href = "impressum.htm">Impressum</a> * <a href ="Datenschutz.htm">Datenschutz</a> <br><br>
             </td>
            
         </tr>
     </table> 
</body>

