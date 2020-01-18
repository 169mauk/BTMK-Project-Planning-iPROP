//
// ===============================================================================
//
API_KEY = "HJ12O1311VKAOD8VDVKO98F2KB2P834LK2349O8";
//PORTAL = "http://192.168.56.1/BTMK-Project-Planning-iPROP/html/eis_hybrid/" + API_KEY + "/";
PORTAL = "http://210.19.105.177/eis_hybrid/" + API_KEY + "/";

$(function () {
	//$("#datepicker").datepicker();
});

var Menus = [
	{
		"name": "Home",
		"route": "index.html",
		"icon": "icon-laptop_windows"
	},
	{
		"name": "SOB",
		"route": "sob.html",
		"icon": "icon-laptop_windows"
	},
	{
		"name": "Departments",
		"route": "department.html",
		"icon": "icon-laptop_windows"
	},
	{
		"name": "Status",
		"route": "status.html",
		"icon": "icon-laptop_windows"
	},
	{
		"name": "Logout",
		"route": "logout.html",
		"icon": "icon-switch"
	}
];

var Session = {
	password: "",
	username: "",
	started: false
};

var Menu = {
	load: function (main = "") {
		this.clear(main);
		count = 0;
		Menus.forEach(function (menu) {
			if (count == 0) {
				main = "main";
			} else {
				main = "none" + count;
			}

			$("#bluemoonMenu").append(`
				<li id="`+ main + `">
					<a href="#`+ menu.route + `" data-route="` + menu.route + `" class="navigate">
						<span class="has-icon">
							<i class="`+ menu.icon + `"></i>
						</span>
						<span class="nav-title">` + menu.name + `</span>
					</a>
				</li>
			`);

			count += 1;
		});
	},
	clear: function (main = "") {
		if (main == "") {
			$("#bluemoonMenu").html("");
		} else {
			$("#bluemoonMenu").html("");
		}
	}
};


$(document).on("click", ".navigate", function () {
	$("#loading-wrapper").show();
	$("#loading-wrapper").fadeOut(2000);
	
	$(".navigate").parent("li").removeClass("selected");
	$(this).parent("li").addClass("selected");
	$(".onoffcanvas-toggler").click();

	$file = $(this).attr("data-route");
	switch ($file) {
		case "logout":
			Menu.load();
			break;

		default:
			$.ajax({
				method: "GET",
				url: PORTAL + $file
			}).done(function (res) {
				$("#content").html(res);
			}).fail(function () {
				$("#content").html("Fail loading file " + PORTAL + $file);
			});
			break;
	}
});

Menu.load();


$file = PORTAL + "index.html";
$.ajax({
	method: "GET",
	url: $file
}).done(function (res) {
	$("#content").html(res);
}).fail(function () {
	$("#content").html("Fail loading file " + $file);
});

$("#main").parent("li").addClass("selected");


function Run(data) {
	try {
		//alert("Sending Data:" + data);
		invokeCSharpAction("readText:test.txt|hahahaha");
	}
	catch (err) {
		alert(err);
	}
}


