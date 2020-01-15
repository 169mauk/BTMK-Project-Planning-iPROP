<?php
$user = users::getBy(["user_id" => $_SESSION["user_id"]])[0];

$main_menus = [
	[
		"name"		=> "Dashboard",
		"url"		=> "dashboard",
		"icon"		=> "icon-th-small-outline",
		"desc"		=> "Welcome to " . APP_NAME
	],
	[
		"name"		=> "Projects",
		"url"		=> "projects",
		"icon"		=> "icon-info-outline",
		"desc"		=> "Manage all available complaints",
		"children"	=> [
			[
				"name"		=> "All Projects",
				"url"		=> "all"
			],
			[
				"name"		=> "Categories",
				"url"		=> "categories"
			],
			// [
				// "name"		=> "Sources",
				// "url"		=> "sources"
			// ],
			[
				"name"		=> "Tags",
				"url"		=> "tags"
			],
			[
				"name"		=> "Boards",
				"url"		=> "boards"
			],
			[
				"name"		=> "Under Tasks",
				"url"		=> "under-tasks"
			]
		]
	],
	[
		"name"		=> "Tasks",
		"url"		=> "tasks",
		"icon"		=> "icon-alarm",
		"desc"		=> "Manage list of tasks for projects progress",
		"children"	=> [
			[
				"name"		=> "All Tasks",
				"url"		=> "all"
			],
			[
				"name"		=> "Categories",
				"url"		=> "categories"
			],
			[
				"name"		=> "Tags",
				"url"		=> "tags"
			]
		]
	],
	[
		"name"		=> "Companies",
		"url"		=> "companies",
		"icon"		=> "icon-office",
		"desc"		=> "Manage all companies data",
		"children"	=> [
			[
				"name"		=> "All Companies",
				"url"		=> "all"
			],
			[
				"name"		=> "Clients",
				"url"		=> "clients"
			],
			[
				"name"		=> "Categories",
				"url"		=> "categories"
			]
		]
	],
	[
		"name"		=> "Reports",
		"url"		=> "reports",
		"icon"		=> "icon-file-text",
		"desc"		=> "Reports generator",
		"children"	=> [
			[
				"name"		=> "All Reports",
				"url"		=> "all"
			],
			// [
				// "name"		=> "Report Categories",
				// "url"		=> "categories"
			// ],
		]

	],
	[
		"name"		=> "EOT",
		"url"		=> "eot",
		"icon"		=> "icon-clock",
		"desc"		=> "Extension of Time"
	],
	[
		"name"		=> "VO",
		"url"		=> "vo",
		"icon"		=> "icon-calculator",
		"desc"		=> "Variation Order"
	],
	[
		"name"		=> "Settings",
		"url"		=> "settings",
		"icon"		=> "icon-cogs",
		"desc"		=> "Manage Departments & Source of Budget",
		"children"	=> [
			[
				"name"		=> "Departments",
				"url"		=> "departments"
			],
			[
				"name"		=> "Source of Budget",
				"url"		=> "sob"
			],
		]

	],
	[
		"name"		=> "User Boards",
		"url"		=> "user-boards",
		"icon"		=> "icon-users",
		"desc"		=> "User Boards"
	],
	[
		"name"		=> "Users",
		"url"		=> "users",
		"icon"		=> "icon-group-outline",
		"desc"		=> "Manages users",
		"children"	=> [
			[
				"name"		=> "My Profile",
				"url"		=> "my-profile"
			],
			[
				"name"		=> "All Users",
				"url"		=> "all-users"
			],
			[
				"name"		=> "Roles",
				"url"		=> "roles"
			]
		]
	],
	[
		"name"		=> "Statistics",
		"url"		=> "statistics",
		"icon"		=> "icon-chart-line-outline",
		"desc"		=> "Statistics",
		"children"	=> [
			[
				"name"		=> "Statistical Summary",
				"url"		=> "all"
			],
			[
				"name"		=> "Payments",
				"url"		=> "payments"
			],
			[
				"name"		=> "Sources",
				"url"		=> "sources"
			],
			// [
				// "name"		=> "Financial",
				// "url"		=> "financial"
			// ],
			[
				"name"		=> "Projects",
				"url"		=> "projects"
			],
			[
				"name"		=> "Companies",
				"url"		=> "companies"
			]
		]
	]
];
?>
<!--
<div id="loading-wrapper">
	<div id="loader">
		<div class="line1"></div>
		<div class="line2"></div>
		<div class="line3"></div>
		<div class="line4"></div>
		<div class="line5"></div>
		<div class="line6"></div>
	</div>
</div>
-->

<div class="app-wrap">
	<?php /* ?>
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
	<?php */ ?>
	
	<div class="app-container" style="margin-top: 0px; top: 0;">
		<?php /* ?>
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
						$menu = [
							"name"		=> "404",
							"icon"		=> "icon-cancel-outline",
							"desc"		=> "Oops! The page you are seeking for is not available"
						];
						
						$m = url::get(0);
						
						if($m == "index"){
							$m = $main_menus[0]["url"];
							$menu = $main_menus[0];
						}
						
						$i = 0;
						foreach($main_menus as $main){
							if($m == $main["url"]){
								$mactive = "selected";
								$menu = $main;
							}else{
								$mactive = "";
							}
							
							if(isset($main["children"])){
						?>
							<li class="<?= $mactive ?>">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="<?= $main["icon"] ?>"></i>
									</span>
									<span class="nav-title"><?= $main["name"] ?></span>
									<!--<span class="lbl">2</span>-->
								</a>
								<ul aria-expanded="false" class="collapse <?= $mactive ? "in" : "" ?>">
								<?php
									if(empty(url::get(1))){
										if($i == 0){
											$c = $main["children"][0]["url"];
										}else{
											$c = url::get(1);
										}
									}else{
										$c = url::get(1);
									}
															
									foreach($main["children"] as $child){
										if($c == $child["url"] && url::get(0) == $main["url"]){
											$cactive = "current-page";
										}else{
											$cactive = "";
										}
								?>
										<li>
											<a href='<?= PORTAL ?><?= $main["url"] ?>/<?= $child["url"] ?>' class="<?= $cactive ?>">
												<?= $child["name"] ?>
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
								<a href="<?=  PORTAL ?><?= $main["url"] ?>">
									<span class="has-icon">
										<i class="<?= $main["icon"] ?>"></i>
									</span>
									<span class="nav-title"><?= $main["name"] ?></span>
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
		<?php */ ?>
		
		<div class="app-main">
		<?php
			//Page::Load("widgets/page_header", ["menu" => $menu]);
		?>
			<div class="main-content">