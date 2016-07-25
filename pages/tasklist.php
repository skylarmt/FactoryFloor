<?php
if ($_GET['action'] == 'tasklist') {
    // We're not on the home page, show a header
    ?>
<h1 class="page-header">Tasks</h1>
    <?php
}
?>
<div class="well well-sm">
    <a href="/?action=edittask" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New task</a>
</div>
<div id="tasksdispdiv" style="max-height: 600px; overflow-y: scroll;">
    <?php
    include 'dogettasklist.php';
    ?>
</div>
<br />
<script>
    function refreshTasks() {
        $.get('dogettasklist.php', function (data) {
            $('#tasksdispdiv').html(data);
        });
    }
    setInterval(function () {
        refreshTasks();
    }, 5 * 1000);
</script>