<?php

switch(url::get(1)){
	case "all":
	case "":
		Page::Load("tasks/all");
	break;
	
	case "categories":
		Page::Load("tasks/categories");
	break;
	
	case "tags":
		Page::Load("tasks/tags");
	break;
	
	default:
		Page::Load("404");
	break;
}