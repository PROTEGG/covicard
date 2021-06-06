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
    
    <b>COVICARD</b><div style="font-family: Verdana; font-size: 40; color: #A927C9">   shopping <br><br></div>
    
    </td>
</tr>

</table>



<form name="suche" id=sender action="codecreatedCalendar.php" method="get" onkeydown="return event.key != 'Enter';"><br><br>

<table width=600px   align =center valign=center>  

<tr><td align =center width=400px align=center ><br> <div align=left style="font-size: 50px; font-family: Arial; color: grey">Mein Termin bei </div><div align=right style="font-size: 50px; font-family: Arial; color: #A927C9">

<?php 
error_reporting(0);
include('../tron.php');
//Prepare data

$id  = $_GET["id"];


//open database

$db = mysqli_connect("localhost",  $uzibo2, $uzibo3,  $uzibo2);

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

//get individual data from gawsteliste

$querycontent = mysqli_query($db, "SELECT host, tablename, maxGuestNo, openingTime, closingTime FROM $admintable WHERE controlKey ='$id'");

while($row = mysqli_fetch_object($querycontent))
{$host = $row->host;
$maxGuestNo = $row->maxGuestNo;
$openingtime = $row->openingTime;
$closingtime = $row->closingTime;
$tablename= $row->tablename;
}
echo $host;
?>

<br><br><br></div>


<img src="IMG_0567.PNG" align=center width=500px height=500px>
<br><br><br><br><br><br><img src="pfeil.png" align=center width=125px height=125px><br><br><br>

<div style="font-size: 50px; font-family: Arial; color: grey">Schritt 1<br></div><div style="font-size: 50px; font-family: Arial; color: #A927C9">Kontaktdaten eingeben<br><br></div>
</td></tr>

<tr><td align =center width=400px valign=center><br>

<br>  
<input style="font-size:40px;" type="text" id=suche name="data" placeholder=" Vorname Nachname E-Mail">

<br><br><br><br><br><br><br><img src="pfeil.png" align=center width=125px height=125px><br><br><br><br>

<div style="font-size: 50px; font-family: Arial; color: grey">Schritt 2<br></div><div style="font-size: 50px; font-family: Arial; color: #A927C9">Termin auswählen<br></div>
</td></tr></table>
<br><br><br>


<?php


$maxNumberGuests = $maxGuestNo;
$green = $maxNumberGuests-10;
$red = $maxNumberGuests -5;

$db = mysqli_connect("localhost", "u851855722_ymet", "kleinenutella", "u851855722_ymet");

$querycontent        = $querycontent = mysqli_query($db, "SELECT * FROM $tablename WHERE nb=1");
$preRow              = mysqli_fetch_array($querycontent, MYSQLI_NUM);
$row[1]              = array_values($preRow);
$array               = $row[1];
$preOldDate          = $array[1];
$oldDate             = date("d.m.Y", strtotime($preOldDate));
$actualDate          = date("d.m.Y");


if($oldDate < $actualDate OR $actualDate < $oldDate){
    

//$querycontent        = mysqli_query($db, "DELETE FROM $tablename WHERE nb=1");  
//$preRow              = mysqli_fetch_array($querycontent, MYSQLI_NUM);

$querycontent        = mysqli_query($db, "SELECT MAX(id) FROM $tablename");
$preRow              = mysqli_fetch_array($querycontent, MYSQLI_NUM);
$row[1]              = array_values($preRow);
$array               = $row[1];
$lastID              = $array[0];

$start =$lastID-10;
$stop = $lastID;




for($i=2; $i <=13; $i++){
    $newId=$i-1;
    //echo $newId;
    $querycontent     = mysqli_query($db, "UPDATE $tablename SET nb=$newId WHERE nb=$i");
 
    $preRow           = mysqli_fetch_array($querycontent, MYSQLI_NUM);
} 


$querycontent        = $querycontent = mysqli_query($db, "SELECT * FROM $tablename WHERE nb=$newId");
$preRow              = mysqli_fetch_array($querycontent, MYSQLI_NUM);
$row[1]              = array_values($preRow);
$array               = $row[1];
$preOldDate          = $array[1];

$oldDate             = date("Y-m-d", strtotime($preOldDate) );
$newDate             = date("Y-m-d", strtotime($preOldDate . "+1 day"));
$day                 = date("l", strtotime($newDate));


$newId++;

 if($day != "Sunday") {
            
            $eintrag     = "INSERT INTO $tablename (date, nb) VALUES ('$newDate', '$newId')";
            $eintragen   = mysqli_query($db, $eintrag);  
            
        }else{
           $newDate             = date("Y-m-d", strtotime($preOldDate . "+2 day"));
           
           $eintrag     = "INSERT INTO $tablename (date) VALUES ('$newDate')";
           $eintragen   = mysqli_query($db, $eintrag);  echo $day;
        }


}
    
  


for($i=1; $i<=12; $i++){
    $querycontent        = $querycontent = mysqli_query($db, "SELECT * FROM $tablename WHERE nb=$i");
    $preRow              = mysqli_fetch_array($querycontent, MYSQLI_NUM);
    $row[$i]             = array_values($preRow);
  
}






