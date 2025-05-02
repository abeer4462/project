<?php
$con = mysqli_connect("localhost", "root", "", "makeupstore");

if (!$con) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if (!mysqli_query($con, $sql)) {
        die("خطأ في الإضافة: " . mysqli_error($con));
    }

    // التوجيه بعد النجاح
    header("Location: login.html");
    exit;
}

mysqli_close($con);
?>