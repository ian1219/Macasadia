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

  <!-- Plugins -->
  <link href="../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="../assets/plugins/datatable/css/searchHighlight.css" rel="stylesheet" />
 
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
					<li>
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
					<li class="mm-active">
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
        <h6 class="mb-0 text-uppercase">Records
        </h6>
          <hr/>
        

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<!-- <table id="example" class="table table-striped table-bordered" style="width:100%">
							</table> -->
							<table id="floodalert" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Level of Flood</th>
										<th>Time</th>
										<th>Date</th>
										<th>Barangay</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
       </main>

       <!--end page main-->


       <!-- Modal -->
       <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" >
            <div class="modal-content modal-content-bg">
                <div class="modal-body" >
                    <div class="d-flex aligns-items-center justify-content-center">
                        <img src="../assets/img/macabebe.png" alt="Macabebe" class="macabebe_img">
                    </div>
                    <div class="text-center mt-2">
                        <h4 class="title">Fill Up Your Information</h4>
                    </div>


                    
                    <div id="message-box" style="display: none">
                        <div class="d-flex flex-column" >
                            <div id="alert-type" class="alert p-1">
                                <strong class="d-flex justify-content-center">
                                    <div id="message"></div>
                                </strong>
                            </div>
                        </div> 
					</div> 


                    <div class="d-flex flex-column">
                        <label class="p-0" for="fname">First Name</label>
                        <input class="p-1" type="text" id="fname" name="fname" placeholder="First Name">
                    </div>
                    <div class="d-flex flex-column">
                        <label class="p-0" for="mname">Middle Name</label>
                        <input class="p-1" type="text" id="mname" name="mname" placeholder="Middle Name">
                    </div>
                    <div class="d-flex flex-column">
                        <label class="p-0" for="lname">Last Name</label>
                        <input class="p-1" type="text" id="lname" name="lname" placeholder="Last Name">
                    </div>
                    <div class="d-flex flex-column">
                        <label class="p-0" for="address">Address</label>
                        <input class="p-1" type="text" id="address" name="address" placeholder="Address">
                    </div>
                    <div class="d-flex flex-column">
                        <label class="p-0" for="number">Contact Number</label>
                        <input class="p-1" type="text" id="number" name="number" placeholder="Contact Number">
                    </div>
                    <div class="d-flex flex-column">
                        <label class="p-0" for="barangay">Barangay</label>
                        <select class="p-1" id="barangay" name="barangay">
                            <option value="sangabriel">San Gabriel</option>
                            <option value="sanisidro">San Isidro</option>
                            <option value="sanjose">San Jose</option>
                            <option value="batasan">Batasan</option>
                            <option value="concuelo">Concuelo</option>
                            <option value="sanvicente">San Vicente</option>
                            <option value="starita">Sta Rita</option>
                            <option value="sanfrancisco">San Francisco</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer  border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="register_residents();">Submit</button>
                </div>
            </div>
            </div>
        </div>
  </div>
  <!--end wrapper-->

  <!-- Bootstrap bundle JS -->
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="../assets/plugins/datatable/js/sorting/time.js"></script>
  <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="../assets/plugins/datatable/js/searchHighlight.min.js"></script>
  <script src="../assets/plugins/datatable/js/jquery.highlight.js"></script>
  
  <!--app-->
  <script src="../assets/js/app.js"></script>
  <script src="../assets/fetch/records.js"></script>

</body>

</html>