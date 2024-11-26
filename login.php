<?php
include 'db_connect.php'; // ربط ملف الاتصال بقاعدة البيانات

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // تأمين البيانات
    $username = mysqli_real_escape_string($conn, $username);

    // البحث عن المستخدم
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // التحقق من كلمة المرور
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            echo "تم تسجيل الدخول بنجاح!";
            echo '<br><a href="html.html"><button>العودة إلى الصفحة الرئيسية</button></a>';
        } else {
            echo "كلمة المرور غير صحيحة.";
        }
    } else {
        echo "اسم المستخدم غير موجود.";
    }

    $conn->close();
}
?>
