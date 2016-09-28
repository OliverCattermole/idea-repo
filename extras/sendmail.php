<?php
// multiple recipients
$to  = 'skellon_lauren@network.lilly.com' . ', '; // note the comma
$to .= 'dean_matt@network.lilly.com' . ', ';
$to .= 'durafe_lay@network.lilly.com' . ', ';
$to .= 'cattermole_ollie@network.lilly.com';

// subject
$subject = 'New LCT Forum Question Submitted';

// message
$message = '
<html>
<head>
  <title>New Forum Question Submitted</title>
</head>
<body>
  <p>Someone has submitted a new question, please visit the Forum to review.</p>
  <p>' . echo $title; . '</p>
  <p>' . echo $description; . '</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

ini_set("SMTP","aspmx.l.google.com");

// Mail it
mail($to, $subject, $message, $headers);
?>
