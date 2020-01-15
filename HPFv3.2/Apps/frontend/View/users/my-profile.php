<?php
	new Controller ($_POST);
	
	$user = users::getBy(["user_id" => $_SESSION['user_id']]);
	
	if(count($user) > 0){
		$user = $user[0];
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
				<div class="card lena-card no-border">
					<div class="card-header">
						My Profile
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-4">
									Full Name:
									<input type="text" class="form-control" placeholder="Full name" name="u_name" value="<?= $user->user_name ?>" required/><br />
									Phone:
									<input type="text" class="form-control" placeholder="Phone" name="u_phone" value="<?= $user->user_phone ?>" required/><br />
									Email:
									<input type="text" class="form-control" placeholder="Email" name="u_email" value="<?= $user->user_email ?>" required/>
								</div>
								<div class="col-md-4">
									Image:<br />
									
									<?php
										if(!empty($user->user_picture)){
											?>
												<img src="<?= PORTAL ?>assets/medias/users/<?= $user->user_picture ?>" class="img img-responsive" width="50%" /><br />
											<?php
										}else{
											
										}
									?>
									<input type="file" accept="image/*" multiple name="file" class=""/>
								</div>
							</div><br />
							<hr />
							<div class="row">
								<div class="col-md-4">
									Username:
									<input type="text" class="form-control" placeholder="Username" name="u_login" value="<?= $user->user_login ?>" required/><br />
								</div>
								<div class="col-md-4">
									Password:
									<input type="password" class="form-control" placeholder="Password" name="u_password"/>
								</div>
							</div><br />
							<div class="row">
								<div class="col-md-8">
									<?php 
										Controller::Form(
						                    "users/my_profile", 
						                    [
						                        "action"  => "update"  
						                    ]
						                ); 
					                ?>
									<button class="btn btn-success btn-block btn-sm">
										<span class="icon-save"></span> Save
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}else{
		Page::Load("404");
	}
?>