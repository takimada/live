<?php
$today = getdate();
$to      = 'selmanuluc@gmail.com';
$subject = 'Test';
$message = $today ;
$headers = 'From: iletisim@7x24petshop.com' . "\r\n" .
    'Reply-To: iletisim@7x24petshop.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
