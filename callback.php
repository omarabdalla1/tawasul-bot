<?php
session_start();

if (isset($_GET['code'])) {
    $client_id = "20fd4a59-fc93-40d4-aec4-e3ff321f9378";
    $client_secret = "33e332ba1938fc4b674a8537c28fae25";
    $redirect_uri = "https://tawasul-bot.onrender.com//callback.php";
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
