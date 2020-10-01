<?php
session_start();
$admin_id=$_SESSION['USER_ID'];
$admin_name=$_SESSION['USER_NAME'];
session_unset();
        $added_on=date('Y-m-d h:i:s');
        include 'db/db.php';
        mysqli_query($con,"INSERT INTO `admin_logs`(`admin_id`, `admin_name`, `logs_time`, `event`) VALUES ('$admin_id','$admin_name','$added_on','LOG_OUT')");
        header("location:index")
    ?>