<?php

switch(url::get(1)){
	case "departments":
	case "":
		Page::Load("settings/departments");
	break;
	
	case "sob":
		Page::Load("settings/sob");
	break;
	
	default:
		Page::Load("404");
	break;
}