<?php
//A journey start with a step
header("Access-Control-Allow-Origin: *");

if(url::get(0) == ACCESS_KEY){
	switch(url::get(1)){
		case "index.html":
		case "dashboard.html":
			Page::Load("index");
		break;
		
		case "sob.html":
			Page::Load("sob");
		break;
		
		case "department.html":
			Page::Load("department");
		break;
		
		case "status.html":
			Page::Load("status");
		break;
		
		case "logout.html":
			Page::Load("logout");
		break;
		
		case "login.html":
			Page::Load("login");
		break;
		
		default:
			Page::Load("404");
		break;
	}
}else{
	Page::Load("404");
}