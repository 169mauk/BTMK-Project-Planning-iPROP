<?php

switch(url::get(1)){
	case "all":
	case "":
		Page::Load("reports/all");
	break;
	
	case "categories":
		Page::Load("reports/categories");
	break;
}

?>

