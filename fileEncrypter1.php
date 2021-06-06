<?
$data = array();
    //check with your logic
    if (isset($_FILES)) {
        $error = false;
        $files = array();

        $uploaddir = 'uploadfiles/';
        foreach ($_FILES as $file) {
            if (move_uploaded_file($file['tmp_name'], $uploaddir . "ContactDetails.csv")) {
                $files[] = $uploaddir . $file['name'];
            } else {
                $error = true;
            }
        }
        $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
    } else {
        $data = array('success' => 'NO FILES ARE SENT','formData' => $_REQUEST);
    }

    //echo json_encode($data);
  
 
 
 include('../tron.php');
 
 date_default_timezone_set('MEZ');
 $timestamp=date("y_m_d_H_m");
 $file = "uploadfiles/koninfo".$timestamp.".csv";
 //$file="text.csv";
 echo $file;
 $lines = file("uploadfiles/ContactDetails.csv");
 
 $headline="Datum;Uhrzeit;Kontaktdaten";
 
 file_put_contents($file, trim($headline).PHP_EOL, FILE_APPEND | LOCK_EX);

 foreach ($lines as $line_num => $line) {
 $row = htmlspecialchars($line);
 
 $array = preg_split("/; /", $row);

if($array[0]==" "||$array[0]=="Datum"){}else{

if($array[0]=="geschwaerzt"){
    
 $data = $array[2];

  
 $cipher = 'AES-128-CBC';
 $plain = openssl_decrypt($data, $cipher, $wert, $options=0, $run);

 $arrayFir = preg_split("/-/", $plain);
 
 $dataFir = $arrayFir[3];
 $timeFir = $arrayFir[2];
 $dateFir = $arrayFir[1];
 
 $dataFir = str_replace("2%B","+", $dataFir);

 $plainFir = openssl_decrypt($dataFir, $cipher, $key, $options=0, $iv);
 
 $firstarray=preg_split("/[\s,]+/", $plainFir);
 $numberofelements= count($firstarray);  
 $mail=$firstarray[$numberofelements-1];
 //$name=$plainFir-$mail;
 
 $resultFir = $dateFir.';'.$timeFir.';'.$plainFir;
 //echo $dateFir.';'.$timeFir.';'.$plainFir.'<br>';  
 if($resultFir!=";;"){
      file_put_contents($file, trim($resultFir).PHP_EOL, FILE_APPEND | LOCK_EX);
 }

 }
 
 else {
    $data = $array[2];
    $data  = str_replace("2%B","+", $data);
    $plain = openssl_decrypt($data, $cipher, $key, $options=0, $iv);
    $date=$array[0];
    $time=$array[1];
    
    $result = $date.';'.$time.';'.$plain;
    //echo $date.';'.$time.';'.$plain.'<br>';   
    if($result != ";;"){
    file_put_contents($file, trim($result).PHP_EOL, FILE_APPEND | LOCK_EX);
    }
 }
 
}
}
  
    

?>
