
<?php

require 'functions/includes.php';

/*Check Session*/
if(isset($_SESSION['panel_access'], $_SESSION["username"]))
    header('Location: ./dashboard/index.php');

	/*confirm_password*/
if(isset($_POST['signup'])) {
	
	if($_POST['password'] !== $_POST['confirm_password']){
		$message = array();
		$message[] = "alert-danger";
		$message[] = "Password not Match";
		
	}else{
		$register_result = admin\main\register(get_connection(), $_POST['username'], $_POST['email'], $_POST['password']);
		$message = array();
		if ($register_result !== responses::success)
		{
			$message[] = "alert-danger";
			$message[] = $register_result;
		}
		else
		{
			$message[] = "alert-success";
			$message[] = "Registerd Successfully...";
			header('refresh:2; ./login.php');
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
		<link rel="icon" href="./assets/img/icon.png" type="image/png" />
		<title>Water Level System</title>
		
		<link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    	<link href="./assets/css/bootstrap-extended.css" rel="stylesheet" />
		<link href="./assets/css/style.css" rel="stylesheet" />
	</head>
	<body>
	<div class="container border border-3 mt-4 mb-4">
		<div class="col-lg-12 ">
			<form method="post">
				
				<div class="d-flex aligns-items-center justify-content-center mt-4">
    				<img src="assets/img/mcbb.png" alt="Macabebe" class="macabebe_img">
  				</div>
				
				<div class="row text-center mt-4 mb-3">
						<h2 >Registration Page</h2>
				</div>

				
				<?php
					if(isset($message))
					{
						?>
						<div class="row justify-content-center">
							<div class="col-md-8">
								<div class="alert <?php echo $message[0]?>">
									<strong class="d-flex justify-content-center"><?php echo $message[1]; ?></strong>
								</div>
							</div>
						</div>
						<?php
						
					}
				?>
			
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="form-group">
							<fieldset class="border border-1 rounded">
								<legend  class="float-none w-auto ml-2" style="font-size:18px">Username</legend>
								<input type="text" name="username" class="form-control" placeholder="Username" />
							</fieldset>
						</div>
					</div>
				</div>

                <div class="row justify-content-center">
					<div class="col-md-8">
						<div class="form-group">
							<fieldset class="border border-1 rounded">
								<legend  class="float-none w-auto ml-2" style="font-size:18px">Email</legend>
								<input type="text" name="email" class="form-control" placeholder="Email" />
							</fieldset>
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="form-group">
							<fieldset class="border border-1 rounded">
								<legend  class="float-none w-auto ml-2" style="font-size:18px">Password</legend>
								<input type="password" name="password" class="form-control" placeholder="Password" />
							</fieldset>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="form-group">
							<fieldset class="border border-1 rounded">
								<legend  class="float-none w-auto ml-2" style="font-size:18px">Confirm Password</legend>
								<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" />
							</fieldset>
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-md-8 d-grid gap-2 mt-3">
						<input type="submit" name="signup" id="signup" class="btn btn-primary btn-block" value="Register">
					</div>
				</div>
				<div class="row justify-content-center text-center">
					<div class="col-md-0">
						<p>You have an Account Already?</p>	
					</div>
				</div>
				<div class="row justify-content-center text-center">
					<div class="col-md-0">
						<a href="index.php"><p class="text-info">Login Here</p></a>
					</div>
				</div>



			</form>
		</div>
	</div>
		
		<!-- Optional JavaScript; choose one of the two! -->

		<!-- Option 1: Bootstrap Bundle with Popper -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
		<script src="./assets/js/jquery.min.js"></script>
		<script src="./assets/js/bootstrap.bundle.min.js"></script>
		<script>
		
		</script>
		
		<!-- Option 2: Separate Popper and Bootstrap JS -->
		<!--
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
		-->
	</body>
</html>