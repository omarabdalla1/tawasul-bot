<?php
$access_token = "YOUR_ACCESS_TOKEN"; // يجب استبدال هذا برمز التوكن الفعلي
$store_url = "https://api.salla.sa/v1/products"; // API Endpoint لجلب المنتجات

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $store_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $access_token"
));

$response = curl_exec($ch);
curl_close($ch);

$products = json_decode($response, true);
if ($products && isset($products['data'])) {
    echo "<h2>المنتجات:</h2>";
    foreach ($products['data'] as $product) {
        echo "<p>" . $product['name'] . "</p>";
    }
} else {
    echo "لم يتم العثور على منتجات.";
}
?>