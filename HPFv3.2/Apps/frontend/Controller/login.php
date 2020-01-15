<?php

$bool = false;
$user = users::getBy(["user_login" => Input::post("username")]);

if(count($user) > 0){
    $bool = true;
}

if(!$bool){
    $user = users::getBy(["user_email" => Input::post("username")]);
    
    if(count($user) > 0){
        $bool = true;
    }
}

if($bool){
    $user = $user[0];
    if($user->user_password == F::Encrypt(Input::post("password"))){
		if($user->user_position){
			$_SESSION["user_login"] = $user->user_login;
			$_SESSION["user_id"] = $user->user_id;
			$_SESSION["user_password"] = $user->user_password;
			$_SESSION["department"] = $user->user_department;
			$_SESSION["role"] = $user->user_role;
			$_SESSION["admin"] = $user->user_role > 1 ? true : false;
			$_SESSION["user_position"] = $user->user_position;
			
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Authorization Request",
				"a_description"		=> "You have logged in.",
				"a_to"				=> $_SESSION["user_id"],
				"a_seen"			=> 1,
				"a_table"			=> "",
				"a_row"				=> 0,
				"a_type"			=> "login"
			]);
    ?>
        <script>
            window.location = window.location;
        </script>
    <?php
		}else{
			new Alert("error", "Sorry. Your account has not appoint to any position in this system. Please contact your executive officer or system administrator.");
		}
    }else{
        new Alert("error", "Sorry, your password is not correct.");
    }
}else{
    new Alert("error", "Sorry, your username or email is not registered in our system.");
}