<?php
//A journey start with a step
header("Content-Type: application/json");

die(json_encode([
	"status"	=> "success",
	"code"		=> "API_CONNECTED",
	"message"	=> "Succeed",
	"data"		=> [
		"username"	=> "hery",
		"password"	=> "1234"
	]
]));