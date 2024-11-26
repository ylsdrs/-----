<?php
$servername = "localhost";
$username = "root"; // اسم المستخدم الافتراضي هو "root"
$password = ""; // كلمة المرور الافتراضية تكون فارغة
$dbname = "user_registration"; // اسم قاعدة البيانات

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
