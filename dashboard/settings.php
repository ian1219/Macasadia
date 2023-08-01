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

		<link href="../assets/plugins/toastr/css/toastr.css" rel="stylesheet" />
		<title>Water Level System</title>
	</head>

	<body>
		<!--start wrapper-->
		<div class="wrapper">
			<!--start top header-->
			<header class="top-header">
				<nav class="navbar navbar-expand gap-3 align-items-center">
					<div class="mobile-toggle-icon fs-3"> <i class="bi bi-list"></i> </div>
					<form class="searchbar">
						<div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
						<input class="form-control" type="text" placeholder="Type here to search">
						<div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i></div>
					</form>
					<div class="top-navbar-right ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item search-toggle-icon">
								<a class="nav-link" href="#">
									<div class=""> <i class="bi bi-search"></i> </div>
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
									<div class="user-setting d-flex align-items-center"> <img src="../assets/img/mdrrmo.jpg" class="user-img" alt=""> </div>
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li>
										<a class="dropdown-item" href="#">
											<div class="d-flex align-items-center"> <img src="../assets/img/mdrrmo.jpg" alt="" class="rounded-circle" width="54" height="54">
												<div class="ms-3">
													<h6 class="mb-0 dropdown-user-name"><?php echo ucfirst($username);?></h6> 
													<small class="mb-0 dropdown-user-designation text-secondary"><?php echo $role;?></small> 
												</div>
											</div>
										</a>
									</li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li>
										<a class="dropdown-item" href="../profile">
											<div class="d-flex align-items-center">
												<div class=""><i class="bi bi-person-fill"></i></div>
												<div class="ms-3"><span>Profile</span></div>
											</div>
										</a>
									</li>
									<li>
										<hr class="dropdown-divider">
									</li>
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
					<div> <i class="bi bi-cloud-fill"></i> </div>
					<div>
						<h4 class="logo-text">Main System</h4> </div>
					<div class="toggle-icon ms-auto"> <i class="bi bi-list"></i> </div>
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
                    <li class="mm-active">
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
				<h6 class="mb-0 text-uppercase">SMS Settings
                 </h6>
				<hr/>
               
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card w-100">
							<div class="card-body">
                                <h6 class="mb-3 text-uppercase">Message For Level 1
                                </h6>
                                <?php 
                                $messagevalue = api\settings\fetchmessage(get_connection(),1);
                                $message = $messagevalue['c_message'];
                                ?>

                                <textarea id="messageboxlevel1" name="messageboxlevel1" class="form-control" style="width: 100%;height: 200px;resize: none;" placeholder="What's up?"  required><?php echo $message;?></textarea>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="button" name="savemessagelevel1" id="savemessagelevel1" class="btn btn-primary btn-blocked"> Save</button>
                                </div>
                            </div>
						</div>
					</div>
					<div class="mb-2"></div>
					<div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card w-100">
							<div class="card-body">
                                <h6 class="mb-3 text-uppercase">Message For Level 2
                                </h6>
                                <?php 
                                $messagevalue = api\settings\fetchmessage(get_connection(),2);
                                $message = $messagevalue['c_message'];
                                ?>

                                <textarea id="messageboxlevel2" name="messageboxlevel2" class="form-control" style="width: 100%;height: 200px;resize: none;" placeholder="What's up?"  required><?php echo $message;?></textarea>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="button" name="savemessagelevel2" id="savemessagelevel2" class="btn btn-primary btn-blocked"> Save</button>
                                </div>
                            </div>
						</div>
					</div>

					<div class="mb-2"></div>
					<div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card w-100">
							<div class="card-body">
                                <h6 class="mb-3 text-uppercase">Message For Level 3
                                </h6>
                                <?php 
                                $messagevalue = api\settings\fetchmessage(get_connection(),3);
                                $message = $messagevalue['c_message'];
                                ?>

                                <textarea id="messageboxlevel3" name="messageboxlevel3" class="form-control" style="width: 100%;height: 200px;resize: none;" placeholder="What's up?"  required><?php echo $message;?></textarea>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="button" name="savemessagelevel3" id="savemessagelevel3" class="btn btn-primary btn-blocked"> Save</button>
                                </div>
                            </div>
						</div>
					</div>


					<div class="mb-2"></div>
					



					<!-- <div class="col-12 col-lg-7 col-xl-7 d-flex">
						<div class="card w-100">
							
							</div>
						</div>
					</div> -->
					<!-- <div class="col-12 col-lg-5 col-xl-5 d-flex">
                        <div class="card w-100">
							<div class="card-body">
								
							</div>
						</div>
					</div>
				</div> -->
		
				
			</main>
			<!--end page main-->

		</div>
		<!--end wrapper-->
		<!-- Bootstrap bundle JS -->
		<script src="../assets/js/bootstrap.bundle.min.js"></script>
		<!--plugins-->
		<script src="../assets/js/jquery.min.js"></script>
		<!--app-->
		<script src="../assets/plugins/toastr/js/toastr.js"> </script>
		<script src="../assets/plugins/datatable/js/searchHighlight.min.js"></script>
  		<script src="../assets/plugins/datatable/js/jquery.highlight.js"></script>
		<script src="../assets/js/app.js"></script>
		<script>
            $("#savemessagelevel1").click(function(){
                var messagebox = $("#messageboxlevel1").val();
                var length = messagebox.length;
                if(length > 160){
                    toastr.error('', 'Message must be less than 160 characters');
                    return;
                }

                var xhr = new XMLHttpRequest();	
                xhr.open('POST', '../api/main_handler.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                const obj = JSON.parse(this.responseText);
                    if(obj.response === "success"){
                        toastr.success('', 'Success');
                    }
                };
                xhr.send('type=update_message&level=1&message='+messagebox);
            });

			$("#savemessagelevel2").click(function(){
                var messagebox = $("#messageboxlevel2").val();
                var length = messagebox.length;
                if(length > 160){
                    toastr.error('', 'Message must be less than 160 characters');
                    return;
                }

                var xhr = new XMLHttpRequest();	
                xhr.open('POST', '../api/main_handler.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                const obj = JSON.parse(this.responseText);
                    if(obj.response === "success"){
                        toastr.success('', 'Success');
                    }
                };
                xhr.send('type=update_message&level=2&message='+messagebox);
            });

			$("#savemessagelevel3").click(function(){
                var messagebox = $("#messageboxlevel3").val();
                var length = messagebox.length;
                if(length > 160){
                    toastr.error('', 'Message must be less than 160 characters');
                    return;
                }

                var xhr = new XMLHttpRequest();	
                xhr.open('POST', '../api/main_handler.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                const obj = JSON.parse(this.responseText);
                    if(obj.response === "success"){
                        toastr.success('', 'Success');
                    }
                };
                xhr.send('type=update_message&level=3&message='+messagebox);
            });

			$("#savemessagelevel4").click(function(){
                var messagebox = $("#messageboxlevel4").val();
                var length = messagebox.length;
                if(length > 160){
                    toastr.error('', 'Message must be less than 160 characters');
                    return;
                }

                var xhr = new XMLHttpRequest();	
                xhr.open('POST', '../api/main_handler.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                const obj = JSON.parse(this.responseText);
                    if(obj.response === "success"){
                        toastr.success('', 'Success');
                    }
                };
                xhr.send('type=update_message&level=4&message='+messagebox);
            });

            
        </script>
	</body>

</html>