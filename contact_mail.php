<?php
require('phpmailer/class.phpmailer.php');
try {
if(isset($_POST['mailSend'])) {
$mail = new PHPMailer;
$mail->FromName = $_POST['userName'];
$to_email = $_POST['userEmail'];
$mail->AddAddress($to_email);
$mail->From = "admin@phpzag.com";
$mail->Subject = "Test Email Send using PHP";
$mail->Body = "<table>
<tr>
<th colspan='2'>This is a test email</th>
</tr>
<tr>
<td>Name :</td>
<td>".$_POST['userName']."</td>
</tr>
<tr>
<td>E-mail : </td>
<td>".$_POST['userEmail']."</td>
</tr>
<tr>
<td>Message : </td>
<td>".$_POST['content']."</td>
</tr>
<table>";
if(!is_dir('mailUpload')){
    mkdir('mailUpload');
}
 $attachment=$_FILES["attachmentFile"]["tmp_name"];
 $folder="mailUpload/";
 $file_name=$_FILES["attachmentFile"]["name"];
 move_uploaded_file($_FILES["attachmentFile"]["tmp_name"], "$folder".$_FILES["attachmentFile"]["name"]);
 $attach_file = $folder."".$file_name;
 
$mail->AddAttachment($attach_file);
$mail->Send();
//unlink($attach_file);
echo 'The message has been sent.';
}
} catch (phpmailerException $e) {
echo $e->errorMessage();
}
?>