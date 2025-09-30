<?php
// آدرس وب‌سایت هدف
$target_url = 'https://mrboytlg.ir/';

// استفاده از cURL برای دریافت محتوای صفحه
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // دنبال کردن ریدایرکت‌ها
// تنظیم یک User-Agent برای شبیه‌سازی یک مرورگر واقعی
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // در برخی سرورها برای جلوگیری از خطای SSL لازم است

$content = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// اگر محتوا با موفقیت دریافت شد
if ($http_code == 200) {
    // برای اصلاح آدرس‌های نسبی (مانند /css/style.css) تا به درستی بارگذاری شوند
    // این بخش ممکن است برای همه سایت‌ها به درستی کار نکند
    $base_url = '<base href="' . $target_url . '">';
    $content = preg_replace('/<head>/i', '<head>' . $base_url, $content, 1);

    // نمایش محتوای دریافت شده
    echo $content;
} else {
    echo "Error: Unable to fetch the content. Status code: " . $http_code;
}
?>
