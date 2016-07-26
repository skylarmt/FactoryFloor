<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">FactoryFloor</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/?action=home">Home</a></li>
                <?php
                if ($_SESSION['loggedin'] == true) {
                    $userrole = $database->select('users', 'userroles_roleid', ['userid' => $_SESSION['userid']])[0];
                    if ($userrole == 0) {
                        ?>
                        
                        <?php
                    } else if ($userrole == 1) {
                        ?>
                        
                        <li><a href="/?action=tasklist">Tasks</a></li>
                        <li><a href="/?action=userlist">Users</a></li>
                        <?php
                    }
                    ?>
                    <li><a href="/?action=palletlist">Pallets</a></li>
                    <li><a href="/?action=tasks">My Tasks</a></li>
                    <?php
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SESSION['loggedin'] != true) { ?>
                    <li><a href="/?action=login">Log In</a></li>
                <?php } else { ?>
                    <li><a href="/dologout.php">Log Out</a></li>
                    <li><p class="navbar-text"><i class="fa fa-user"></i> <?php echo realnamefromid($_SESSION['userid']); ?></p></li>
                    <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>