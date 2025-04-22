<?php
session_start();

if (isset($_GET['code'])) {
    $client_id = "0c264d61-51ab-4281-b9e4-207c98f42ed1";
    $client_secret = "a23a1c840b965e078168823486da1650";
    $redirect_uri = "http://localhost/salla_api_project/callback.php";
    $code = $_GET['code'];
    
    $url = "https://auth.salla.sa/oauth/token";
    $data = array(
        "grant_type" => "authorization_code",
        "client_id" => $client_id,
        "client_secret" => $client_secret,
        "redirect_uri" => $redirect_uri,
        "code" => $code
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);
    if (isset($response_data['access_token'])) {
        $_SESSION['access_token'] = $response_data['access_token'];
        echo "تم تسجيل الدخول بنجاح. يمكنك العودة إلى <a href='upload_form.php'>صفحة رفع الصورة</a>";
    } else {
        echo "فشل في الحصول على Access Token. من فضلك حاول مرة أخرى.";
    }
}
?>
