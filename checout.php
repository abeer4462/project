<?php
$con = mysqli_connect("localhost", "root", "", "makeupstore");

if (!$con) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email       = $_POST['email'];
    $city        = $_POST['city'];
    $district    = $_POST['district'];
    $street      = $_POST['street'];
    $card_number = $_POST['card-number'];
    $card_name   = $_POST['card-name'];

    $insert = "INSERT INTO orders (email, city, district, street, card_number, card_name)
               VALUES ('$email', '$city', '$district', '$street', '$card_number', '$card_name')";

    if (mysqli_query($con, $insert)) {
        header("Location: OrderConfirmation.html");
        exit;
    } else {
        echo "حدث خطأ أثناء حفظ الطلب: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>