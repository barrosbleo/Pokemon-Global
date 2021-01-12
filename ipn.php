<?php

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);


if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {

// PAYMENT VALIDATED & VERIFIED!

$fh = @fopen('ipn.txt', 'a') or die();
	fwrite($fh, donated);
	fclose($fh);


}

else if (strcmp ($res, "INVALID") == 0) {

// PAYMENT INVALID & INVESTIGATE MANUALY!

$to      = 'tsakshams@hotmail.co.uk';
$subject = 'Download Area | Invalid Payment';
$message = '

Dear Administrator,

A payment has been made but is flagged as INVALID.
Please verify the payment manualy and contact the buyer.

Buyer Email: '.$email.'
';
$headers = 'From:tsakshams@hotmail.co.uk' . "\r\n";

mail($to, $subject, $message, $headers);

}
}
fclose ($fp);
}
?>