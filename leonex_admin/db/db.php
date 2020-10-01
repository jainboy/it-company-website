<?php 
$con=mysqli_connect('localhost','root','','leonex_technology');
if($con==false)
{
    ?>
    <script>
        alert('connection error');
    </script>
    <?php
}
?>