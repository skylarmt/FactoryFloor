<?php
require_once 'required.php';

redirectifnotloggedin();
header('HTTP/1.0 204 No Content');
if (userrolefromid($_SESSION['userid']) < 1) {
    die();
}
if (is_empty($_GET['msgid'])) {
    die();
}

$database->delete('messages', ['messageid' => $_GET['msgid']]);