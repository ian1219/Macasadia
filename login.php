
<?php

require 'functions/includes.php';

/*Check Session*/
if(isset($_SESSION['panel_access'], $_SESSION["username"]))
    header('Location: ./dashboard/index.php');

if(isset($_POST['login'])) {
    $login_result = admin\main\login(get_connection(), $_POST['username_email'], $_POST['password']);
	$message = array();

    if($login_result !== responses::success){
		$message[] = "alert-danger";
		$message[] = $login_result;
	}
    else{
		$message[] = "alert-success";
		$message[] = "Successfully Login...";
        header('refresh:2; ./dashboard/index.php');
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
			<form method="post" id="loginForm">
				
				<div class="d-flex aligns-items-center justify-content-center mt-4">
    				<img src="assets/img/mcbb.png" alt="Macabebe" class="macabebe_img">
  				</div>
				
				<div class="row text-center mt-4 mb-3">
						<h2 >Login Page</h2>
				</div>

				
				<?php
				   //Use Ajax much better
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
								<legend  class="float-none w-auto ml-2" style="font-size:18px">Username or Email</legend>
								<input type="text" name="username_email" class="form-control" placeholder="Username or Email" />
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
					<div class="col-md-8 d-grid gap-2 mt-3">
						<input type="submit" name="login" id="login" class="btn btn-success btn-block" value="Login">
					</div>
				</div>
				<div class="row justify-content-center text-center">
					<div class="col-md-0">
						<p>You don't have a account register here?</p>	
					</div>
				</div>
				<div class="row justify-content-center text-center">
					<div class="col-md-0">
						<a href="register.php"><p class="text-info">Register Here</p></a>
					</div>
				</div>



			</form>
		</div>
	</div>
		
		<!-- Optional JavaScript; choose one of the two! -->

		<!-- Option 1: Bootstrap Bundle with Popper -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
		<script src="./assets/js/bootstrap.bundle.min.js"></script>
		<script>
			function formatInput(id) {
				//The tl:dr of this is that each key pressed (so long as it's valid which is to be determined by you) will be added to session storag which you can call from anywhere, allowing you to register stars of the correct length or text of the correct value
				
				const elem = document.getElementById(id);
				const keyPressed = event.key;
				
				//event.key should be equal to 1 unless you want it to register "Backspace" and so on as inputs. The elem.value change in the first conditional is necessary to avoid removing more than 1 character on the input; Wihtout it, we would get something like text.length = x and elem.value.length = x - 1
				
				if (keyPressed == "Backspace") {
					text = text.substring(0, text.length - 1);
					elem.value = elem.value.substring(0, elem.value.length);
					console.log(`Text at Backspace: ${text}`)
					return;
				}
				
				if (keyPressed.length == 1) {
					text = text + keyPressed;
					elem.value = text;
				}
				
				//You could use a conditional here, I just prefer switches in the case that we are checking one simple thing
				
				switch (isVisible) {
					case false:
					elem.value = star.repeat(text.length - 1)
					console.log(`Text When Password = Hidden: ${text}`)
							break;
					case true:
					elem.value = text;
					//This is required as wihtout it there is a bug that duplicated the first entry if someone decides to show the password
					elem.value = elem.value.substring(0, text.length - 1)
					console.log(`Text When Password = Visible: ${text}`)
				}
			}
		</script>
		<!-- Option 2: Separate Popper and Bootstrap JS -->
		<!--
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
		-->
	</body>
</html>