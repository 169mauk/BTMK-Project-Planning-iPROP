<?php 
new Controller($_POST);

$m = menus::getBy(["m_url" => url::get(0), "m_disabled" => 0, "m_main" => 0]);

if(count($m)){
	$m = $m[0];
	
	if(url::get(1) == ""){
		$cm = "404";
	}else{
		$cm = url::get(1);
	}

	if(!$_SESSION["admin"]){
		$x = menus::list(["where" => "FIND_IN_SET(". $_SESSION["user_position"] .", m_role) > 0 AND m_disabled = 0 AND m_main = ". $m->m_id ." AND m_url = '" . $cm . "'"]);
	}else{
		$x = menus::list(["where" => "m_disabled = 0 AND m_main = ". $m->m_id ." AND m_url = '" . $cm . "'"]);
	}

	if(count($x)){
		$pagex = $x[0]->m_url;
	}else{
		$pagex = "404";
	}
}else{
	$pagex = "404";
}

switch($pagex){
	case "application":
		Page::Load("projects/application");
	break;
	
	default:
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
	
	case "404":
		$page->title = "Page Not Found - " . APP_NAME;
		$page->setBodyAttribute('class="lena-centered-body text-center"');
		$page->loadPage("404");
		$page->render();
	break;
}
