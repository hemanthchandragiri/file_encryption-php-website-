<?php

$IV    = '12dasdq3g5b2434b';
/* $ivlen = openssl_cipher_iv_length($ALGORITHM);
    $IV = openssl_random_pseudo_bytes($ivlen);*///THIS WILL WORK IF THE CIPHER METHOD IS FIXED 
$error = '';
 extract($POST);
  $ALGORITHM = isset($_POST['ALGORITHM']) && $_POST['ALGORITHM']!='' ? $_POST['ALGORITHM'] : null;
  $password   = isset($_POST['password']) && $_POST['password']!='' ? $_POST['password'] : null;
  $action = isset($_POST['action']) && in_array($_POST['action'],array('c','d')) ? $_POST['action'] : null;
  $file  = isset($_FILES) && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK ? $_FILES['file'] : null;
  $savefile = isset($_POST['savefile']) && $_POST['savefile']!='' ? $_POST['savefile'] : null;
  if ($password === null) {
    $error .= 'Invalid Password
<br>';
  }
  if ($action === null) {
    $error .= 'Invalid Action
  <br>';
  }
  if ($file === null) {
    $error .= 'Errors occurred while elaborating the file
    <br>';
  }
  
  if ($error === '') {
  
    $content = '';
    $nomefile  = '';
  
    $content = file_get_contents($file['tmp_name']);
    $filename  = $file['name'];
  
    switch ($action) {
      case 'c':
        $content = openssl_encrypt($content, $ALGORITHM, $password, 0, $IV);
        $filename  = $filename . '.txt';
        break;
      case 'd':
        $content = openssl_decrypt($content, $ALGORITHM, $password, 0, $IV);
        $filename  = preg_replace('#\.txt$#','.txt',$filename);
        break;
    }
    
    if ($content === false) {
      $error .= 'Errors occurred while encrypting/decrypting the file ';
    }
    
    if ($error === '') {
    
      header("Pragma: public");
      header("Pragma: no-cache");
      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Expires: 0");
      header("Content-Type: application/octet-stream");
      header("Content-Disposition: attachment; filename=\"" . $filename . "\";");
      $size = strlen($content);
      header("Content-Length: " . $size);
      echo $content; // file output

      //mail sessions ..........
      $myfile = fopen('encrypted.txt', "w") or die("Unable to open file!");
$txt = $content;
fwrite($myfile, $txt);

    $subject = "encrypted file...";
   
$fromemail =  "hemanthchandragiri2001";
$subject=" fe attachment";
$email_message = '<h2>encrypted File</h2>
                    
                    <p><b>Email:</b> '.$fromemail.'</p>
                    <p><b>Subject:</b> '.$subject.'</p>';
$email_message.="Please find the attachment";
$semi_rand = md5(uniqid(time()));
$headers = "From: ".$fromemail;
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

    $headers .= "\nMIME-Version: 1.0\n" .
    "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";

 
  $strFilesName = 'encrypted.txt';  
  $strContent = chunk_split(base64_encode(file_get_contents('encrypted.txt')));  
  
  
    $email_message .= "This is a multi-part message in MIME format.\n\n" .
    "--{$mime_boundary}\n" .
    "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" .
    $email_message .= "\n\n";


    $email_message .= "--{$mime_boundary}\n" .
    "Content-Type: application/octet-stream;\n" .
    " name=\"{$strFilesName}\"\n" .
    //"Content-Disposition: attachment;\n" .
    //" filename=\"{$fileatt_name}\"\n" .
    "Content-Transfer-Encoding: base64\n\n" .
    $strContent  .= "\n\n" .
    "--{$mime_boundary}--\n";

$toemail="hemanthchandragiri2001@gmail.com";  

if(mail($toemail, $subject, $email_message, $headers)){
   $statusMsg= "Email send successfully with attachment";
   fclose($myfile);
   unlink($myfile);

      
}else{
   $statusMsg= "Not sent";
}



      
    }
  
  }
  


?>