<?php
session_start();

$client_id = "0c264d61-51ab-4281-b9e4-207c98f42ed1";
$redirect_uri = "http://localhost/salla_api_project/callback.php";
$auth_url = "https://auth.salla.sa/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_uri&response_type=code&scope=offline_access products.read";

if (!isset($_SESSION['access_token'])) {
    echo '<a href="' . $auth_url . '">تسجيل الدخول باستخدام سلة</a>';
} else {
    echo 'تم تسجيل الدخول بالفعل. <a href="logout.php">تسجيل الخروج</a>';
}
?>
