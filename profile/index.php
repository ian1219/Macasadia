<?php
require '../functions/includes.php';
require '../session.php';

session::check();
$username = session::username();
$firstname = $_SESSION['firstname'] ?? '' ;
$middlename = $_SESSION['middlename'] ?? '' ;
$lastname = $_SESSION['lastname'] ?? '';
$avatar = 'no_image.png';
$role = "Administrator";



?>
<!doctype html>
<html lang="en" class="semi-dark">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="../assets/img/icon.png" type="image/png" />
		<!--plugins-->
		<link rel="stylesheet" href="../assets/css/calendar.css">
		<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
		<!-- Bootstrap CSS -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-extended.css" rel="stylesheet" />
		<link href="../assets/css/style.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
		<!-- loader-->
		<link href="../assets/css/pace.min.css" rel="stylesheet" />
		<script src="../assets/js/pace.min.js"></script>
		<!--Theme Styles-->
		<link href="../assets/css/semi-dark.css" rel="stylesheet" />
		<link href="../assets/css/loader.css" rel="stylesheet" />
		<link href="../assets/plugins/toastr/css/toastr.css" rel="stylesheet" />
		<title>Water Level System</title>

		<style>
			.stage {
				display: flex;
				justify-content: center;
				align-items: center;
				position: relative;
				padding: 2rem 0;
				margin: 0 -5%;
				overflow: hidden;
			}
		</style>
		<style>
			.img-wrap {
			text-align: center;
			display: block; }
			.img-wrap img {
				max-width: 100%; }
				
			.profile-pic {
				color: transparent;
				transition: all 0.3s ease;
				display: flex;
				justify-content: center;
				align-items: center;
				position: relative;
				transition: all 0.3s ease;
			}
			.profile-pic input {
				display: none;
			}
			.profile-pic img {
				position: absolute;
				object-fit: cover;
				width: 165px;
				height: 165px;
				box-shadow: 0 0 10px 0 rgba(255, 255, 255, 0.35);
				border-radius: 100px;
				z-index: 0;
			}
			.profile-pic .-label {
				cursor: pointer;
				height: 165px;
				width: 165px;
			}
			.profile-pic:hover .-label {
				display: flex;
				justify-content: center;
				align-items: center;
				background-color: rgba(0, 0, 0, 0.8);
				z-index: 10000;
				color: #fafafa;
				transition: background-color 0.2s ease-in-out;
				border-radius: 100px;
				margin-bottom: 0;
			}
			.profile-pic span {
				display: inline-flex;
				padding: 0.2em;
				height: 2em;
			}
		</style>
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
													<h6 class="mb-0 dropdown-user-name"><?php echo ucfirst($username);?></h6> <small class="mb-0 dropdown-user-designation text-secondary">Administrator</small> </div>
											</div>
										</a>
									</li>
									<li>
										<hr class="dropdown-divider"> </li>
									<li>
										<a class="dropdown-item" href="../profile">
											<div class="d-flex align-items-center">
												<div class=""><i class="bi bi-person-fill"></i></div>
												<div class="ms-3"><span>Profile</span></div>
											</div>
										</a>
									</li>
									<li>
										<hr class="dropdown-divider"> </li>
									<li>
										<a class="dropdown-item" href="../dashboard/logout.php">
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

					<!--<h6 class="text-white menu-title" style="margin-left: 20px">Admin</h6>-->
					
					<!--<hr class="text-white">-->
					<li class="mm-active">
						<a href="../dashboard/index.php">
							<div class="parent-icon"><i class="bi bi-house-fill"></i> </div>
							<div class="menu-title">Dashboard</div>
						</a>
					</li>
					<li>
						<a href="../dashboard/waterlevel.php">
							<div class="parent-icon"><i class="bi bi-moisture"></i></div>
							<div class="menu-title">Water Level</div>
						</a>
					</li>
					<link>
						<a href="../dashboard/barangay.php">
							<div class="parent-icon"><i class="bi bi-house-fill"></i> </div>
							<div class="menu-title">Barangay</div>
						</a>
					</li>
					<li>
						<a href="../dashboard/residents.php">
							<div class="parent-icon"><i class="bi bi-people-fill"></i></div>
							<div class="menu-title">Residents</div>
						</a>
					</li>
					<li>
						<a href="../dashboard/settings.php">
							<div class="parent-icon"><i class="bi bi-hourglass-split"></i></div>
							<div class="menu-title">SMS Settings</div>
						</a>
					</li>
					<li>
						<a href="../dashboard/records.php">
							<div class="parent-icon"><i class="bi bi-hourglass-split"></i></div>
							<div class="menu-title">Records</div>
						</a>
					</li>
				</ul>
				<!--end navigation-->
			</aside>
			<!--end sidebar -->
			<!--start  page main -->
			<main class="page-content">
				
				<div class="row">
					<div class="col-xl-4 col-md-12 col-xs-12 mb-4">
                        <div class="card border-left-primary shadow py-2">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
								<div class="img-wrap">

            
									<?php 
									if(file_exists("../assets/img/avatars/".$avatar)){
										$avatar_url = "../assets/img/avatars/".$avatar;
										?>

										<img src="<?php echo $avatar_url;?>".$avatar style="border-radius: 50%;" alt="profile">

										<?php
									}else{
									?> 
									<img src="../assets/img/no_image.png" style="border-radius: 50%;" alt="profile">
									<?php
									}
									?>
									</div>
								</div>
									
								<h2 class="d-flex align-items-center justify-content-center mt-2">
										<?php 
										if($firstname !== '' && $lastname !== '')
										{
											echo  ucfirst($firstname) . ' ' . ucfirst($lastname);
										}else{
											echo ucfirst($username);
										}
										?>							
								</h2>
								<h6 class="d-flex align-items-center justify-content-center mt-2">
										@<?php echo $username;?>								
								</h6>
								<h6 class="d-flex align-items-center justify-content-center mt-2">
										<?php echo $role;?>
								</h6>
								<div class="mb-5"></div>
								<div class="list-group">
									<a href="javascript:void(0)" id="overview_btn" class="list-group-item list-group-item-action active">
									<i class="bi bi-house-fill"></i> Overview</a>
									<a href="javascript:void(0)" id="personal_info_btn" class="list-group-item list-group-item-action">
									<i class="bi bi-house-fill"></i> Personal Information</a>
									<a href="javascript:void(0)" id="account_sett_btn"class="list-group-item list-group-item-action">
									<i class="bi bi-house-fill"></i> Account Settings</a>
								</div>
							</div>
							

                        </div>
                    </div>
					
					<div class="col-xl-8 col-md-12 mb-4">
						<div class="card border-left-primary shadow h-100 py-2">
							<div class="card-body">
								<div id="loading" class="container h-100">
									<div class="row h-100 justify-content-center align-items-center">
										<div class="stage">
											<div class="dot-spin">
												
											</div>
										</div>
									</div>
								</div>

								<div id="overview" style="display: none;">
									<h5>USER LOGS</h5>
									<hr>
									<div style="overflow: scroll;height:490px;" >
										<table class="table table-condensed table-striped">
											<thead>
												<tr>
													<th class="autofit">Trans #</th>
													<th class="autofit">Date/Time</th>
													<th>Activities</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$all_logs = api\fetch\fetch_all_logs_by_username(get_connection(),$username);
													if(is_array($all_logs)){
														foreach($all_logs as $log){
															$trans_id = sprintf("%07d", $log['c_id']);
															$date_time = date("F d, Y h:i:s A", strtotime($log['c_timestamp']));
												?>
															<tr>
																<td><?php echo $trans_id;?></td>
																<td><?php echo $date_time;?></td>
																<td><?php echo $log['c_desc'];?></td>					
															</tr>
												<?php
														}
													}
												?>
											</tbody>
										</table>
									</div>
								</div>

								<div id="personal_info" style="display: none;">
									<h3>Personal Information</h3>
									<hr>
									<div class="shadow-none p-3 mb-5 bg-light rounded">
										<form>
											<div class="row">
												<div class="col-sm-12 col-xs-12 col-lg-6 col-md-6 mb-3">
													<div class="form-group"> 
														<label class="control-label"> Username</label>
														<input type="text" placeholder="Username" name="username"  class="form-control bg-light" value="<?php echo $username;?>" readonly>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 col-lg-6 col-md-6 mb-3">
													<div class="form-group">
														<label class="control-label"> Email</label>
														<input type="email" placeholder="Email" name="Email" class="form-control bg-light" value="<?php echo $_SESSION['myemail'] ?? '';?>" readonly>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 col-lg-4 col-md-4 mb-3">
													<div class="form-group">
														<label class="control-label"> First Name</label>
														<input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control not-required" value="<?php echo $firstname;?>" required>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 col-lg-4 col-md-4 mb-3">
													<div class="form-group">
														<label class="control-label"> Middle Name</label>
														<input type="text" name="middlename" id="middlename"  placeholder="Middle Name(Optional)" class="form-control not-required"  value="<?php echo $middlename;?>">
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 col-lg-4 col-md-4 mb-3">
													<div class="form-group">
														<label class="control-label"> Last Name</label>
														<input type="text" name="lastname" id="lastname"  placeholder="Last Name" class="form-control not-required" value="<?php echo $lastname;?>" required>
													</div>
												</div>

												
												<!-- <div class="col-sm-12 col-lg-6 col-md-6 mb-3">
													<div class="form-group">
														<label class="control-label"> Mobile Number</label>
														<input type="text" placeholder="Mobile Number" name="mnumber" class="form-control" value="">
													</div>
												</div> -->
														
											</div>
											
											<div class="d-grid gap-2 mb-3">
												<button type="button" id="savechangesprofile" class="btn btn-primary btn-blocked"> Save Changes </button>
											</div>
										</form>
									</div>

								</div>

								<div id="account_sett" style="display: none;">
									<div class="row justify-content-center align-items-center">
										
										<div class="col justify-content-center align-items-center">
											<h5 class="mt-2">Profile Account</h5>
										</div>
										<div class="col">
											<div class="d-flex flex-column align-items-end">
												<div class="list-group list-group-horizontal">
													<a href="javascript:void(0)" id="change_avatar_btn" class="list-group-item">
														Change Avatar</a>
													<a href="javascript:void(0)" id="change_password_btn" class="list-group-item">
														Change Password</a>
												</div>
											</div>
										</div>
									</div>
									<hr >
									
									<div id="change_avatar" style="display: none;">
										<div class="shadow-none p-3 mb-5 bg-light rounded">
											<form>
												<div class="profile-pic mb-4">
													<label class="-label" for="file">
														<span class="glyphicon glyphicon-camera"></span>
														<span>Change Image</span>
													</label>
													<input id="file" type="file" onchange="loadFile(event)" accept="image/png, image/jpg, image/jpeg"/>
													
													<?php 
													if(file_exists("../assets/img/avatars/".$avatar)){
														$avatar_url = "../assets/img/avatars/".$avatar;
														?>
														<img src="<?php echo $avatar_url;?>" id="output" width="200" />
														<?php
													}else{
													?> 
														<img src="../assets/img/no_image.png" id="output" width="200" />
													<?php
													}
													?>
												
												</div>
												<div class="d-grid gap-2 mb-3">
													<button type="button" id="changeprofile" class="btn btn-primary btn-blocked"> Change Avatar </button>
												</div>
											</form>
										</div>
									</div>
									<div id="change_password" style="display: none;">
										<div class="shadow-none p-3 mb-5 bg-light rounded">
											<form>
												<div class="d-flex flex-column mb-2">
													<label class="p-0" for="oldpassword">Old Password</label>
													<input class="p-1" type="password" id="oldpassword" name="oldpassword" placeholder="Old Password" required> </div>
												<div class="d-flex flex-column mb-2">
													<label class="p-0" for="newpassword">New Password</label>
													<input class="p-1" type="password" id="newpassword" name="newpassword" placeholder="New Password" required> </div>
												<div class="d-flex flex-column mb-2">
													<label class="p-0" for="confirmnewpassword">Confirm Password</label>
													<input class="p-1" type="password" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirm New Password" required> </div>
													<div class="d-grid gap-2 mb-3">
														<button type="button" id="changepasswordbtn" class="btn btn-primary btn-blocked"> Change Password </button>
													</div>
											<form>
										</div>
									</div>
								</div>
							</div>
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
		<script src="../assets/plugins/toastr/js/toastr.js"> </script>
		<!--app-->
		<script src="../assets/js/app.js"></script>

		<script src="../assets/js/profile.js"></script>

		<script>
			var loadFile = function (event) {
				var image = document.getElementById("output");
				image.src = URL.createObjectURL(event.target.files[0]);
			};
			
		</script>
	</body>

</html>