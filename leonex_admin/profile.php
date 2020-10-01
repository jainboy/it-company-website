<?php
include 'link.php';
include 'db/db.php';
include 'functions.php';
include 'topbar.php';
include 'sidebar.php';
ob_start();
// admin detail module
$first_name='';
$last_name='';
$email='';
$username='';
$image='';
if(isset($_SESSION['USER_LOGIN'])){
$image_required='';
$user_id=$_SESSION['USER_ID'];
$res=mysqli_query($con,"SELECT * FROM `admin` where id='$user_id'");
$check=mysqli_num_rows($res);
if($check>0){
$row=mysqli_fetch_assoc($res);
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$email=$row['email'];
$username=$row['username'];
$image=$row['image'];
}
}
if(isset($_POST['submit'])){
$user_id=$_SESSION['USER_ID'];
 if($_FILES['image']['name']!=''){
   $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
   move_uploaded_file($_FILES['image']['tmp_name'],'./assets/img/avatars/'.$image);
   mysqli_query($con,"UPDATE `admin` SET `image`='$image' WHERE `id`='$user_id'");
}
}
if(isset($_POST['submit1'])){
$username=get_safe_value($con,$_POST['username']);
$firstname=get_safe_value($con,$_POST['first_name']);
$lastname=get_safe_value($con,$_POST['last_name']);
$email=get_safe_value($con,$_POST['email']);
$user_id=$_SESSION['USER_ID'];
mysqli_query($con,"UPDATE `admin` SET `username`='$username',`firstname`='$firstname',`lastname`='$lastname',`email`='$email' WHERE `id`='$user_id'");
}

$user_id=$_SESSION['USER_ID'];  //change password module 
$msg3='';
if(isset($_POST['passwordsubmit'])){
 $oldpassword=get_safe_value($con,$_POST['oldpassword']);
 $newpassword=get_safe_value($con,$_POST['newpassword']);
 $repassword=get_safe_value($con,$_POST['retypepassword']);
 $res=mysqli_query($con,"SELECT * FROM `admin` WHERE `id`='$user_id' AND `password`='$oldpassword'");
 $check=mysqli_num_rows($res);
 if($check>0){
     if($newpassword==$repassword){
       mysqli_query($con,"UPDATE `admin` SET `password`='$newpassword' WHERE `id`='$user_id'");
     }
   else{
     $msg3="new password and re-type password not matched !!! ";
     }
 }else{
     $msg3="password Invalid";  
 }
} 
?>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin_dashboard">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="images/admin/users.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $firstname.' '.$lastname?></h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Other Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="username" value="<?php echo $username ?>" name="username" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="email" placeholder="user@example.com" value="<?php echo $email ?>" name="email" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="text" placeholder="John" value="<?php echo $firstname ?>" name="first_name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="John" value="<?php echo $lastname ?>" name="last_name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" name="submit1">Submit</button>
                        </div>
                      </div>
                    </form>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <p class="text-info">  Password Is must secure thing to providing best service so please change your password after a week or month. </p>
                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="old password" name="oldpassword" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" placeholder="new password" name="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Re-Type Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="retype password" name="retypepassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                      </div>
                      <h3 class="text-primary">Password must contain the following:</h3>
                      <ul class="text-info">
                        <li>Minimum 8 characters</li>
                        <li>1 Special Symbol.</li>
                        <li>1 Capital(uppercase) letter.</li>
                        <li>1 lowercase letter.</li>
                        <li>1 Numeric Value.</li>
                      </ul>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" name="passwordsubmit">Submit</button>
                        </div>
                      </div>
                      <div class="field_error"><?php echo $msg3?></div> 
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include 'footer.php';
?>