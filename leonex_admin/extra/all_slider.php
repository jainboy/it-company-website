<?php
include './dashboard_header.php';
include './dashboard_sidebar.php';
include './function.php';
include '../dbconnection/db.php';
 
 if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($conn,$_GET['operation']);
		$id=get_safe_value($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update slider set status='$status' where id='$id'";
		mysqli_query($conn,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from slider where id='$id'";
		mysqli_query($conn,$delete_sql);
	}
 }
 
 $sql="SELECT * FROM `slider` ORDER BY 'name' ASC";
$res=mysqli_query($conn,$sql);
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./manage_slider.php">Add New</a></button>
   
 <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card"> 
                        <div class="card-body">
                           <h4 class="box-title">Slider </h4>
                        </div>                  
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>#</th>                                   
                                       <th>Name</th>
                                       <th>Thumbnail</th>
                                       <th>status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>          
								<tbody>
									 <?php 
										$i=1;
										while($row=@mysqli_fetch_assoc($res)){?>
                                 <tr>
                                       <td>  <?php echo $i++;?>  </td>
                                       <td><?php   echo $row['name'];    ?> </td>
                                       <td> <img src="./slider_images/<?php echo $row['image'];  ?>"  style="max-width:100px;"  ></td>           				   		 
                                       <td>		 
											<?php
												if($row['status']==1){
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'><i class='fa fa-eye'></i></a></span>&nbsp;";
												}else{
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'><i class='fa fa-eye-slash'></i></a></span>&nbsp;";
												} ?>
										</td>
									   <td>
									  <?php echo "<span class='badge badge-edit'><a href='manage_slider.php?id=".$row['id']."'><i class='fa fa-edit'></i></a></span>&nbsp;"; ?>
									   <?php echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'><i class='fa fa-trash-o'></i></a></span>"; ?>              
                                       </td>       
                                    </tr>
                                    <?php } ?>                                   
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
  
  
<?php 
    include('./dashboard_footer.php');
?>