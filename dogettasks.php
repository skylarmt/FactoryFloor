<?php
require_once 'required.php';

redirectifnotloggedin();

$tasks = $database->select('assigned_tasks', ['[>]tasks' => ['taskid' => 'taskid']], '*', ["AND" => ['assigned_tasks.userid' => $_SESSION['userid'], 'assigned_tasks.statusid' => [0, 1, 3, 4]]]);
if (count($tasks) > 0) {
    foreach ($tasks as $task) {
        $panelclass = 'panel-default';
        if (strtotime($task['taskdueby']) - time() < 60 * 60 * 1) { // less than one hour till deadline
            $panelclass = 'panel-danger';
        } else if (strtotime($task['taskdueby']) - time() < 60 * 60 * 3) { // less than three hours
            $panelclass = 'panel-warning';
        } else if (strtotime($task['taskdueby']) - time() < 60 * 60 * 8) { // less than eight hours
            $panelclass = 'panel-info';
        }
        echo "<div class='panel $panelclass'>"
        . "<div class='panel-heading'>"
        . "<h3 class='panel-title'>" . $task['tasktitle'];
        if ($task['statusid'] == 1) {
            echo "<span class='pull-right'><i class='fa fa-play'></i> Started</span>";
        }
        echo "</h3>"
        . "</div>"
        . "<div class='panel-body'>"
        . $task['taskdesc']
        . "</div>"
        . "<div class='panel-footer'>"
        . "<div class='row'>"
        . "<div class='col-xs-12 col-sm-6 col-md-6'>"
        . "<i class='fa fa-clock-o'></i> Assigned: " . date("F j, Y, g:i a", strtotime($task['taskassignedon']))
        . "<br />"
        . "<i class='fa fa-clock-o'></i> Due by: " . date("F j, Y, g:i a", strtotime($task['taskdueby']))
        . "</div>"
        . "<div class='col-xs-12 col-sm-6 col-md-6'>"
        . "Actions:<br />";
        if ($task['statusid'] == 0) {
            echo "<form action='task.php' method='POST' class='form-inline' style='display: inline-block;'>"
            . "<input type='hidden' name='taskid' value='" . $task['taskid'] . "' />"
            . "<input type='hidden' name='action' value='start' />"
            . "<button type='submit' class='btn btn-primary'><i class='fa fa-play'></i> Start</button>"
            . "</form>";
        } else if ($task['statusid'] == 1) {
            echo "<form action='task.php' method='POST' class='form-inline' style='display: inline-block; padding-left: 5px;'>"
            . "<input type='hidden' name='taskid' value='" . $task['taskid'] . "' />"
            . "<input type='hidden' name='action' value='finish' />"
            . "<button type='submit' class='btn btn-success'><i class='fa fa-stop'></i> Finish</button>"
            . "</form>";
        }
        echo "</div>"
        . "</div>"
        . "</div>"
        . "</div>";
    }
} else {
    echo "<div class='alert alert-info'><i class='fa fa-check'></i> You're all caught up!  If you need something to do, ask your boss :)</div>";
}
?>
<!--<pre><?php var_dump($tasks); ?></pre>-->