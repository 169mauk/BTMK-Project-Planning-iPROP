<?php 
new Controller($_POST);

switch(url::get(1)){
	case "all":
		Page::Load("projects/all");
	break;
	
	case "categories":
		Page::Load("projects/categories");
	break;
	
	case "tags":
		Page::Load("projects/tags");
	break;
	case "boards":
		Page::Load("projects/boards");
	break;
	case "under-tasks":
		Page::Load("projects/under-tasks");
	break;
}
