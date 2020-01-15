<?php
$user = users::getBy(["user_id" => $_SESSION["user_id"]])[0];
?>
<li class="dropdown">
	<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
		<span class="avatar">MH <!--<span class="status online"></span>--></span>
		<span class="user-name"><?= $user->user_name?></span>
		<i class="icon-chevron-small-down"></i>
	</a>
	<div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
		<ul class="user-settings-list">
			<li>
				<a href="<?= PORTAL ?>users/my-profile">
					<span class="icon icon-face"></span>
					<span class="text-name">My Profile</span>
					<!--<span class="badge badge-secondary">7</span>-->
				</a>
			</li>
			<hr />
			<li>
				<div class="actions">
					<a href="<?= PORTAL ?>logout" class="btn btn-primary">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</li>