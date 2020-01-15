<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

$list = [
	"frontend"	=> function(){
		return (new App("HIT Project Monitoring", "frontend"))->run();
	},
	"api"		=> function(){
		return (new App("HIT-PM API Gateway", "api"))->run();
	},
	"sql_api"	=> function(){
		return (new App("HIT-PM API Gateway", "sql_api"))->run();
	},
	"webview"	=> function(){
		return (new App("HIT-PM API Gateway", "webview"))->run();
	},
	"eis"	=> function(){
		return (new App("HIT-PM API Gateway", "eis"))->run();
	}
];

App::Execute($list[CODE]);
?>