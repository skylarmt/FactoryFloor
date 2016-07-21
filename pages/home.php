<?php
$userrole = userrolefromid($_SESSION['userid']);
?>
<!--<h1 class="page-header">Dashboard</h1>-->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <?php
        switch ($userrole) {
            case 0:
                echo "<h2 class='page-header'>My Tasks</h2>";
                include 'pages/tasks.php';
                break;
            case 1:
                echo "<h2 class='page-header'>Tasks</h2>";
                include 'pages/tasklist.php';
                break;
        }
        ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h2 class="page-header">Message Board</h2>
        <?php
            include 'pages/messages.php';
        ?>
    </div>
</div>