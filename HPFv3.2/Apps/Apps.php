<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

$list = [
	"frontend"	=> function(){
		return (new App("iPROP BTMK", "frontend"))->run();
	},
	"api"		=> function(){
		return (new App("iPROP BTMK API Gateway", "api"))->run();
	},
	"sql_api"	=> function(){
		return (new App("iPROP BTMK API Gateway", "sql_api"))->run();
	},
	"webview"	=> function(){
		return (new App("iPROP BTMK WebView", "webview"))->run();
	},
	"eis"	=> function(){
		return (new App("iPROP BTMK EIS", "eis"))->run();
	},
	"eis_hybrid"	=> function(){
		return (new App("iPROP BTMK EIS Hybrid", "eis_hybrid"))->run();
	}
];

App::Execute($list[CODE]);
?>