<?php
include 'link.php';
include 'db/db.php';
include 'functions.php';
include 'topbar.php';
include 'sidebar.php';
ob_start();
$categories='';
$description='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
   $id=get_safe_value($con,$_GET['id']);
   $res=mysqli_query($con,"SELECT * FROM `category` WHERE `id`='$id'");
   $check=mysqli_num_rows($res);
   if($check>0){
      $row=mysqli_fetch_assoc($res);
      $categories=$row['category_name'];
      $description=$row['category_description'];
   }
   else{
     header('location:category.php');
      die();
   }
}
if(isset($_POST['submit'])){
   $categories=get_safe_value($con,$_POST['cat_name']);
   $description=get_safe_value($con,$_POST['description']);
  $res=mysqli_query($con,"SELECT * FROM `category` WHERE `category_name`='$categories'");
  $check=mysqli_num_rows($res);
  if($check>0){
    if(isset($_GET['id']) && $_GET['id']!=''){
      $getData=mysqli_fetch_assoc($res);
      if($id==$getData['id']){
         
      }else{
        $msg="Categories already exist";
      }
    }else{
      $msg="Categories already exist";
    }
  } 
  if($msg==''){
    if(isset($_GET['id']) && $_GET['id']!=''){
      mysqli_query($con,"UPDATE `category` SET `category_name`='$categories',`category_description`='$description' WHERE `id`='$id'");
    }else{
      mysqli_query($con,"INSERT INTO `category`(`category_name`, `category_description`,`status`) VALUES ('$categories','$description','1')");
      }
      header('location:category.php');
    die();
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
            <button class="btn btn-info">  <a href="all_category" class="alink"> Back</a></button>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <!-- Input addon -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Category Insert</h3>
              </div>
              <div class="card-body text-info">
              <form method="post">
                <div class="form-group">
                    <label><strong>Category Name</strong></label>
                    <input class="form-control" type="text" value="<?php echo $categories?>" name="cat_name">
                </div>
                <div class="form-group">
                    <label><strong>Description</strong></label>
                    <textarea class="form-control" name="description" rows="10"><?php echo $description?></textarea>
                </div>
                <div class="form-group"><button class="btn btn-info btn-sm" type="submit" name="submit">Save&nbsp;</button></div>
                <div class="field_error"><?php echo $msg?></div>
            </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Horizontal Form -->
          </div>
          <!--/.col (left) -->
      
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