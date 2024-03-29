<?php
require_once 'required.php';

redirectifnotloggedin();
/* $messages = $database->select('messages', '*', [['messageid[>]' => '0'],
  "ORDER" => "time DESC",
  "LIMIT" => 30
  ]); */

$messages = $database->query('SELECT * FROM messages ORDER BY messagedate DESC LIMIT 10')->fetchAll();
//var_dump($messages);
//$messages = array_reverse($messages); // Show newest on top
if (count($messages) > 0) {
    foreach ($messages as $msg) {
        ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo strip_tags($msg['messagetext']); ?>
            </div>
            <div class="panel-footer">
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
                                  action="dodeletemsg.php" method="GET"
                                  onsubmit="$('#delmsgbtn<?php echo $msg['messageid']; ?>').prop('disabled', true);">
                                <input type="hidden" name="msgid" value="<?php echo $msg['messageid']; ?>" />
                                <button type="submit" id="delmsgbtn<?php echo $msg['messageid']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "<div class='alert alert-info'><i class='fa fa-commenting-o'></i> It's very quiet in here.  A little <i>too</i> quiet, perhaps?</div>";
}
?>