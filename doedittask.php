<?php

require_once 'required.php';

redirectifnotloggedin();

if (userrolefromid($_SESSION['userid']) < 1) {
    header('HTTP/1.0 204 No Content');
    die();
}

if (is_empty($_POST['tasktitle'])) {
    header('HTTP/1.0 204 No Content');
    die();
}

if (is_empty($_POST['taskid'])) {
    $newid = $database->insert('tasks', ['tasktitle' => $_POST['tasktitle'], 'taskdesc' => $_POST['taskdesc']]);
    header('Location: /?action=edittask&taskid=' . $newid);
} else {
    $database->update('tasks', ['tasktitle' => $_POST['tasktitle'], 'taskdesc' => $_POST['taskdesc']], ['taskid' => $_POST['taskid']]);
    header('HTTP/1.0 204 No Content');
}