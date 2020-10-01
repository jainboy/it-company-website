<?php
include 'link.php';
include 'db/db.php';
include 'functions.php';
include 'topbar.php';
include 'sidebar.php';
ob_start();
$title='';
$content='';
$author='';
$date='';
$image='';
$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
  $image_required='';
  $id=get_safe_value($con,$_GET['id']);
  $res=mysqli_query($con,"SELECT * FROM `blog_article` WHERE `id`='$id'");
  $check=mysqli_num_rows($res);
  if($check>0){
     $row=mysqli_fetch_assoc($res);
     $title=$row['title'];
     $content=$row['content']; 
     $author=$row['author'];
     $category=$row['category']; 
     $image=$row['blog_image'];
  }
  else{
    header('location:blog.php');
     die();
  }
}

if(isset($_POST['submit'])){
  $title=get_safe_value($con,$_POST['title']);
  $content=get_safe_value($con,$_POST['content']);
  $author=get_safe_value($con,$_POST['author']);
  $category=get_safe_value($con,$_POST['category']);
  $added_on=date('Y-m-d h:i:s');
 $res=mysqli_query($con,"SELECT * FROM `blog_article` WHERE `title`='$title'");
 $check=mysqli_num_rows($res);
 if($check>0){
   if(isset($_GET['id']) && $_GET['id']!=''){
     $getData=mysqli_fetch_assoc($res);
     if($id==$getData['id']){
        
     }else{
       $msg="blog already exist";
     }
   }else{
     $msg="blog already exist";
   }
  } 
 if($msg==''){
   if(isset($_GET['id']) && $_GET['id']!=''){
        if($_FILES['image']['name']!=''){
           $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
           move_uploaded_file($_FILES['image']['tmp_name'],'./dist/img/article/'.$image);
     mysqli_query($con,"UPDATE `blog_article` SET `title`='$title',`content`='$content',`author`='$author',`category`='$category',`date`='$added_on',`blog_image`='$image' WHERE `id`='$id'");
     }
     else{
     mysqli_query($con,"UPDATE `blog_article` SET `title`='$title',`content`='$content',`author`='$author',`category`='$category',`date`='$added_on' WHERE `id`='$id'");
     }
  }else{
           $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
           move_uploaded_file($_FILES['image']['tmp_name'],'./dist/img/article/'.$image);
     mysqli_query($con,"INSERT INTO `blog_article`(`title`, `content`, `author`, `category`,`date`,`blog_image`,`status`) VALUES ('$title','$content','$author','$category','$added_on','$image','1')");
     }
     header('location:blog.php');
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
            <button class="btn btn-info">  <a href="all_blog" class="alink"> Back</a></button>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog</li>
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
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label><strong>Title</strong></label>
                    <input class="form-control" type="text" value="<?php echo $title?>"name="title">
                </div>
                <div class="form-group">
                    <label><strong>Description</strong></label>
                    <textarea class="form-control" id="textarea" name="content" rows="20"><?php echo $content?></textarea>
                </div>
                <?php if(isset($_GET['id']) && $_GET['id']!=''){ ?>
                    <div class="form-group">
                        <label><strong>Category Old</strong></label>
                        <?php
                            if($row['category']!=''){?>
                                <input type="text" class="form-control" value="<?php echo $category ?>"></option>
                            <?php  } ?>             
                    </div>
                <?php }?>
                <div class="form-group">
                    <label><strong>Category</strong></label>
                    <select class="form-control" name="category">
                            <option>Select</option>
                            <?php 
                                $query=mysqli_query($con,"SELECT * FROM `category`");
                                while($row=mysqli_fetch_array($query)){ ?>
                            <option value="<?php echo $row['category_name']; ?>">
                                <?php  echo $row['category_name'];   ?>
                            </option> 
                        <?php    } ?>   
                        </select> 
                    <!-- <select class="form-control" name="category">
                        <option>Select</option>
                        <?php
                        if($category!=''){?>
                            <option><?php echo $category ?></option>
                        <?php
                        } else{
                                $query=mysqli_query($con,"SELECT * FROM `category`");
                                while($row=mysqli_fetch_array($query)){ ?>
                        <option value="<?php echo $row['category_name']; ?>">
                            <?php  echo $row['category_name'];   ?>
                        </option> 
                        <?php    }  }  ?>                                    
                    </select> -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Author</strong></label>
                            <input class="form-control" type="text" name="author" value="<?php echo $author?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <label><strong>Blog Image</strong></label>
                      <div class="custom-file">
                        <?php if($image!=''){?>
                          <input type="file" name="image" class="custom-file-input" id="customFile" <?php echo  $image_required?> onchange="loadfile1(event)" >
                          <label class="custom-file-label" for="customFile">Choose file</label>
                          <img src="./dist/img/article/<?php echo $image; ?>" id="image" style="margin-top:30px; width:300px; height:100px;">
                            <!-- //* image preview js / -->
                            <script type="text/javascript">
                                       function loadfile1(event){
                                       var output=document.getElementById('image');
                                       output.src=URL.createObjectURL(event.target.files[0]);
                                       };
                                 </script>
                            <?php    }
                            else{?>   <input class="custom-file-input" id="customFile" type="file" name="image">
                                      <label class="custom-file-label" for="customFile">Choose file</label>
                                    <img src="./dist/img/article/kaspersky.gif" id="image" style="border:3px dotted red;margin-top:30px; width:300px; height:100px;">
                                 <?php         } ?>
                      </div>
                    </div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="submit">Save&nbsp;</button></div>
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