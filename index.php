<?php
require './functions/includes.php';

if(isset($_POST['register'])){

  $fname = $_POST["fname"];
  $mname = $_POST["mname"];
  $lname = $_POST["lname"];
  $address = $_POST["address"];
  $barangay = $_POST["barangay"];
  $number = $_POST["number"];
  
  if(empty($fname) || empty($mname) || empty($lname) || empty($address) || empty($barangay) || empty($number)){
    echo '<script>alert("Fill Up All Information")</script>';
  }

  if($barangay === 'njf3894'){
    echo '<script>alert("Please Add Barangay First!")</script>';
  }
  
  $register_residents = api\residents\add(get_connection(),$fname,$mname,$lname,$address,$number, $barangay);
  if($register_residents !== responses::success){
    echo '<script>alert("'.$register_residents.'")</script>';
  }else{
    echo '<script>alert("Registered Successfully")</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Water Level Notifier</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="icon" href="./assets/img/icon.png" type="image/png" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style2.css" rel="stylesheet">
  <link href="assets/css/modal.css" rel="stylesheet">

</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <h2 >Water Level Notifier Registration Page</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row ">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="assets/img/macabebe-1.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="assets/img/macabebe-2.png" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="assets/img/macabebe-3.png" alt="">
                </div>

              </div>
              <div class="col d-flex justify-content-center text-center">
                <div class="swiper-pagination"></div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Social Media Links</h3>
              <ul>
                <li><strong>Facebook Page</strong></li>
                <li><strong>Macabebe Pampanga</strong>: <a href="https://www.facebook.com/groups/Macabebe.Pampanga"> www.macabebe.com</a> </li>
                <li><strong>Mdrrmo Macabebe</strong>: <a href="https://www.facebook.com/profile.php?id=100010415657382"> www.MDRRMO.com</a></li>
                <li><strong>LGU Macabebe</strong>: <a href="https://www.facebook.com/LGUMACABEBEOFFICIAL"> www.LGU.com</a></li>
                <li><strong>Pnp Macabebe</strong>: <a href="https://www.facebook.com/pages/Macabebe%20Police%20Station/399972433686167/"> www.pnp.com</a></li>
                <li><strong>BFP Macabebe</strong>: <a href="https://www.facebook.com/macabebefirestation"> www.bfp.com</a></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Water Level Registration Form</h2>
              <p>
                Welcome to the registration form for our water level system. 
                This is the landing page where you enter your personal information 
                so that we can notify you, as a resident of Macabebe Pampanga, 
                of the water level by sending the water level via SMS text on your mobile number
                 to keep you updated on the calamities and the water level. 
                 The mdrrmo macabebe is the administrator of this system
                  for monitoring the water level of the macabebe's flood-prone barangays. 
                  So, if you live in the municipality of Macabebe, simply fill out the registration form below.
              </p>
              <div class="col text-center">
                <button type="button" id="openmodel"  class="registerbtn"> Registration form</button>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <span id="closemodal" class="close">&times;</span>
            <h2 class="modal-title text-center w-100"> Registration From for Macabebe Residents</h2> 
        
        </div>
        <div class="container">
      
          <div class="text-center">
            <form method="POST">
              <label for="fname"><b>First Name</b></label>
              <div class="col d-flex justify-content-center">
                <input type="text" placeholder="Enter First Name" name="fname" id="fname" style = "text-align: center;" required>
              </div>

              <label for="mname"><b>Middle Name</b></label>
              <div class="col d-flex justify-content-center">
              <input type="text" placeholder="Enter Middle Name" name="mname" id="mname" style = "text-align: center;" required>
              </div>


              <label for="lname"><b>Last Name</b></label>
              <div class="col d-flex justify-content-center">
              <input type="text" placeholder="Enter last Name" name="lname" id="lname" style = "text-align: center;" required>
              </div>
              
              <label for="address"><b>Address</b></label>
              <div class="col d-flex justify-content-center">
              <input type="text" placeholder="Enter Address" name="address" id="address" style = "text-align: center;" required>
              </div>

              <label for="cnumber"><b>Contact Number</b></label>
              <div class="col d-flex justify-content-center">
              <input type="text" placeholder="Enter Contact Number" name="number" id="number" style = "text-align: center;" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
              </div>


              <label for="barangay">Barangay</label>
              <div class="col d-flex justify-content-center">
                      <select id="barangay" name="barangay">
                        <?php 
                        $fetch_brgy_list = api\fetch\fetch_all_barangay(get_connection());
                        
                        if(is_array($fetch_brgy_list))
                        {
                          if(count($fetch_brgy_list) > 1)
                          {
                            foreach($fetch_brgy_list as $brgy)
                            {
                              if($brgy['c_number'] !== 0 )
                              {
                            ?>
                          <option value="<?php echo $brgy['c_name'];?>"><?php echo $brgy['c_name'];?></option>
                          <?php
                              }
                            }
                          }else{
                            echo '<option value="njf3894">No Barangay</option>';
                          }
                        }
                      ?>
                      </select>
      
              </div>
                <hr>

            <input type="submit" id="register" name="register" class="registerbtn" value="Register"></input>
            </form>
          </div>
        </div>


      </div>
  
    </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
   

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/day-multipurpose-html-template-for-free/ -->
        Designed by IT-50 , 4J</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  
  <script src="./assets/js/jquery.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="./assets/vendor/aos/aos.js"></script>
  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="./assets/js/main.js"></script>

   
  <script>

    /*Prevent Refresh Resubmision*/
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


    $("#openmodel").click(function(){
        $("#myModal").show();
    });

    $("#closemodal").click(function(){
        $("#myModal").hide();
    });

    $("#register").click(function(){
      var fname = $("#fname").val();
      var mname = $("#mname").val();
      var lname = $("#lname").val();
      var address = $("#address").val();
      var barangay = $("#barangay").val();
      var number = $("#number").val();
      
      if(barangay === 'njf3894'){
        alert("Please Add Barangay First!");
        return;
      }
      if(isEmpty(fname) || isEmpty(lname) || isEmpty(address) || isEmpty(barangay) || isEmpty(number)){
        alert("Fill Up All Information");
        return;
      }
    });
   
    </script>

</body>

</html>