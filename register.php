<?php
include 'db_connect.php'; // ربط ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // التحقق من تطابق كلمة المرور
    if ($password !== $confirm_password) {
        die("كلمة المرور غير متطابقة.");
    }

    // تأمين البيانات لتجنب هجمات SQL Injection
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $password = password_hash($password, PASSWORD_DEFAULT); // تشفير كلمة المرور

    // التحقق من عدم وجود المستخدم
    $sql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        die("اسم المستخدم أو البريد الإلكتروني موجود بالفعل."); // رسالة خطأ إذا كان موجودًا
    }

    // إدراج المستخدم الجديد في قاعدة البيانات
    $sql = "INSERT INTO users (first_name, last_name, email, username, password)
            VALUES ('$first_name', '$last_name', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "تم التسجيل بنجاح! يمكنك الآن تسجيل الدخول.";
        echo '<br><a href="html.html"><button>العودة إلى الصفحة الرئيسية</button></a>';
    } else {
        echo "خطأ: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
