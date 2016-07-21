<div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Log In</h3>
            </div>
            <div class="panel-body">
                <?php
                if (!is_empty($_GET['err'])) {
                    $errcode = strip_tags($_GET['err']);
                    $errmsg = 'An error occurred: ' . $errcode;
                    switch ($errcode) {
                        case 'badpin':
                            $errmsg = 'PIN incorrect.  Try again.';
                            break;
                        case 'nouser':
                            $errmsg = 'No user ID supplied.';
                            break;
                        case 'invaliduser':
                            $errmsg = 'That user does not exist!';
                            break;
                    }
                    ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-times"></i> <?php echo $errmsg; ?>
                </div>
                <?php
                }
                ?>
                <form action="/dologin.php" method="POST">
                    <label><i class="fa fa-user"></i> User ID:</label>
                    <select name="user" class="form-control">
                        <?php
                        $userlist = $database->select("users", ['userid', 'username', 'realname']);
                        foreach ($userlist as $user) {
                            echo "<option value=\"" . $user['userid'] . "\">" . $user['username'] . " (" . $user['realname'] . ")" . "</option>";
                        }
                        ?>
                    </select>
                    <br />
                    <label><i class="fa fa-key"></i> PIN code:</label>
                    <input type="password" name="pin" class="form-control" />
                    <br />
                    <input type="submit" value="Log in" class="btn btn-primary"/>
                </form>
            </div>
        </div>
    </div>
</div>