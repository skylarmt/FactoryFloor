<?php
if ($_GET['action'] == 'userlist') {
    // We're not on the home page, show a header
    ?>
<h1 class="page-header">Users</h1>
    <?php
}
?>
<div class="well well-sm hidden-print">
    <a href="./?action=edituser" class="btn btn-sm btn-primary"><i class="fa fa-user-plus"></i> New user</a>
</div>
<?php
$users = $database->select('users', ['[>]userroles' => ['userroles_roleid' => 'roleid']], '*', ['ORDER' => 'users.username DESC']);
//var_dump($messages);
//$messages = array_reverse($messages); // Show newest on top
foreach ($users as $user) {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php echo $user['realname']; ?>
                <span class="pull-right">
                    <form action='./?action=edituser' method='POST' class='form-inline' style='display: inline-block;'>
                        <input type='hidden' name='userid' value='<?php echo $user['userid']; ?>' />
                        <input type='hidden' name='action' value='edit' />
                        <button type='submit' class='hidden-print btn btn-sm btn-link' style="margin-top: -5px; margin-right: -5px;"><i class='fa fa-pencil'></i></button>
                    </form>
                </span>
            </h3>
        </div>
        <div class="panel-body">
            Username: <?php echo $user['username']; ?>
            <br />
            Role: <?php echo $user['rolename']; ?>
            <br />
            Contact Info / Notes:
            <div class="well well-sm">
                <?php echo $user['contactinfo']; ?>
            </div>
        </div>
        <!--<div class="panel-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <i class="fa fa-user"></i> <?php echo realnamefromid($msg['senderid']); ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6" style="text-align: right;">
                    <i class='fa fa-clock-o'></i> <?php echo date("F j, Y, g:i a", strtotime($msg['messagedate'])); ?>
        <?php
        if (userrolefromid($_SESSION['userid']) > 0) {
            ?>
                                <form style="display: inline-block;"
                                      action="/dodeletemsg.php" method="GET"
                                      onsubmit="$('#delmsgbtn<?php echo $msg['messageid']; ?>').prop('disabled', true);">
                                    <input type="hidden" name="msgid" value="<?php echo $msg['messageid']; ?>" />
                                    <button type="submit" id="delmsgbtn<?php echo $msg['messageid']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
            <?php
        }
        ?>
                </div>
            </div>
        </div>-->
    </div>
    <?php
}
?>