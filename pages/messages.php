<form action="dosendmsg.php" method="POST" onsubmit="setTimeout(function () {
            $('#msgsendbox').val('');
            refreshMsgs();
        }, 100);">
    <div class="input-group">
        <input type="text" id="msgsendbox" name="msg" class="form-control" placeholder="Post message" autocomplete="off">
        <span class="input-group-btn">
            <button id="msgsendbtn" class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Post</button>
        </span>
    </div>
</form>
<!--<p><i class="fa fa-info-circle"></i> Messages are shown to all users.  Think of it as a bulletin board or whiteboard.</p>-->
<br />
<div id="messagedispdiv" style="max-height: 500px; overflow-y: scroll;">
    <?php
    include 'dogetmsgs.php';
    ?>
</div>
<br />
<script>
    function refreshMsgs() {
        $.get('dogetmsgs.php', function (data) {
            $('#messagedispdiv').html(data);
        });
    }
    setInterval(function () {
        refreshMsgs();
    }, 5 * 1000);
</script>