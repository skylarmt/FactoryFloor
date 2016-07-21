<?php
$userrole = userrolefromid($_SESSION['userid']);
?>
<h1 class="page-header">Dashboard</h1>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h2 class="page-header">My Tasks</h2>
        <?php
        switch ($userrole) {
            case 0:
                include 'pages/tasks.php';
                break;
            case 1:
                include 'pages/tasklist.php';
        }
        ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h2 class="page-header">Public Messages</h2>
        <?php
            include 'pages/messages.php';
        ?>
    </div>
</div>