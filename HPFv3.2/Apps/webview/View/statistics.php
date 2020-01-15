<?php

switch(url::get(1)){
	case "all":
	case "":
		Page::Load("statistics/all");
	break;
	
	case "companies":
		Page::Load("statistics/companies");
	break;

	case "financial":
		Page::Load("statistics/financial");
	break;

	case "payments":
		Page::Load("statistics/payments");
	break;

	case "projects":
		Page::Load("statistics/projects");
	break;

	case "sources":
		Page::Load("statistics/sources");
	break;
}

?>

