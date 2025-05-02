<?php
$con = mysqli_connect("localhost", "root", "", "makeupstore");
if (!$con)
{
die("فشل الاتصال: " . mysql_error($con));
}

mysqli_close($con);
?>