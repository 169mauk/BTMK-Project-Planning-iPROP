<?php
//new Controller ($_POST);
$c = new Controller();
$c->Execute("login");
die();
?>
<style>
	.login-banner {
	    background: url("<?= PORTAL ?>assets/img/login_banner.PNG") center center no-repeat;
	        background-size: auto;
	    background-size: cover;
	    height: 100%;
	    position: relative;
	}
</style>
<!-- Mian and Login css -->
<link rel="stylesheet" href="css/main.css" />
<div class="container">
	<div class="login-screen row align-items-center">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<form action="" method="POST">
				<div class="login-container">
					<div class="row no-gutters">
						<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
							<div class="login-box">
								<a href="<?= PORTAL ?>" class="login-logo">
									<!-- <img src="<?= PORTAL ?>assets/img/logo.png" alt="Bluemoon Admin Dashboard" /> -->
									<center><h6>Monitoring System</h6></center>
								</a>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-account_circle"></i></span>
									</div>
									<input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="password"><i class="icon-verified_user"></i></span>
									</div>
									<input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password">
								</div>

								<div class="actions clearfix">
									<a href="forgot-pwd.html">Lost password?</a>
							  	<button type="submit" class="btn btn-primary">Login</button>
							  	<?php
									Controller::form("login", ["action" => "login"]);
								?>
							  </div>
							  <div class="or"></div>
							  <div class="mt-4">
							  	<a href="signup.html" class="additional-link">Don't have an Account? <span>Create Now</span></a>
							  </div>
							</div>
						</div>
						<div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
							<div class="login-banner"></div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<footer class="main-footer no-bdr fixed-btm">
	<div class="container">
		Monitoring System.
	</div>
</footer>