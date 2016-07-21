<?php
require 'required.php';

$_SESSION['userid'] = '';
$_SESSION['loggedin'] = false;

session_destroy();
header('Location: /?action=loggedout');