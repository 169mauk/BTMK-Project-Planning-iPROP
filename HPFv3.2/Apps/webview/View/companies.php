<?php

switch(url::get(1)){
	case "all":
	case "":
		Page::Load("companies/all");
	break;
	
	case "clients":
		Page::Load("companies/clients");
	break;
	
	case "categories":
		Page::Load("companies/categories");
	break;
	
	default:
		Page::Load("404");
	break;
}