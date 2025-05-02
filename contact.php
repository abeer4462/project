<?php
$con = mysqli_connect("localhost", "root", "", "makeupstore");

if (!$con) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_message (name, email, message) VALUES ('$name', '$email', '$message')";
    if (!mysqli_query($con, $sql)) {
        die("حدث خطأ في إرسال الرسالة: " . mysqli_error($con));
    }

    echo "تم إرسال رسالتك بنجاح!";
}

mysqli_close($con);
?>