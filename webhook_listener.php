<?php
// ملف webhook_listener.php

// استلام البيانات من سلة
$data = json_decode(file_get_contents('php://input'), true);

// التحقق مما إذا كانت البيانات تحتوي على معلومات المصادقة المطلوبة
if (isset($data['access_token']) && isset($data['refresh_token'])) {
    $access_token = $data['access_token'];
    $refresh_token = $data['refresh_token'];
    
    // تخزين الرموز في قاعدة البيانات أو الجلسة أو مكان مناسب
    // على سبيل المثال:
    $_SESSION['access_token'] = $access_token;
    $_SESSION['refresh_token'] = $refresh_token;

    echo "تم الحصول على Access Token و Refresh Token بنجاح!";
} else {
    echo "لم يتم العثور على الرموز في البيانات المرسلة.";
}
?>
