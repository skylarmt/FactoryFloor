<?php

require 'required.php';

redirectifnotloggedin();

// We don't need to change pages or anything
header("HTTP/1.0 204 No Content");

$msg = strip_tags($_POST['msg']);

if (is_empty($msg)) {
    die();
}

$database->insert('messages', ['#messagedate' => 'NOW()', 'senderid' => $_SESSION['userid'], 'messagetext' => $msg]);
