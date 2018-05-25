<?php
session_start();
if ($_POST['captcha'] != $_SESSION['code']) {
    $_SESSION['message'] = "Wrong Captcha code, try again!";
    header("location: index.php");
    die();
}

include "pass.php";
$dbuser = "thietn";
$db = "SSID";
$connect = OCILogon($dbuser, $password, $db);
if (!$connect) {
    $_SESSION['message'] = "An error occurred connecting to the database";
    header("location: index.php");
    die();
}

$query = "SELECT * FROM Login";

$stmt = OCIParse($connect, $query);
if (!$stmt) {
    $_SESSION['message'] = "An error occurred in parsing the SQL string.";
    header("location: index.php");
    die();
}
OCIExecute($stmt);
while (OCIFetch($stmt)) {
    $username = OCIResult($stmt, "USERNAME");
    $password = OCIResult($stmt, "PASSWORD");
    if ($_POST["username"] == $username && $_POST["password"] == $password) {
        $_SESSION['username'] = $_POST["username"];
        $_SESSION['logged_in'] = true;
        OCILogOff($connect);
        if ($username == "admin") {
            $_SESSION['is_admin'] = true;
        } else {
            $_SESSION['is_admin'] = false;
        }
        header("location: index.php");
    }
}

$_SESSION['message'] = "You have entered wrong password, try again!";
OCILogOff($connect);
header("location: index.php");
?>
