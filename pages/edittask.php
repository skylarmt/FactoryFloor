<h1 class="page-header">Edit Task</h1>
<?php
$taskid;
if (!is_empty($_POST['taskid'])) {
    $taskid = $_POST['taskid'];
}
// Enable the form to pass the new ID back in after save, prevent duplicate records
if (!is_empty($_GET['taskid'])) {
    $taskid = $_GET['taskid'];
}

if (!is_empty($taskid)) {
    $task = $database->select('tasks', '*', ['taskid' => $taskid])[0];
}
?>
<form action="doedittask.php" method="POST" onsubmit="prettysave();">
    <?php if (!is_empty($taskid)) { ?>
        <input type="hidden" name="taskid" value="<?php echo $taskid; ?>" />
    <?php } ?>
    Task Title: <input type="text" name="tasktitle" placeholder="Task Title" required="required" class="form-control" value="<?php echo $task['tasktitle']; ?>"/>
    <br />
    Task Description:
    <textarea name="taskdesc" id="taskdesc">
        <?php echo $task['taskdesc']; ?>
    </textarea>
    <br />
    <button id="savebtn" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save Task</button>
    <?php if (!is_empty($_GET['taskid'])) { // The page just loaded from a new-task save?>
        <script>
            prettysave();
        </script>
    <?php } ?>
    <a class="btn btn-warning" href="./"><i class="fa fa-times"></i> Cancel</a>
</form>
<script>
    function clearpretty() {
        setTimeout(function () {
            $('#savebtn').prop('disabled', false);
            $('#savebtn').html('<i class="fa fa-floppy-o"></i> Save Task');
        }, 2000);
    }

    function prettysave() {
        $('#savebtn').prop('disabled', true);
        $('#savebtn').html('<i class="fa fa-check"></i> Task Saved!');
        clearpretty();
    }
</script>