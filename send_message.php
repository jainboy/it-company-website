<?php
include 'functions.php';
include './leonex_admin/db/db.php';
$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$phone=get_safe_value($con,$_POST['phone']);
$subject=get_safe_value($con,$_POST['subject']);
$message=get_safe_value($con,$_POST['message']);
$added_on=date('Y-m-d h:i:s');

mysqli_query($con,"INSERT INTO `contact_us`(`name`,`email`,`phone`,`subject`,`comment`,`added_on`) VALUES ('$name','$email','$phone','$subject','$message','$added_on')");
echo "insert";
?>