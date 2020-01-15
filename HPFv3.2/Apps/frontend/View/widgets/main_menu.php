 <?php
$user = users::getBy(["user_id" => $_SESSION["user_id"]])[0];
?>
<div class="app-wrap">
	<header class="app-header" style="position: relative;">
		<div class="container-fluid">
			<div class="row gutters">
				<div class="col-xl-7 col-lg-7 col-md-6 col-sm-7 col-4">
					<a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
						<i class="icon-menu5"></i>
					</a>
					<a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
						<i class="icon-menu5"></i> 
					</a>
					
					<?php
						//Page::Load("widgets/live_feed");
					?>
				</div>
				<div class="col-xl-5 col-lg-5 col-md-6 col-sm-5 col-4">
					<ul class="header-actions">
					<?php
						//Page::Load("widgets/notificattion_bar");
						Page::Load("widgets/profile_menu_bar");
					?>
					</ul>
				</div>
			</div>
		</div>
	</header>
	
	<div class="app-container" style="margin-top: 0px; top: 0;">
		<aside class="app-side" id="app-side">
			<div class="side-content ">
				<a href="<?= PORTAL ?>" class="logo">
					<img src="<?= PORTAL ?>assets/images/systems/logo_kedah.png" alt="<?= APP_NAME ?>" />
				</a>
				
				<?php
					Page::Load("widgets/user_action_bar");
				?>	
				
				<nav class="side-nav">
					<ul class="bluemoonMenu" id="bluemoonMenu">
					<?php 
						if($_SESSION["role"] > 1){
							$main_menus = menus::list(["where" => "m_main = 0 AND m_disabled = 0"]);
						}else{
							$main_menus = menus::list(["where" => "FIND_IN_SET(". $_SESSION["user_position"] .", m_role) > 0 AND m_main = 0 AND m_disabled = 0"]);
						}
						$menu = [
							"name"		=> "404",
							"icon"		=> "icon-cancel-outline",
							"desc"		=> "Oops! The page you are seeking for is not available"
						];
						
						$m = url::get(0);
						
						if($m == "index"){
							$m = $main_menus[0]->m_url;
							$menu = $main_menus[0];
						}
						
						$i = 0;
						foreach($main_menus as $main){
							if($m == $main->m_url){
								$mactive = "selected";
								$menu = $main;
							}else{
								$mactive = "";
							}
							
							if($_SESSION["role"] > 1){
								$childs = menus::list(["where" => "m_main = " . $main->m_id . " AND m_disabled = 0"]);
							}else{
								$childs = menus::list(["where" => "FIND_IN_SET(". $_SESSION["user_position"] .", m_role) > 0 AND m_main = " . $main->m_id . " AND m_disabled = 0"]);
							}
							
							if(count($childs)){
						?>
							<li class="<?= $mactive ?>">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="<?= $main->m_icon ?>"></i>
									</span>
									<span class="nav-title"><?= $main->m_name ?></span>
									<!--<span class="lbl">2</span>-->
								</a>
								<ul aria-expanded="false" class="collapse <?= $mactive ? "in" : "" ?>">
								<?php
									if(empty(url::get(1))){
										if($i == 0){
											$c = $childs[0]->m_url;
										}else{
											$c = url::get(1);
										}
									}else{
										$c = url::get(1);
									}
															
									foreach($childs as $child){
										if($c == $child->m_url && url::get(0) == $main->m_url){
											$cactive = "current-page";
										}else{
											$cactive = "";
										}
								?>
										<li>
											<a href='<?= PORTAL ?><?= $main->m_url ?>/<?= $child->m_url ?>' class="<?= $cactive ?>">
												<?= $child->m_name ?>
											</a>
										</li>
								<?php
									$i++;
									}
								?>
								</ul>
							</li>
						<?php
								$i++;
							}else{
							?>
							<li class="<?= $mactive ?>">
								<a href="<?=  PORTAL ?><?= $main->m_url ?>">
									<span class="has-icon">
										<i class="<?= $main->m_icon ?>"></i>
									</span>
									<span class="nav-title"><?= $main->m_name ?></span>
								</a>
							</li>
							<?php
							}
							
							$i++;
						}
					?>
					</ul>
				</nav>
			</div>
		</aside>
		
		<div class="app-main">
		<?php
			Page::Load("widgets/page_header", ["menu" => $menu]);
		?>
			
			<div class="main-content">