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
        <script src="js/tinymce/tinymce.min.js"></script>
        <script>tinymce.init({selector: 'textarea'});</script>
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
                case 'edittask':
                    include 'pages/edittask.php';
                    break;
                case 'edituser':
                    include 'pages/edituser.php';
                    break;
                case 'tasks':
                    include 'pages/tasks.php';
                    break;
                case 'tasklist':
                    include 'pages/tasklist.php';
                    break;
                case '':
                case 'home':
                    include 'pages/home.php';
                    break;
                case 'palletlist':
                    include 'pages/palletlist.php';
                    break;
                case 'editpallet':
                    include 'pages/editpallet.php';
                    break;
                case 'printpallet':
                    include 'pages/printpallet.php';
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
        <br />
    </body>
</html>
