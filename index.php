<?php
require 'required.php';

redirectifnotloggedin();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FactoryFloor</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/app.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            include 'header.php';
            ?>
            <?php
            switch ($_GET['action']) {
                case 'login':
                    include 'pages/login.php';
                    break;
                case 'loggedout':
                    include 'pages/loggedout.php';
                    break;
                case 'home':
                case 'tasks':
                case 'tasklist':
                case '':
                    include 'pages/home.php';
                    break;
                case 'userlist':
                    include 'pages/userlist.php';
                    break;
                default:
                    include 'pages/404.php';
                    break;
            }
            ?>
        </div>
    </body>
</html>
