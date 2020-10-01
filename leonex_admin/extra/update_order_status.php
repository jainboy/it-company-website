<?php
ob_start();
   include './dashboard_header.php';
   include './dashboard_sidebar.php';
   include './function.php';
   include '../dbconnection/db.php';
  
   $order_id=get_safe_value($conn,$_GET['order_id']);
   $order_date='';
   $order_status='';
   $res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
   $check=mysqli_num_rows($res);
   if($check>0){
     $row=mysqli_fetch_assoc($res);
     $order_date=$row['added_on'];
     $order_status=$row['order_status'];
   }
   if(isset($_POST['submit'])){
      $order_status=get_safe_value($conn,$_POST['order_status']);
       $res=mysqli_query($conn,"UPDATE `customer_order` SET `order_status`='$order_status' WHERE `order_id`='$order_id'");
   }
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./order.php">Back</a></button>
         <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Order Status</strong><small> Update</small></div>
                           <div class="card-body card-block">
                              <section class="content">
                                 <div class="container-fluid">
                                    <div class="row">
                                       <div class="col-12">     
                                          <div class="invoice p-3 mb-3">
                                                <div class="row">
                                                   <div class="col-12">
                                                      <h3>
                                                      <i class="fa fa-globe"></i> <b>TsirtX Clothing</b>
                                                      <small class="float-right">Date: <?php echo date_format(new DateTime($order_date),'d-m-Y'); ?></small>
                                                      </h3>
                                                   </div>
                                                </div><br/><br/>
                                                <div class="row invoice-info">
                                                   <div class="col-sm-4 invoice-col">
                                                      From
                                                      <address>
                                                      <strong>TsirtX Clothing Pvt.Ltd.</strong><br>
                                                      795 Folsom Ave, Suite 600<br>
                                                      San Francisco, CA 94107<br>
                                                      Phone: (804) 123-5432<br>
                                                      Email: info@almasaeedstudio.com
                                                      </address>
                                                   </div>
                                                   <div class="col-sm-4 invoice-col">
                                                      To
                                                      <address>
                                                            <?php $res=mysqli_query($conn,"SELECT  * FROM `customer_order` where `order_id`='$order_id'");
                                                                  $check=mysqli_num_rows($res);
                                                                  if($check>0){
                                                                  $row=mysqli_fetch_assoc($res);
                                                                  $user_id=$row['user_id'];
                                                                  $firstname=$row['firstname'];
                                                                  $lastname=$row['lastname'];
                                                                  $street=$row['street'];
                                                                  $city=$row['city'];
                                                                  $dist=$row['dist'];
                                                                  $zip=$row['zip'];
                                                                  $state=$row['state'];
                                                                  $mobile=$row['mobile'];
                                                                  $email=$row['email'];
                                                            }?>
                                                      <strong><?php echo $firstname.' '.$lastname?></strong><br>
                                                      <?php echo $street?><br>
                                                      <?php echo $city.' ('.$dist.') '?><br>
                                                      <?php echo $state.' '.$zip?><br>
                                                      <b> Phone:</b> <?php echo $mobile?><br>
                                                      <b> Email:</b> <?php echo $email?>
                                                      </address>
                                                   </div>
                                                   <div class="col-sm-4 invoice-col">
                                                      <b>Invoice #007612</b><br>
                                                      <br>
                                                      <b>Order ID:</b> <?php echo $order_id ?><br>
                                                      <b>Order ID:</b> <?php echo date_format(new DateTime($order_date),'d-m-Y'); ?><br>
                                                      <b>Payment Status:</b> &nbsp; <?php echo $order_status?><br>
                                                      <b>Account:</b> 968-34567
                                                   </div>
                                                </div><br/>
                                                <div class="row">
                                                   <div class="col-12 table-responsive">
                                                      <table class="table table-striped">
                                                      <thead>
                                                      <tr>                                                
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Shipping</th>
                                                            <th>Total</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php
                                                            // $uid=$_SESSION['USER_ID'];
                                                            $res1=mysqli_query($conn,"SELECT DISTINCT(`order_details`.`id`) ,`order_details`.*,`product`.`pro_name`,`product`.`pro_sell_price`,`product`.`pro_shipping` FROM `order_details`,`product`,`customer_order` WHERE `order_details`.`order_id`='$order_id' AND `customer_order`.`user_id`='$user_id' AND `order_details`.`product_id`=`product`.`id`");
                                                               $total_price=0;
                                                               $shipping_charges=0;
                                                               $cart_total=0;
                                                                  while($row1=mysqli_fetch_assoc($res1)){
                                                               $total_price=$total_price+($row1['quantity']*$row1['price']);
                                                               $shipping_value=$row1['quantity']*$row1['pro_shipping'];
                                                               $sub_total=($row1['quantity']*$row1['price'])+$shipping_value;                                       
                                                               $shipping_charges=$shipping_charges+($row1['quantity']*$row1['pro_shipping']);
                                                               $cart_total=$cart_total+$sub_total;
                                                               $total_price=$cart_total-$shipping_charges;
                                                                                       ?>
                                                               <tr>
                                                                  <td><a href="product.php?id=<?php echo $row1['id']?>"><?php echo $row1['pro_name']?></a></td>
                                                                  <td><?php echo $row1['quantity']?></td>
                                                                  <td><?php echo $row1['pro_sell_price']?></td>
                                                                  <td><?php echo $row1['quantity'].'*'.$row1['pro_shipping'].'='.$shipping_value?></td>
                                                                  <td><?php echo $sub_total?></td>
                                                               </tr>
                                                      <?php }?>
                                                      </tbody>
                                                      </table>
                                                   </div>
                                                </div><br/>                                                 
                                                <div class="row">
                                                   <div class="col-6">
                                                      
                                                   </div>
                                                   <div class="col-6">
                                                      <p class="lead">Amount Due 2/22/2014</p>
                                    
                                                      <div class="table-responsive">
                                                      <table class="table">
                                                            <tbody><tr>
                                                            <th style="width:50%">Subtotal:</th>
                                                            <td><?php echo $total_price?></td>
                                                            </tr>
                                                            <tr>
                                                            <th>Tax (9.3%)</th>
                                                            <td>$10.34</td>
                                                            </tr>
                                                            <tr>
                                                            <th>Shipping:</th>
                                                            <td><?php echo $shipping_charges ?></td>
                                                            </tr>
                                                            <tr>
                                                            <th>Total:</th>
                                                            <td><?php echo $cart_total ?></td>
                                                            </tr>
                                                            </tbody>
                                                      </table>
                                                      </div>
                                                   </div>
                                                </div><br/>
                                            <form method="post">
                                                <div class="row no-print">
                                                   <div class="col-md-6"> 
                                                   </div>   
                                                   <div class="col-md-3">
                                                      <select class="form-control" name="order_status">
                                                         <!-- <option value="#">Select Category</option> -->
                                                         <option value="pending">Pending</option>
                                                         <option value="ready to ship">Ready To Ship</option>
                                                         <option value="shipped">Shipped</option>
                                                         <option value="in process">In process</option>
                                                         <option value="received">Complete</option>
                                                         <option value="cancelled">Cancelled</option>
                                                         <option value="on hold">On Hold</option>
                                                         </select>      
                                                   </div>                                               
                                                   <div class="col-md-3">
                                                      <button type="submit" name="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                      <i class="fa fa-wrench"></i>  Update Status
                                                   </button> 
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
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