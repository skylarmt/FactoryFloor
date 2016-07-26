<?php
require_once 'required.php';

redirectifnotloggedin();

if (userrolefromid($_SESSION['userid']) < 1) {
    die();
}

$tasks = $database->select('tasks', '*');
if (count($tasks) > 0) {
    foreach ($tasks as $task) {
        echo "<div class='panel panel-default'>"
        . "<div class='panel-heading'>"
        . "<h3 class='panel-title'>" . $task['tasktitle'];
        // Pull in the status info if the task is assigned to someone
        if ($database->has('assigned_tasks', ['taskid' => $task['taskid']])) {
            $tass = $database->select('assigned_tasks', '*', ['taskid' => $task['taskid']])[0];
            echo "<span class='pull-right'>";
            echo "<i class='fa fa-user'></i> " . usernamefromid($tass['userid']) . "&nbsp;&nbsp;";
            switch ($tass['statusid']) {
                case 0:
                    echo "<i class='fa fa-ellipsis-h'></i> Pending";
                    break;
                case 1:
                    echo "<i class='fa fa-play'></i> Started";
                    break;
                case 2:
                    echo "<i class='fa fa-check'></i> Finished";
                    break;
                case 3:
                    echo "<i class='fa fa-pause'></i> Paused";
                    break;
                case 4:
                    echo "<i class='fa fa-stop'></i> Problem";
                    break;
            }
            echo "</span>";
        }
        echo "</h3>"
        . "</div>"
        . "<div class='panel-body'>"
        . $task['taskdesc']
        . "</div>"
        . "<div class='panel-footer'>"
        . "<div class='row'>"
        . "<div class='col-xs-12 col-sm-8 col-md-8'>"
        . "<i class='fa fa-clock-o'></i> Assigned: " . ($task['taskassignedon'] > 0 ? date("F j, Y, g:i a", strtotime($task['taskassignedon'])) : "No assigned date")
        . "<br />"
        . "<i class='fa fa-clock-o'></i> Due by: " . ($task['taskdueby'] > 0 ? date("F j, Y, g:i a", strtotime($task['taskdueby'])) : "No due date")
        . "</div>"
        . "<div class='col-xs-12 col-sm-4 col-md-4'>"
        . "<div class='pull-right'>";
        echo "<form action='./?action=edittask' method='POST' class='form-inline' style='display: inline-block;'>"
        . "<input type='hidden' name='taskid' value='" . $task['taskid'] . "' />"
        . "<input type='hidden' name='action' value='edit' />"
        . "<button type='submit' class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>"
        . "</form>";
        echo "<form action='dodeletetask.php' onsubmit='$(\"#deltaskbtn" . $task['taskid'] . "\").prop(\"disabled\", true);' method='POST' class='form-inline' style='display: inline-block; padding-left: 5px;'>"
        . "<input type='hidden' name='taskid' value='" . $task['taskid'] . "' />"
        . "<input type='hidden' name='action' value='delete' />"
        . "<button type='submit' id='deltaskbtn" . $task['taskid'] . "' class='btn btn-sm btn-danger'><i class='fa fa-trash-o'></i></button>"
        . "</form>";
        echo "</div>"
        . "</div>"
        . "</div>"
        . "</div>"
        . "</div>";
    }
} else {
    echo "<div class='alert alert-info'><i class='fa fa-check'></i> There aren't any tasks.  Be a boss and make some!</div>";
}
//var_dump($tasks);
?>