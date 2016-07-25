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
    $_POST['taskid'] = $newid;
    header('Location: /?action=edittask&taskid=' . $newid);
} else {
    $database->update('tasks', ['tasktitle' => $_POST['tasktitle'], 'taskdesc' => $_POST['taskdesc']], ['taskid' => $_POST['taskid']]);
    header('Location: /?action=edittask&taskid=' . $_POST['taskid']); //header('HTTP/1.0 204 No Content');
}

if (checkIsAValidDate($_POST['taskassignedon'])) {
    $assigneddate = date('Y-m-d H:i:s', strtotime($_POST['taskassignedon']));
    $database->update('tasks', ['taskassignedon' => $assigneddate], ['taskid' => $_POST['taskid']]);
}
if (checkIsAValidDate($_POST['taskdueby'])) {
    $duedate = date('Y-m-d H:i:s', strtotime($_POST['taskdueby']));
    $database->update('tasks', ['taskdueby' => $duedate], ['taskid' => $_POST['taskid']]);
}
if (!is_empty($_POST['assignedto']) && useridexists($_POST['assignedto'])) {
    if ($database->has('assigned_tasks', ['taskid' => $_POST['taskid']])) {
        $database->update('assigned_tasks', ['userid' => $_POST['assignedto'], 'starttime' => null, 'endtime' => null, 'statusid' => 0], ['taskid' => $_POST['taskid']]);
    } else {
        $database->insert('assigned_tasks', ['taskid' => $_POST['taskid'], 'userid' => $_POST['assignedto'], 'starttime' => null, 'endtime' => null, 'statusid' => 0]);
    }
}