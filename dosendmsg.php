<?php

require 'required.php';

redirectifnotloggedin();

$msg = strip_tags($_POST['msg']);

$database->insert('messages', ['#messagedate' => 'NOW()', 'senderid' => $_SESSION['userid'], 'messagetext' => $msg]);

// We don't need to change pages or anything
header("HTTP/1.0 204 No Content");