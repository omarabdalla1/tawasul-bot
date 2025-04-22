<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    echo "من فضلك سجل الدخول أولاً عبر سلة.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة علامة مائية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 40px;
            color: #333;
        }
        .container {
            max-width: 600px;
            background: white;
            margin: auto;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #111;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: inherit;
        }
        .row {
            display: flex;
            gap: 10px;
        }
        .row > div {
            flex: 1;
        }
        button {
            background: #0066cc;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            font-size: 16px;
        }
        button:hover {
            background: #0055aa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>إضافة علامة مائية للصورة</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label>الصورة الأصلية:</label>
            <input type="file" name="image" required>
            <label>نوع العلامة المائية:</label>
            <select name="watermark_type" id="watermark_type" onchange="toggleWatermarkFields()" required>
                <option value="text">نص</option>
                <option value="logo">شعار</option>
            </select>
            <div id="text_options">
                <label>نص العلامة:</label>
                <input type="text" name="watermark_text">
                <label>نوع الخط:</label>
                <select name="font">
                    <option value="arial">Arial</option>
                    <option value="cairo">Cairo</option>
                    <option value="tahoma">Tahoma</option>
                </select>
                <label>حجم الخط (px):</label>
                <input type="number" name="font_size" value="24" min="8">
                <label>لون الخط (Hex):</label>
                <input type="color" name="font_color" value="#ffffff">
            </div>
            <div id="logo_options" style="display:none;">
                <label>صورة الشعار (PNG فقط):</label>
                <input type="file" name="watermark_logo">
            </div>
            <label>موضع العلامة المائية:</label>
            <select name="position">
                <option value="top-left">أعلى اليسار</option>
                <option value="top-right">أعلى اليمين</option>
                <option value="bottom-left">أسفل اليسار</option>
                <option value="bottom-right" selected>أسفل اليمين</option>
                <option value="center">في المنتصف</option>
            </select>
            <div class="row">
                <div>
                    <label>الشفافية (%):</label>
                    <input type="number" name="opacity" value="50" min="0" max="100">
                </div>
                <div>
                    <label>تصغير الصورة (%):</label>
                    <input type="number" name="resize" value="100" min="10" max="100">
                </div>
            </div>
            <button type="submit">إنشاء الصورة</button>
        </form>
    </div>
    <script>
        function toggleWatermarkFields() {
            const type = document.getElementById('watermark_type').value;
            document.getElementById('text_options').style.display = (type === 'text') ? 'block' : 'none';
            document.getElementById('logo_options').style.display = (type === 'logo') ? 'block' : 'none';
        }
    </script>
</body>
</html>
