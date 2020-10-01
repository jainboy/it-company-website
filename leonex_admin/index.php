<?php 
session_start();
include 'link.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Hawai</b>ADDA</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forget_password">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
<?php
ob_start();
    include './db/db.php';
    if(isset($_POST['submit'])){
        $username=$_POST['email'];
        $password=$_POST['password'];
        $rememberme = $_POST['remember'];
        $res=mysqli_query($con,"SELECT * FROM `admin` WHERE `email`='$username' AND `password`='$password'");
            $check_user=mysqli_num_rows($res);
            if($check_user>0){
                $row=mysqli_fetch_assoc($res);
                $_SESSION['USER_LOGIN']='yes';
                $_SESSION['USER_ID']=$row['id'];
                $_SESSION['USER_NAME']=$row['username'];      
                $_SESSION['USER_IMAGE']=$row['image'];
                $_SESSION['ROLE']=$row['role'];  
                $admin_id=$_SESSION['USER_ID'];
                $admin_name=$_SESSION['USER_NAME'];
                $added_on=date('Y-m-d h:i:s');
                mysqli_query($con,"INSERT INTO `admin_logs`(`admin_id`, `admin_name`, `logs_time`, `event`) VALUES ('$admin_id','$admin_name','$added_on','LOG_IN')");

                if($_POST["remember"]=='1' || $_POST["remember"]=='on')
                    {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $username, $hour);
                         setcookie('password', $password, $hour);
                    }     
                ?>
                <script>
                    window.open('admin_dashboard','_self');
                </script>
                <?php   
            }
            else
            {
            ?>
            <script>
                alert('username and password invalid !!');
                window.open('index.php','_self');
            </script>
            <?php        
            }
        }
    ?>