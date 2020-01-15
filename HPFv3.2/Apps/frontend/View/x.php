<?php
header("Content-Type: text/plain");
echo $_SESSION["user_position"];
die();
if($_SESSION["role"] == 0){
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
					"name"		=> "Applications",
					"url"		=> "application"
				],
				[
					"name"		=> "All Projects",
					"url"		=> "all"
				],
				[
					"name"		=> "Boards",
					"url"		=> "boards"
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
				]
			]
		],
		[
			"name"		=> "Report & Payment",
			"url"		=> "reports",
			"icon"		=> "icon-file-text",
			"desc"		=> "Reports generator",
			"children"	=> [
				[
					"name"		=> "All Reports",
					"url"		=> "all"
				]
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

}else{
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
					"name"		=> "Applications",
					"url"		=> "application"
				],
				[
					"name"		=> "All Projects",
					"url"		=> "all"
				],
				[
					"name"		=> "Boards",
					"url"		=> "boards"
				]
			]
		],
		// [
			// "name"		=> "Tasks",
			// "url"		=> "tasks",
			// "icon"		=> "icon-alarm",
			// "desc"		=> "Manage list of tasks for projects progress",
			// "children"	=> [
				// [
					// "name"		=> "All Tasks",
					// "url"		=> "all"
				// ],
				// [
					// "name"		=> "Categories",
					// "url"		=> "categories"
				// ],
				// [
					// "name"		=> "Tags",
					// "url"		=> "tags"
				// ]
			// ]
		// ],
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
				]
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
				[
					"name"		=> "Sectors",
					"url"		=> "sectors"
				],
				[
					"name"		=> "Project",
					"url"		=> "project-setting"
				],
				[
					"name"		=> "Company",
					"url"		=> "company-setting"
				],
				[
					"name"		=> "Options Setting",
					"url"		=> "options"
				],
				[
					"name"		=> "Menus",
					"url"		=> "menus"
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
				],
				[
					"name"		=> "Positions",
					"url"		=> "positions"
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
}
die();

$np = 0;
foreach($menus as $m){
	if(isset($m["children"])){
		$key = F::UniqKey();
		
		menus::insertInto([
			"m_name"		=> $m["name"],
			"m_url"			=> $m["url"],
			"m_icon"		=> $m["icon"],
			"m_description"	=> $m["desc"],
			"m_order"		=> $np,
			"m_key"			=> $key
		]);
		
		$mx = menus::getBy(["m_key" => $key]);
		
		if(count($mx)){
			$mx = $mx[0];
			$nc = 0;
			foreach($m["children"] as $c){
				
				menus::insertInto([
					"m_name"	=> $c["name"],
					"m_url"		=> $c["url"],
					"m_main"	=> $mx->m_id,
					"m_order"	=> $nc++
				]);
			}
		}
	}else{
		menus::insertInto([
			"m_name"		=> $m["name"],
			"m_url"			=> $m["url"],
			"m_icon"		=> $m["icon"],
			"m_description"	=> $m["desc"],
			"m_order"		=> $np
		]);
	}
	
	$np++;
}






















