<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
$mailUserName = "";
$mailPassword = "";
$mailAddress = "QBRCsupport@UTSouthwestern.edu";
$mailSenderName = "QBRC";
$url="https://dbai.biohpc.swmed.edu/bepitbr/";

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('America/Chicago');

require 'PHPMailerAutoload.php';

$email = $argv[1];
$jobid = $argv[2];
# 1 = success, 0 = fail
$success = $argv[3];

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.swmed.edu';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
//$mail->Port = 587;
//
////Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
//$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $mailUserName;

//Password to use for SMTP authentication
$mail->Password = $mailPassword;

//Set who the message is to be sent from
$mail->setFrom($mailAddress, $mailSenderName);

//Set an alternative reply-to address
//$mail->addReplyTo('lululiu008@gmail.com', 'Yiwei Liu');

//Set who the message is to be sent to

$mail->addAddress($email, 'BepiTBR User');

if ($success == 1) {
    //Set the subject line
    $mail->Subject = 'BepiTBR analysis completed';
    $mail->Body = '
<p>Thank you for using BepiTBR online analysis.<br/><br/>
This is an automatic email sent from the website. Please DO NOT reply.<br/><br/>
Please go to the link below to view the result:<br/></p>
<a href="'.$url.'result.php?jobid=' . $jobid . '">'.$url.'result.php?jobid=' . $jobid . '</a>
<p><br/><br/>------------------------------------------------------------<br/><br/>
Quantitative Biomedical Research Center<br/><br/>
UT Southwestern Medical Center<br/>
';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
    $mail->AltBody = '
Thank you for using BepiTBR online analysis.
This is an automatic email sent from the website. Please DO NOT reply.
Please go to the link below to view the result:

'.$url.'result.php?jobid=' . $jobid . '

------------------------------------------------------------
Quantitative Biomedical Research Center

UT Southwestern Medical Center

The future of medicine, today.';
} else {
    //Set the subject line
    $mail->Subject = 'BepiTBR analysis fails';
    $mail->Body = '

<p>Unexcepted error happened.<br/><br/>
Please check your input files format and follow our instructions.<br/><br/>
Contact us if you still have same issues.<br/><br/>
This is an automatic email sent from the website. Please DO NOT reply.<br/><br/></p>
<p><br/><br/>------------------------------------------------------------<br/><br/>
Quantitative Biomedical Research Center<br/><br/>
UT Southwestern Medical Center<br/>
';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
    $mail->AltBody = '
Unexcepted error happened.
Please check your input files format and follow our instructions.
Contact us if you still have same issues.
This is an automatic email sent from the website. Please DO NOT reply.

------------------------------------------------------------
Quantitative Biomedical Research Center

UT Southwestern Medical Center

The future of medicine, today.';
}

//Attach an image file
//$mail->addAttachment('/home/yiwei/Downloads/result.csv');

//send the message, check for errors
$mail->send();
//
//if (!$mail->send()) {
//    echo "Mailer Error: " . $mail->ErrorInfo;
//} else {
//    echo "Message sent!";
//}

?>
