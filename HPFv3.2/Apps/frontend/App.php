<?php
define("AES_PASSWORD", md5('JHADS7IA6#$@#$@gk#$%l#l%h#h^h#jlj$#%hj$j%hlj#%h#%ll#lj#$l#lj%#j%bgl#g%l#%g#%jl#j%vj#vfbdsafrlj!q$#!op$!{i{p!@${pwt:n@h%l#h@#lj$nb@#lb$@b$#j@j$lb'));
$page = new Page();
$page->addTopTag('
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="'. PORTAL .'assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/fonts/icomoon/icomoon.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/css/main.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/vendor/morris/morris.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/vendor/circliful/circliful.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/css/jquery-ui.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/css/datepicker.css" />	
	<link rel="stylesheet" href="'. PORTAL .'assets/vendor/datatables/dataTables.bs4.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/vendor/datatables/dataTables.bs4-custom.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/vendor/bs-select/bs-select.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/vendor/summernote/summernote.css" />
	<link rel="stylesheet" href="'. PORTAL .'assets/vendor/c3/c3.min.css" />
	<!--<script src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBehjO1GuDz--gzxCCBePfqBhpV82kfLPA"></script>-->
	<script>
		PORTAL = "'. PORTAL .'";
	</script>
');

$page->addBottomTag('
	<script src="'. PORTAL .'assets/js/jquery.js"></script>
	<script src="'. PORTAL .'assets/js/tether.min.js"></script>
	<script src="'. PORTAL .'assets/js/bootstrap.min.js"></script>
	<script src="'. PORTAL .'assets/vendor/bluemoonNav/bluemoonNav.js"></script>
	<script src="'. PORTAL .'assets/vendor/onoffcanvas/onoffcanvas.js"></script>
	<script src="'. PORTAL .'assets/js/moment.js"></script>
	<script src="'. PORTAL .'assets/vendor/ckeditor/ckeditor.js"></script>
	<script src="'. PORTAL .'assets/vendor/slimscroll/slimscroll.min.js"></script>
	<script src="'. PORTAL .'assets/vendor/slimscroll/custom-scrollbar.js"></script>
	<script src="'. PORTAL .'assets/vendor/newsticker/newsTicker.min.js"></script>
	<script src="'. PORTAL .'assets/js/jquery-ui.min.js"></script>
	<script src="'. PORTAL .'assets/js/common.js"></script>
	<script src="'. PORTAL .'assets/vendor/datatables/dataTables.min.js"></script>
	<script src="'. PORTAL .'assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
	<script src="'. PORTAL .'assets/vendor/bs-select/bs-select.min.js"></script>
	
	<script type="text/javascript">
		$(function() {
			$("#datepicker").datepicker();
		});
		
		$(".dataTable").DataTable();
		/*$(".summernote").summernote({
			height: 400
		});*/
		
		$(".summernote").each(function(){
			CKEDITOR.replace($(this).attr("name"));
		});
	</script>
');


if(isset($_SESSION["user_login"], $_SESSION["user_id"])){
	$page->setMainMenu("widgets/main_menu.php");
	$page->setFooter("widgets/footer.php");
	
	if(url::get(0) == "webservice" || url::get(0) == "upload" || url::get(0) == "download" || url::get(0) == "logout"){
		$pagex = url::get(0);
	}else{
		if(url::get(0) == "index"){
			$cm = "dashboard";
		}else{
			$cm = url::get(0);
		}
		
		if(!$_SESSION["admin"]){
			$x = menus::list(["where" => "FIND_IN_SET(". $_SESSION["user_position"] .", m_role) > 0 AND m_disabled = 0 AND m_main = 0 AND m_url = '" . $cm . "'"]);
		}else{
			$x = menus::list(["where" => "m_disabled = 0 AND m_main = 0 AND m_url = '" . $cm . "'"]);
		}
		
		if(count($x)){
			$pagex = $x[0]->m_url;
		}else{
			$pagex = "404";
		}
	}
	
	switch($pagex){
		case "index":
		case "dashboard":
			$page->title = "Dashboard - " . APP_NAME;
			$page->loadPage("index");
			$page->Render();
		break;
		
		case "projects":
			$page->title = "Projects - " . APP_NAME;
			$page->loadPage("projects");
			$page->render();
		break;
		
		case "tasks":
			$page->title = "Tasks - " . APP_NAME;
			$page->loadPage("tasks");
			$page->Render();
		break;
		
		case "reports":
			$page->title = "Reports - " . APP_NAME;
			$page->loadPage("reports");
			$page->Render();
		break;
		
		case "companies":
			$page->title = "Companies - " . APP_NAME;
			$page->loadPage("companies");
			$page->Render();
		break;
		
		case "eot":
			$page->title = "Companies - " . APP_NAME;
			$page->loadPage("eot");
			$page->Render();
		break;
		
		case "vo":
			$page->title = "Companies - " . APP_NAME;
			$page->loadPage("vo");
			$page->Render();
		break;
		
		case "clients":
			$page->title = "Clients - " . APP_NAME;
			$page->loadPage("clients");
			$page->Render();
		break;
		
		case "users":
			$page->title = "Users - " . APP_NAME;
			$page->loadPage("users");
			$page->Render();
		break;
		
		case "settings":
			$page->title = "Settings - " . APP_NAME;
			$page->loadPage("settings");
			$page->Render();
		break;
		
		case "user-boards":
			$page->title = "User Boards - " . APP_NAME;
			$page->loadPage("user-boards");
			$page->Render();
		break;

		case "statistics":
			$page->title = "Statistics - " . APP_NAME;
			$page->loadPage("statistics");
			$page->Render();
		break;
		
		
		case "webservice":			
			try{
				$data = [];
				foreach($_POST as $key => $value){
					$data[$key] = $value;
				}
				
				switch(url::get(2)){
					case "insertInto":
					case "deleteBy":
					case "list":
					case "getBy":
						$c = url::get(1);
						$t = $c::{url::get(2)}($data);
					break;
					
					case "updateBy":
						$where = [];
						$wh = explode(",", url::get(3));
						foreach($wh as $w){
							$wx = explode("=", $w);
							$where[$wx[0]] = $wx[1];
						}
						
						$c = url::get(1);
						$t = $c::{url::get(2)}($where, $data);
					break;
					
					default:
						$t = null;
					break;
				}
				
				echo json_encode([
					"status"	=> "success",
					"code"		=> "RESPONSE_WESERVICE",
					"message"	=> "Repsonse from ". url::Get(1) ." webservice.",
					"data"		=> $t
				]);
			}catch(Exception $e){
				echo json_encode([
					"status"	=> "error",
					"code"		=> "RESPONSE_TASK_WESERVICE",
					"message"	=> $e->getMessage(),
					"data"		=> null
				]);
			}
		break;
		
		case "upload":
			switch(url::get(1)){
				case "project_file":
					if(isset($_GET["id"])){
						$fname = F::UniqKey() . "-" . F::URLSlugEncode(url::get(2));
						$i = fopen("php://input", "rb");
						$o = fopen(ASSET . "projects/" . $fname, "w+");
						
						$iv = Encrypter::CreateIv();
						fwrite($o, F::Encode64($iv) . ":");
						
						while(!feof($i)){
							$buffer = fread($i, 1024);
							fwrite($o, 
								F::Encode64(
										Encrypter::AESEncrypt(
											$buffer,
											AES_PASSWORD, 
											$iv
										)
								) . ":"
							);
							$buffer = "";
							flush();
						}
						$key = F::UniqKey("FILE_");
						
						files::insertInto([
							"f_name"	=> $fname,
							"f_title"	=> $fname,
							"f_user"	=> $_SESSION["user_id"],
							"f_date"	=> F::GetDate(),
							"f_time"	=> F::GetTime(),
							"f_key"		=> $key
						]);
						
						$f = files::getBy(["f_key" => $key]);
						
						if(count($f)){
							$f = $f[0];
							
							project_file::insertInto(
							[
								"pf_project"	=> Input::get("id"),
								"pf_file"		=> $f->f_id
							]);
						}
					}
				break;
			}
		break;
		
		case "download":
			switch(url::get(1)){
				case "project_file":
					$fname = url::get(2);
					$path = ASSET . "projects/" . $fname;
					
					if(file_exists($path)){
						$o = fopen($path, "rb");
						$e = fopen("php://output", "w+");
						
						header('Content-Type: ');
						header('Content-Disposition: attachment; filename="' . $fname . '"');
						
						$buffer = "";
						$iv = false;
						
						while(!feof($o)){
							$char = fgetc($o);
							if($char == ":"){
								if(!$iv){
									$iv = F::Decode64($buffer);
								}else{
									fwrite($e, Encrypter::AESDecrypt(F::Decode64($buffer), AES_PASSWORD, $iv));
								}
								
								$buffer = "";
							}else{
								$buffer .= $char;
							}
						}
					}else{
						header("Content-Type: text/plain");
						echo "File ". $fname ." not found.";
					}
				break;
			}
		break;	
		
		case "logout":
			session_destroy();
			header("Location: " . PORTAL);
		break;
		
		case "404":
		default:
			$page->title = "Page Not Found - " . APP_NAME;
			$page->setBodyAttribute('class="lena-centered-body text-center"');
			$page->loadPage("404");
			$page->render();
		break;
	}
}else{
	$page->setBodyAttribute('class="lena-centered-body text-center"');
	$page->title = "Login - " . APP_NAME;
	$page->loadPage("login");
	$page->Render();
}

















