 <head>
    <meta http-equiv="cache-control" content="no-cache">
    <meta charset="utf-8">
 </head>

<style>
#schrift {
font-family: Arial;
font-size: 25px
}
#schrift2 {
font-family: Arial;
font-size: 50px
}
#schrift3 {
font-family: Arial;
font-size: 15px
}

#infoblock{
    border: 2px solid black;
  border-radius: 8px;
}
</style>


<table  align=center width=900px padding=5%>
 


<?php
  //header('Content-Type: image/png');
  header('Content-Type: text/html; charset=UTF-8');
  
  include('phpqrcode.php'); 
  include('../tron.php');
  
  $presuche = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS); 
  
  $firstarray=preg_split("/[\s,]+/", $presuche);
  $numberofelements= count($firstarray);  
  $phone=$firstarray[$numberofelements-1];
  $numberofelementsminus1=$numberofelements-1;
  
  
  
  if ($firstarray[0]=="Dr." or $firstarray[0]=="Dr" or $firstarray[0]=="dr."){
      $first=$firstarray[0]." ".$firstarray[1];
      $sur=$sur.$firstarray[2];
      for($i=3; $i<$numberofelementsminus1; $i++){
          $sur=$sur." ".$firstarray[$i];
        
          
      }
     
      
  }  else { 
      $checker=$firstarray[0]." ".$firstarray[1];
      if ($checker=="Prof. Dr." or $checker=="Prof Dr" or $checker=="prof. dr."){
      $first=$checker." ".$firstarray[2];
      $sur=$sur.$firstarray[3];
      for($i=4; $i<$numberofelementsminus1; $i++){
          $sur=$sur." ".$firstarray[$i];
        
          
      }
     
      
        } else {
      
      
     $first=$firstarray[0];
     $sur=$sur.$firstarray[1];
     for($i=2; $i<$numberofelementsminus1; $i++){
          $sur=$sur." ".$firstarray[$i];
      }
  }
  }

  
  $first_name=$first;
  $surname=$sur;
  $phonepart=preg_split("/[@]/", $phone);
  $phonemail=$phonepart[0];
  if ($phonepart[1]!=null){
  $phonemail1="@".$phonepart[1];}else{
  $phonemail1=$phonepart[1];    
  }
  $token="";
  
  $cleartext= $suche;
  $cipher = 'AES-128-CBC';
  $ciphertext = openssl_encrypt($cleartext, $cipher, $key, $options=0, $iv);
  $ciphertext = str_replace("+", "%2B", $ciphertext);
   
  $cardcode=$first."-".$ciphertext."-".$token;

  $qrcodereader = 'https://kartnbastler.de/bild1.php?Bernd='.$cardcode;
  $image=imagecreatefromstring(file_get_contents($qrcodereader));
  
  
  $im = @imagecreatetruecolor(250, 78)
      or die('Cannot Initialize new GD image stream');
  $text_color = imagecolorallocate($im, 255, 255, 255);
  imagefill($im, 0, 0, $text_color);
  $text_color = imagecolorallocate($im, 0, 0, 0);
  imagestring($im, 4, 3, 0, $first_name, $text_color);
  imagestring($im, 4, 3, 17, $surname, $text_color);
  imagestring($im, 4, 3, 34, $phonemail, $text_color);
  imagestring($im, 4, 3, 51, $phonemail1, $text_color);
  $image3=imagerotate($im, 270, 0);
  $image2=imagecreatefromstring(file_get_contents("IMG_06222.png"));
  $image2=imagescale($image2, 320, 657, IMG_BILINEAR_FIXED);
 
  imagecopy($image2, $image, 35, 160, 0, 0, 150, 193);
  imagecopy($image2, $image3, 190, 170, 0, 0, 78, 193);

  
  //imagepng($image2);
  //imagepng($image2, 'covicard.png');
  
  ob_start();
  imagepng($image2);
  $imgData=ob_get_clean();
  
  for($o = 0; $o<2; $o++){echo '<tr>';
  for ($i = 0; $i<3; $i++){
  echo'<td   width=266 height=592 align=center><img id="infoblock" src="data:image/png;base64,'.base64_encode($imgData).'" /></td>';
  }
  echo '</tr><tr><td></td></tr>';}
  
  
  imagedestroy($im);
  imagedestroy($image);
  imagedestroy($image2);
  imagedestroy($image3);

 ?>
 

<tr><td><br><br></td></tr>
<tr><td></td><td align=center><button id=schrift3 type="submit" form="sender" style="font-size:50px;	border: 2px solid #999; border-radius: 0.5em; background-color: blue; color: white" onclick="window.print()">DRUCKEN</button></td></tr>

        </table>
        
     <table width=100%>
         <tr height = 200><td></td>
             <td width=80% id=schrift3 align=center valign=bottom>
              COVICA 2020 * Bilder und Zeichnungen BEM'20 * <a href = "impressum.htm">Impressum</a> * <a href ="Datenschutz.htm">Datenschutz</a>  
             </td>
             <td></td>
         </tr>
     </table>  
        </td>
    <td></td>
</tr>

</table>