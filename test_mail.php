<?php
$message = "test message body";
$result = mail('mtacus@yahoo.com.ar', 'message subject', $message);
echo "result: $result";
?>
