<?php
require 'required.php';

$user = $_POST['user'];
$pin = $_POST['pin'];

if (is_empty($pin)) {
    $pin = '0000';
}

if (is_empty($user)) {
    header('Location: ./?action=login&err=nouser');
    die();
}

if ($database->has('users', ['userid' => $user])) {
    if ($database->select('users', 'pin', ['userid' => $user])[0] == $pin) {
        $_SESSION['userid'] = $user;
        $_SESSION['loggedin'] = true;
        header('Location: /');
    } else {
        header('Location: ./?action=login&err=badpin');
        die();
    }
} else {
    header('Location: ./?action=login&err=invaliduser');
    die();
}