<h1 class="page-header">Edit User</h1>
<?php
$userid;
if (!is_empty($_POST['userid'])) {
    $userid = $_POST['userid'];
}
// Enable the form to pass the new ID back in after save, prevent duplicate records
if (!is_empty($_GET['userid'])) {
    $userid = $_GET['userid'];
}

if (!is_empty($userid)) {
    $user = $database->select('users', '*', ['userid' => $userid])[0];
}
?>
<form action="doedituser.php" method="POST" onsubmit="prettysave();">
    <?php if (!is_empty($userid)) { ?>
        <input type="hidden" name="userid" value="<?php echo $userid; ?>" />
    <?php } ?>
    Real name: <input type="text" name="realname" placeholder="John Doe" required="required" class="form-control" value="<?php echo $user['realname']; ?>"/>
    <br />
    Username: <input type="text" name="username" placeholder="jdoe" required="required" class="form-control" value="<?php echo $user['username']; ?>"/>
    <br />
    Login PIN: <input type="text" name="pin" placeholder="1234" class="form-control" value="<?php echo $user['pin']; ?>"/>
    <br />
    Contact info / Notes:
    <textarea name="contactinfo">
        <?php echo $user['contactinfo']; ?>
    </textarea>
    <br />
    Role: 
    <select name="roleid" class="form-control">
        <?php
        $rolelist = $database->select("userroles", '*');
        foreach ($rolelist as $role) {
            echo "<option value=\"" . $role['roleid'] . "\" " . ($user['userroles_roleid'] == $role['roleid'] ? "selected" : "") . " >" . $role['rolename'] . "</option>";
        }
        ?>
    </select>
    <br />
    <button id="savebtn" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save User</button>
    <?php if (!is_empty($_GET['userid'])) { // The page just loaded from a new-user save  ?>
        <script>
            prettysave();
        </script>
    <?php } ?>
    <a class="btn btn-warning" href="./?action=userlist"><i class="fa fa-times"></i> Exit</a>
</form>
<script>
    function clearpretty() {
        setTimeout(function () {
            $('#savebtn').prop('disabled', false);
            $('#savebtn').html('<i class="fa fa-floppy-o"></i> Save User');
        }, 2000);
    }

    function prettysave() {
        $('#savebtn').prop('disabled', true);
        $('#savebtn').html('<i class="fa fa-check"></i> User Saved!');
        clearpretty();
    }
</script>