<?php

switch(url::get(1)){
	case "my-profile":
		Page::Load("users/my-profile");
	break;
	
	case "all-users":
		Page::Load("users/all-users");
	break;
	
	case "roles":
		Page::Load("users/roles");
	break;
	
	default:
		Page::Load("404");
	break;
}