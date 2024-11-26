<?php
include 'db_connect.php'; // ربط ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $country = $_POST['country'];
    $subject = $_POST['subject'];

    // تأمين البيانات لتجنب هجمات SQL Injection
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $country = mysqli_real_escape_string($conn, $country);
    $subject = mysqli_real_escape_string($conn, $subject);

    // إدراج البيانات في جدول contact_messages
    $sql = "INSERT INTO contact_messages (first_name, last_name, country, subject)
            VALUES ('$first_name', '$last_name', '$country', '$subject')";

    if ($conn->query($sql) === TRUE) {
        echo "تم إرسال رسالتك بنجاح!";
        echo '<br><a href="html.html"><button>العودة إلى الصفحة الرئيسية</button></a>';
    } else {
        echo "خطأ: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