$time=array(0, 0, 0, "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30","19:00","19:30");


echo '
<input type="hidden"  name="id"   value="'.$id.'">
<input type="hidden"  name="time" value="'.$time.'">
'; 

for($i=1; $i<=12; $i++){
    
    $actualRow           = $row[$i];
    $preDate             = $actualRow[1];    
    $day                 = date("l", strtotime($preDate));
    $date                = date("d.m.Y", strtotime($preDate));
 
    switch ($day) {
    case "Monday":
      $day="Montag";
      break;
      case "Tuesday":
      $day="Dienstag";
      break;
      case "Wednesday":
      $day="Mittwoch";
      break;
      case "Thursday":
      $day="Donnerstag";
      break;
      case"Friday":
      $day="Freitag";
      break;
      case"Saturday":
      $day="Samstag";
      break;  
}
    

    //echo '</table><br><div align=center style="font-family: Arial; font-size: 25px; color: grey;">'.$day.", ".$date.'</div><br><table align=center';
    if ($i == 1){echo       '</table><br><div align=center style="font-family: Arial; font-size: 25px; color: #A927C9;">HEUTE, '.$date.'</div><br><table align=center style="background-color: #F3E5FF; padding: 20px; border: 2px solid #999;
	border-radius: 0.5em;";><tr><td></td>';}
    else{ if ($i == 2){ echo '</table><br><div align=center style="font-family: Arial; font-size: 25px; color: grey;"><br><br><br>'.$day.", ".$date.'<br></div><br><table align=center><tr><td></td>' ;}
    else {echo '</table><br><br><br><div align=center style="font-family: Arial; font-size: 25px; color: grey;">'.$day.", ".$date.'</div><br><table align=center><tr><td></td>' ;}}

for($o=8; $o<27; $o++){

$number = $o-2;

if($actualRow[$o]<$green)
{
    $rest = $maxNumberGuests-$actualRow[$o]; 

    if($time[$o]<$actualTime && $date==$actualDate) 

    {echo '<td align=center padding=20px> <button name="datetime" type="button" style="color: #dcdcdc ; background-color: #bebebe;height: 60px; width: 80px; padding: 5px;border: 2px solid #999;
	border-radius: 0.5em;">'.$time[$o].'</button> <br></td>';} 

    else 
    
    {echo '<td align=center padding=20px> <button name="datetime" type="submit" value="'.$date.' '.$time[$o].' '.$controlKey.' '.$number.'" style="color: #696969 ; background-color:#98FF98;height: 60px; width: 80px; padding: 5px;border: 2px solid #999;
	border-radius: 0.5em;"> '.$time[$o].'  <br>noch '.$rest.'</button> <br></td>';} 
   
}
else
{
    if($actualRow[$o]<$red)
    {
        $rest = $maxNumberGuests-$actualRow[$o]; 
        
       if($time[$o]<$actualTime && $date==$actualDate) 

       {echo '<td align=center padding=20px> <button name="datetime" type="button" style="color: #dcdcdc ; background-color: #bebebe;height: 60px; width: 80px; padding: 5px;border: 2px solid #999; border-radius: 0.5em;">'.$time[$o].'</button> <br></td>';} 

       else 
    
       {echo '<td align=center padding=20px> <button name="datetime" type="submit" value="'.$date.' '.$time[$o].' '.$controlKey.' '.$number.'" style="color: #696969 ; background-color: 	#ffd17a ; height: 60px; width: 80px; padding: 5px; border: 2px solid #999; border-radius: 0.5em;"> '.$time[$o].'  <br>noch '.$rest.'</button> <br></td>';} 

    }
    else
    
    {echo '<td align=center padding=20px><button type="button" style="color: #dcdcdc; background-color: #bebebe; height: 60px; width: 80px; padding: 5px;border: 2px solid #999; border-radius: 0.5em;">'.$time[$o].'  <br></button> <br></td>';}
    
}


if($o==8 || $o==14 || $o==20 || $o==26  || $o==32 || $o==38)
{echo "</tr><tr><td></td>";}


}
echo '</tr><tr><td></td></tr>';

}

echo '</form>'; 

?>

</table><br><br><br><br><br><table id=oben align=center><tr><td>;


<?php
  //header('Content-Type: image/png');
  header('Content-Type: text/html; charset=UTF-8');

  include('phpqrcode.php'); 
  include('../tron.php');
  
  $text='https://covicard.de/calendar.php?id='.$id;
  
  $qrcodereader = 'https://kartnbastler.de/bild1.php?Bernd='.$text;

 
  $image=imagecreatefromstring(file_get_contents($qrcodereader));
  
  
  ob_start();
  imagepng($image);
  $imgData=ob_get_clean();
  echo'<img width=250px height=250px  src="data:image/png;base64,'.base64_encode($imgData).'" />';
  
  
  imagedestroy($image);
 

 ?>
 </td><td>
 
 <img src="IMG_0568.png" width=300p>
 
 </td></tr><tr><tr><td colspan="2">

 <div align=left style="font-size: 50px; font-family: Arial; color: grey">Mein Termin bei </div><div align=right style="font-size: 50px; font-family: Arial; color: #A927C9"><?php echo $host ?></div>
</td></tr></table>

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

