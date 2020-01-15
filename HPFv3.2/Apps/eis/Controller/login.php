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
        $_SESSION["user_login"] = $user->user_login;
        $_SESSION["user_id"] = $user->user_id;
		$_SESSION["user_password"] = $user->user_password;
		$_SESSION["department"] = $user->user_department;
		$_SESSION["role"] = $user->user_role;
		$_SESSION["admin"] = $user->user_role > 1 ? true : false;
    ?>
        <script>
            window.location = window.location;
        </script>
    <?php
    }else{
        new Alert("error", "Sorry, your password is not correct.");
    }
}else{
    new Alert("error", "Sorry, your username or email is not registered in our system.");
}