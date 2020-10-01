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
		$update_status_sql="update product set status='$status' where id='$id'";
		mysqli_query($conn,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from product where id='$id'";
		mysqli_query($conn,$delete_sql);
   }
   
   if($type=='duplicate'){
      $id=get_safe_value($conn,$_GET['id']);
      $duplicate_sql="INSERT INTO `product`(`id`, `pro_cat`, `pro_sub_cat`, `pro_name`, `pro_mrp`, `pro_sell_price`, `pro_qty`, `pro_short`, `pro_des`, `pro_status`, `pro_shipping`, `pro_meta_title`, `pro_meta_desc`, `pro_meta_keyword`, `status`, `duplicate`) SELECT 'max(id)+1', `pro_cat`, `pro_sub_cat`, `pro_name`, `pro_mrp`, `pro_sell_price`, `pro_qty`,`pro_short`, `pro_des`, `pro_status`, `pro_shipping`, `pro_meta_title`, `pro_meta_desc`, `pro_meta_keyword`, `status`,`duplicate`='duplicate+1' from product  WHERE `id`='$id'";
      mysqli_query($conn,$duplicate_sql);
   }
 }
 
$sql="SELECT * FROM `product` ORDER BY 'pro_name' ASC";
$res=mysqli_query($conn,$sql);
?>
<script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_status.php",
	data:'status='+val,
	success: function(data){
		$("#mytable").html(data);
	}
	});
}
</script>	 

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./manage_product.php">Add New</a></button>
   
 <div class="content pb-0">
            <div class="orders">
            <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                       <label>Status</label>
                                          <select class="custom-select" onChange="getstatus(this.value);" style="text-align:center;">
                                             <option value="all">All</option>
                                             <option value="active">Active</option>
                                             <option value="deactive">Deactive</option>
                                             <option value="duplicate">Duplicate</option>
                                          </select>
                                    </div>
                                    <div class="col-md-6 mb-6">                 
                                    </div> 
                                    <div class="col-md-3 mb-3">
                                    <label>Sort By</label>
                                       <select class="custom-select" style="text-align:center;">
                                          <option selected>All</option>
                                          <option value="3">Name</option>
                                          <option value="1">Category</option>
                                          <option value="2">Sub-Category</option>                                         
                                       </select>
                                    </div>
               </div>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card"> 
                        <div class="card-body">
                           <h4 class="box-title">Product </h4>
                        </div>                  
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>#</th>                                   
                                       <th>Name</th>
                                       <th>cateory</th>
                                       <th>Sub-category</th>
                                       <th>price</th>
                                       <th>image</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>          
								<tbody>
									 <?php 
										$i=1;
										while($row=@mysqli_fetch_assoc($res)){?>
                                 <tr>
                                       <td>  <?php echo $i++;?>  </td>
                                       <td><?php   echo $row['pro_name'];    ?> </td>
                                       <td>  <?php   echo $row['pro_cat'];    ?>  </td>
                                       <td><?php   echo $row['pro_sub_cat'];    ?> </td>
                                       <td>  <?php   echo $row['pro_sell_price'];    ?>  </td>
                                       <td> <img src="./product_images/<?php echo $row['pro_image'];  ?>"  style="max-width:60px;"  ></td>        				   		                                  
									   <td>
                             <?php echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'><i class='fa fa-edit'></i></a></span>&nbsp;"; ?>
                             <?php echo "<span class='badge badge-duplicate'><a href='?type=duplicate&id=".$row['id']."'><i class='fa fa-files-o'></i></a></span>"; ?>   
                             <?php echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'><i class='fa fa-trash-o'></i></a></span>"; ?>                                     
											<?php
												if($row['status']==1){
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'><i class='fa fa-eye'></i></a></span>&nbsp;";
												}else{
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'><i class='fa fa-eye-slash'></i></a></span>&nbsp;";
												} ?>
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
               <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
            </div>
		  </div>
<?php 
    include('./dashboard_footer.php');
?>