<?php
require_once 'required.php';

redirectifnotloggedin();

if (userrolefromid($_SESSION['userid']) < 1) {
    die('Access denied.');
}
if (is_empty($_POST['taskid'])) {
    die('Missing taskid.');
}
$database->delete('assigned_tasks', ['taskid' => $_POST['taskid']]);
$database->delete('tasks', ['taskid' => $_POST['taskid']]);
header('HTTP/1.0 204 No Content');