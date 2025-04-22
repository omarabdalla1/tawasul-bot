
<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    echo "من فضلك سجل الدخول أولاً عبر سلة.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // رفع الصورة من النموذج
    $image = $_FILES['image'];
    $watermark_type = $_POST['watermark_type'];
    $watermark_text = $_POST['watermark_text'];
    $position = $_POST['position'];
    $opacity = $_POST['opacity'];
    $resize = $_POST['resize'];

    // تطبيق العلامة المائية على الصورة
    // يمكن استخدام مكتبة GD أو ImageMagick

    $image_path = $image['tmp_name']; // مسار الصورة التي تم رفعها
    $image_type = $image['type'];

    // هنا نحتاج إلى الكود الذي يضيف العلامة المائية
    // مثلا باستخدام GD أو ImageMagick لتطبيق النص أو الشعار على الصورة
    // سيظل اسم الصورة بعد معالجة العلامة المائية في متغير $image_path

    // إرسال الصورة إلى سلة (إنشاء منتج جديد مع الصورة المحدثة)
    $access_token = $_SESSION['access_token'];
    $api_url = "https://api.salla.sa/products"; // URL API لتحميل المنتج

    // قراءة الصورة بعد إضافة العلامة المائية وتحويلها إلى صيغة base64 أو رفعها إلى خادم خارجي
    $image_data = base64_encode(file_get_contents($image_path));

    $product_data = array(
        'name' => 'اسم المنتج مع العلامة المائية',
        'price' => 100, // سعر المنتج
        'image' => $image_data, // الصورة المحدثة
        'description' => 'وصف المنتج'
    );

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $access_token",
        "Content-Type: application/json"
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($product_data));

    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);

    if (isset($response_data['data'])) {
        echo "تم رفع المنتج بنجاح.";
    } else {
        echo "فشل في رفع المنتج.";
    }
}
?>
