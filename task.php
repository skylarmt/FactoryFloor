<?php
require_once 'required.php';

redirectifnotloggedin();

header('HTTP/1.0 204 No Content');

if (!$database->has('assigned_tasks', ["AND" => ['taskid' => $_POST['taskid'], 'userid' => $_SESSION['userid']]])) {
    die('You are not assigned to this task!');
}

switch ($_POST['action']) {
    case 'start':
        $database->update('assigned_tasks', ['#starttime' => 'NOW()', 'statusid' => 1], ["AND" => ['taskid' => $_POST['taskid'], 'userid' => $_SESSION['userid']]]);
        echo "Started.";
        break;
    case 'finish':
        $database->update('assigned_tasks', ['#endtime' => 'NOW()', 'statusid' => 2], ["AND" => ['taskid' => $_POST['taskid'], 'userid' => $_SESSION['userid']]]);
        echo "Finished.";
        break;
}