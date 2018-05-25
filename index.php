<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>SIT780 Assignment 2</title>
    <?php include 'css/css.html'; ?>
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['logged_in'] == false) {
    if (isset($_POST['login']) && $_SESSION['logged_in'] != true) {
        require 'login.php';
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['logged_in'] == true && isset($_POST['search'])) {
    include 'profile.php';


} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['logged_in'] == true) {
    include 'profile.php';
}
else { ?>
<body>
<div class="form">
    <h1 id="welcome">Account Login <i class="fas fa-user-circle"></i></h1>

    <form action="login.php" method="post">
        <div class="field-wrap">
            <label>
                User Name<span class="req">*</span>
            </label>
            <input type="text" autocomplete="off" name="username" value="admin"/>
        </div>

        <div class="field-wrap">
            <label>
                Password<span class="req">*</span>
            </label>
            <input type="password" autocomplete="off" name="password" value="SIT780"/>

        </div>

        <div class="field-wrap">
            <label>
                <img src="captcha.php"/><span class="req">*</span>
            </label>
            <input type="text" name="captcha"/>
        </div>

        <button class="btn btn-outline-primary button button-no-radius" name="login"/>
        <i class="fa fa-sign-in-alt"></i> Log In</button>

        <div>
            <br>
            For guest access: <br>
            username/password is guest/SIT780
        </div>
    </form>
</div>

<?php
if (isset($_SESSION['message'])) { ?>
    <div class="form bg-danger" style="margin-top: 0;">
        <h1 class="p-2 bg-danger text-white">Error</h1>
        <p class="description">
            <?php echo $_SESSION['message'] ?>
        </p>
    </div>

    <?php
    $_SESSION['message'] = null;
}
?>
</body>
</html>
<?php } ?>
