<?php
ob_start();
   include './dashboard_header.php';
   include './dashboard_sidebar.php';
   include './function.php';
   include '../dbconnection/db.php';
   $name='';
   $image='';
   $alt_text='';
   $msg='';
   $image_required='required';
   if(isset($_GET['id']) && $_GET['id']!=''){
      $image_required='';
      $id=get_safe_value($conn,$_GET['id']);
      $res=mysqli_query($conn,"select * from slider where id='$id'");
      $check=mysqli_num_rows($res);
      if($check>0){
         $row=mysqli_fetch_assoc($res);
         $name=$row['name'];
         $alt_text=$row['alt_text'];   
      }
      else{
        header('location:./all_slider.php');
         die();
      }
   }

   if(isset($_POST['submit'])){
      $name=get_safe_value($conn,$_POST['name']);
      // $image=get_safe_value($conn,$_POST['image']);
      $alt_text=get_safe_value($conn,$_POST['alt_text']);
   	$res=mysqli_query($conn,"select * from slider where name='$name'");
   	$check=mysqli_num_rows($res);
   	if($check>0){
   		if(isset($_GET['id']) && $_GET['id']!=''){
   			$getData=mysqli_fetch_assoc($res);
   			if($id==$getData['id']){
            
   			}else{
   				$msg="slider already exist";
   			}
   		}else{
   			$msg="slider already exist";
   		}
      } 
      // if(@$_FILES['image']['type']!='image/png' && @$_FILES['image']['type']!='image/jpg' && @$_FILES['image']['type']!='image/jpeg'){
      //    $msg="Please select only png,jpg and jpeg image format";
      // }     
   	if($msg==''){
   		if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
               $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
               move_uploaded_file($_FILES['image']['tmp_name'],'./slider_images/'.$image);
   			mysqli_query($conn,"UPDATE `slider` SET `name`='$name',`image`='$image',`alt_text`='$alt_text' WHERE `id`='$id'");
         }
         else{
   			mysqli_query($conn,"UPDATE `slider` SET `name`='$name',`alt_text`='$alt_text' WHERE `id`='$id'");
         }
      }else{
               $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
               move_uploaded_file($_FILES['image']['tmp_name'],'./slider_images/'.$image);
   			mysqli_query($conn,"INSERT INTO `slider`(`name`, `image`, `alt_text`,`status`) VALUES ('$name','$image','$alt_text','1')");
         }
         header('location:all_slider.php');
   		die();
   	}
   }
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./all_slider.php">Back</a></button>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Slider</strong><small> Insert</small></div>
                          <div class="card-body card-block">
                              <form method="post" enctype="multipart/form-data">
                                 <div class="form-group"><label class=" form-control-label">Slider name 
                                 <span style="color:red; font-size:28px;">*</span>
                                 </label><input type="text" name="name" placeholder="Enter your Categories name" class="form-control" value="<?php echo $name?>"></div>

                                 <div class="form-group"><label for="street" class=" form-control-label">Image
                                 <span style="color:red; font-size:28px;">*</span>
                                 </label>  <input type="file" class="form-control-file" id="image" name="image"  <?php echo  $image_required?> onchange="loadfile(event)" ><div>
                                 <span style="color:#3b5998; font-size:14px;">Note:image size will be 1680*700</span><br>
                                 <img class="img-thumbnail" id="preimage">

                                 <!-- //* image preview js / -->
                                 <script type="text/javascript">
                                       function loadfile(event){
                                       var output=document.getElementById('preimage');
                                       output.src=URL.createObjectURL(event.target.files[0]);
                                       };
                                 </script>

                                 <div class="form-group"><label class=" form-control-label">Alt Description
                                 <span style="color:grey; font-size:14px;">(optional)</span>
                                 </label>  <textarea class="form-control"  name="alt_text" rows="4"><?php echo $alt_text?></textarea>    </div>      

                                 

                                 <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                 <span id="payment-button-amount">Submit</span>
                                 </button>
                                 <div class="field_error"><?php echo $msg?></div>
                           </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>  
  </div>
  
 
         
<?php 
    include('./dashboard_footer.php');
?>