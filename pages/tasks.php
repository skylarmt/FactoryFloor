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