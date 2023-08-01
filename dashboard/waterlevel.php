<?php

require '../functions/includes.php';
require '../session.php';

session::check();
$username = session::username();
$role = "Administrator";
?>

<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../assets/img/icon.png" type="image/png" />

  <!-- Bootstrap CSS -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">

  <!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>

  <!--Theme Styles-->
  <link href="../assets/css/semi-dark.css" rel="stylesheet" />

  <title>Water Level System</title>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
      <header class="top-header">        
        <nav class="navbar navbar-expand gap-3 align-items-center">
          <div class="mobile-toggle-icon fs-3">
              <i class="bi bi-list"></i>
          </div>
          <form class="searchbar">
            <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
            <input class="form-control" type="text" placeholder="Type here to search">
            <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i></div>
          </form>
          <div class="top-navbar-right ms-auto">
            <ul class="navbar-nav align-items-center">
              <li class="nav-item search-toggle-icon">
                <a class="nav-link" href="#">
                  <div class="">
                    <i class="bi bi-search"></i>
                  </div>
                </a>
              </li>
              <div class="header-message-list p-2" style="display: none"></div>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
									<div class="notifications"> <div id = "notification_count" ></div> <i class="bi bi-bell-fill"></i> </div>
								</a>
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="p-2 border-bottom m-2">
										<h5 class="h5 mb-0">Notifications</h5> </div>
									<div  id="push_notifications" class="header-notifications-list p-2">
									
									</div>
									<div class="p-2">
										<div>
											<hr class="dropdown-divider"> </div>
										<a class="dropdown-item" href="#">
											<div class="text-center">View All Notifications</div>
										</a>
									</div>
								</div>
							</li>
              <li class="nav-item dropdown dropdown-user-setting">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center">
                    <img src="../assets/img/mdrrmo.jpg" class="user-img" alt="">
                  </div>
                </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <img src="../assets/img/mdrrmo.jpg" alt="" class="rounded-circle" width="54" height="54">
                            <div class="ms-3">
                              <h6 class="mb-0 dropdown-user-name"><?php echo ucfirst($username);?></h6> 
                              <small class="mb-0 dropdown-user-designation text-secondary"><?php echo $role;?></small> 
                            </div>
                        </div>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="../profile">
                            <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-person-fill"></i></div>
                            <div class="ms-3"><span>Profile</span></div>
                            </div>
                        </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                        <a class="dropdown-item" href="logout.php">
                            <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-lock-fill"></i></div>
                            <div class="ms-3"><span>Logout</span></div>
                            </div>
                        </a>
                        </li>
                    </ul>
                </li>
                </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
            <div>
              <i class="bi bi-cloud-fill"></i>
            </div>
            <div>
              <h4 class="logo-text">Main System</h4>
            </div>
            <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
            </div>
          </div>
          <!--navigation-->
				<ul class="metismenu" id="menu">
					<li>
						<a href="index.php">
							<div class="parent-icon"><i class="bi bi-house-fill"></i> </div>
							<div class="menu-title">Dashboard</div>
						</a>
					</li>
					<li  class="mm-active">
						<a href="waterlevel.php">
							<div class="parent-icon"><i class="bi bi-moisture"></i></div>
							<div class="menu-title">Water Level</div>
						</a>
					</li>
					<li>
						<a href="barangay.php">
							<div class="parent-icon"><i class="bi bi-house-fill"></i> </div>
							<div class="menu-title">Barangay</div>
						</a>
					</li>
					<li>
						<a href="residents.php">
							<div class="parent-icon"><i class="bi bi-people-fill"></i></div>
							<div class="menu-title">Residents</div>
						</a>
					</li>
          <li>
						<a href="settings.php">
							<div class="parent-icon"><i class="bi bi-chat-dots-fill"></i></div>
							<div class="menu-title">SMS Settings</div>
						</a>
					</li>
					<li >
						<a href="records.php">
							<div class="parent-icon"><i class="bi bi-hourglass-split"></i></div>
							<div class="menu-title">Records</div>
						</a>
					</li>
				</ul>
				<!--end navigation-->
       </aside>
       <!--end sidebar -->

       <main class="page-content">
       <h6 class="mb-0 text-uppercase">Water Level
        </h6>
          <hr/>
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
                   <div class="card w-100 rounded-4">
                     <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Water Level</h6>
                       
                       </div>
                      
                        <div id="chart1"></div>
                     </div>
                   </div>
                </div>
       </main>

       <!--end page main-->
  </div>
  <!--end wrapper-->

  <!-- Bootstrap bundle JS -->
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/plugins/chartjs/js/Chart.min.js"></script>
  <script src="../assets/plugins/chartjs/js/Chart.extension.js"></script>
  <script src="../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
  <!--app-->
  <script src="../assets/js/app.js"></script>
  <script src="../assets/fetch/waterlevel.js"></script>
	
</body>

</html>