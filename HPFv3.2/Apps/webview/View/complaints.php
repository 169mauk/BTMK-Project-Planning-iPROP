<?php

switch(url::get(1)){
	case "all":
	case "":
		Page::Load("complaints/all");
	break;
	
	case "categories":
		Page::Load("complaints/categories");
	break;
	
	case "sources":
		Page::Load("complaints/sources");
	break;
	
	case "tags":
		Page::Load("complaints/tags");
	break;
	
	default:
		Page::Load("404");
	break;
}