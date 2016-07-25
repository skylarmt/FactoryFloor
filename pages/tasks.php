<?php
if ($_GET['action'] == 'tasks') {
    // We're not on the home page, show a header
    ?>
    <h1 class="page-header">My Tasks</h1>
    <?php
}
?>
<div id="tasksdispdiv" style="max-height: 600px; overflow-y: scroll;">
    <?php
    include 'dogettasks.php';
    ?>
</div>
<br />
<script>
    function refreshTasks() {
        $.get('dogettasks.php', function (data) {
            $('#tasksdispdiv').html(data);
        });
    }
    setInterval(function () {
        refreshTasks();
    }, 5 * 1000);
</script>