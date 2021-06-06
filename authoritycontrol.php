<?php

$togger = $_GET['tutz'];
$basser = $_GET['proz'];

//echo $togger;
//echo $basser;

$db = mysqli_connect("localhost", "u851855722_ymet", "kleinenutella", "u851855722_ymet");

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

$querycontent = mysqli_query($db, "SELECT perz FROM authoritycontrol WHERE togger = '$togger' AND basser = '$basser'");
/*$querycontent->bind_param("ss", $tosser1, $bosser1);

$tosser1 = $tosser;
$basser1 = $basser;
$querycontent->execute();*/

while($row = mysqli_fetch_object($querycontent))
{ echo $row->perz;

}


?>