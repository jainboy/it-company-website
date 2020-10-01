<?php
include 'link.php';
include 'navigation.php';
// include './leonex_admin/db/db.php';
if(isset($_POST['submit'])){
  $name=get_safe_value($con,$_POST['name']);
  $email=get_safe_value($con,$_POST['email']);
  $phone=get_safe_value($con,$_POST['phone']);
  $subject=get_safe_value($con,$_POST['subject']);
  $message=get_safe_value($con,$_POST['message']);
  $added_on=date('Y-m-d h:i:s');
  $sql=mysqli_query($con,"INSERT INTO `contact_us`(`name`,`email`,`phone`,`subject`,`comment`,`added_on`) VALUES ('$name','$email','$phone','$subject','$message','$added_on')");
   if($sql==TRUE){     ?>
<!-- Flexbox container for aligning the toasts -->
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">

  <!-- Then put toasts within -->
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="mr-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Your Query Is Ragistered And Our Team Will Solve It As soon as possible.
    </div>
  </div>
</div>
      <!-- <script>     alert 'Massage send Successfully !!';  </script> -->
     <?php } else { ?>
      <script>     alert 'Massage didnot send Successfully !! try again';  </script>
     <?php }
} 
?><br>

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contact</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Contact</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <div class="map-section">
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1743.1000616567458!2d77.26143833603746!3d29.099772632620862!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf894ff20e1ef440a!2sLeonex%20Technology!5e0!3m2!1sen!2sin!4v1599117366686!5m2!1sen!2sin" frameborder="0" allowfullscreen></iframe>
      </div>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="icofont-google-map"></i>
                  <h4>Location:</h4>
                  <p>City Complex<br>Near Municipality<br>Baraut (Baghpat)<br>U.P. 250611 India</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@leonex-technology.com<br>contact@leonex-technology.com</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-phone"></i>
                  <h4>Call:</h4>
                  <p>+91 8899808626<br>+91 8279787990</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
            <form method="post" id="contact-form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-4 form-group">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="" oninvalid="this.setCustomValidity('Please enter at least 4 chars')"  oninput="setCustomValidity('')"/>
                </div>
                <div class="col-md-4 form-group">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="" oninvalid="this.setCustomValidity('Please enter a valid email')"  oninput="setCustomValidity('')"/>
                </div>
                <div class="col-md-4 form-group">
                  <input type="text" class="form-control" name="phone" placeholder="Your Phone" required="" oninvalid="this.setCustomValidity('Please enter a valid phone no')"  oninput="setCustomValidity('')"/>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject"  placeholder="Subject" required="" oninvalid="this.setCustomValidity('Please enter at least 8 chars of subject')"   oninput="setCustomValidity('')"/>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required="" oninvalid="this.setCustomValidity('Please write something for us')"  oninput="setCustomValidity('')"></textarea>
              </div>
              <div class="text-center"><button type="submit" name="submit" >Send Message</button></div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
<?php
include 'footer.php';
?>