<?php
session_start();

// الاتصال بقاعدة البيانات
$con = mysqli_connect("localhost", "root", "", "makeupstore");

if (!$con) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// التحقق من طريقة الإرسال
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // التأكد أن المستخدم مسجل الدخول
    if (!isset($_SESSION['email'])) {
        echo "يجب تسجيل الدخول قبل إتمام الطلب.";
        exit;
    }

    // أخذ البيانات من النموذج
    $email           = $_SESSION['email'];
    $city            = $_POST['city'];
    $district        = $_POST['district'];
    $street          = $_POST['street'];
    $postal_code     = $_POST['postal-code'];
    $address_details = $_POST['address-details'];
    $card_number     = $_POST['card-number'];
    $card_name       = $_POST['card-name'];
    $card_expiry     = $_POST['card-expiry'];
    $cvv             = $_POST['cvv'];

    // التأكد أن الإيميل موجود في جدول المستخدمين
    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $check);

    if (mysqli_num_rows($result) == 1) {
        // إدخال الطلب في جدول orders
        $insert = "INSERT INTO orders (
            email, city, district, street, postal_code, address_details,
            card_number, card_name, card_expiry, cvv
        ) VALUES (
            '$email', '$city', '$district', '$street', '$postal_code', '$address_details',
            '$card_number', '$card_name', '$card_expiry', '$cvv'
        )";

        if (mysqli_query($con, $insert)) {
            header("Location: OrderConfirmation.html");
            exit;
        } else {
            echo "حدث خطأ أثناء تسجيل الطلب: " . mysqli_error($con);
        }
    } else {
        echo "البريد الإلكتروني غير موجود في قاعدة البيانات.";
    }
}

mysqli_close($con);
?>?>