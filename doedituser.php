<?php

require_once 'required.php';

redirectifnotloggedin();

if (userrolefromid($_SESSION['userid']) < 1) {
    header('HTTP/1.0 204 No Content');
    die();
}

if (is_empty($_POST['username']) || is_empty($_POST['realname']) || is_empty($_POST['roleid'])) {
    die('Missing required information.  Please use the correct form.');
}

if (is_empty($_POST['pin'])) {
    $_POST['pin'] = '0000';
}

if (!$database->has('userroles', ['roleid' => $_POST['roleid']])) {
    die('Invalid role id.');
}

if (is_empty($_POST['userid'])) {
    $newid = $database->insert('users', ['username' => $_POST['username'], 'realname' => $_POST['realname'], 'pin' => $_POST['pin'], 'contactinfo' => $_POST['contactinfo'], 'userroles_roleid' => $_POST['roleid']]);
    $_POST['userid'] = $newid;
    header('Location: ./?action=edituser&userid=' . $newid);
} else {
    $database->update('users', ['username' => $_POST['username'], 'realname' => $_POST['realname'], 'pin' => $_POST['pin'], 'contactinfo' => $_POST['contactinfo'], 'userroles_roleid' => $_POST['roleid']], ['userid' => $_POST['userid']]);
    header('HTTP/1.0 204 No Content');
}
