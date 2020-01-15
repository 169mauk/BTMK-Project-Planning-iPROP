<?php

$obj = "0";
if(is_array(Input::post("objek"))){
	$obj = "";
	foreach(Input::post("objek") as $o){
		if(($obj) != ""){
			$obj .= ",";
		}
		
		$obj .= $o;
	}
}

$lanjut = "0";
if(is_array(Input::post("lanjut"))){
	$lanjut = "";
	foreach(Input::post("lanjut") as $o){
		if(($lanjut) != ""){
			$lanjut .= ",";
		}
		$lanjut .= $o;
	}
}

?>
<script>
	window.location = PORTAL + "report/<?= $obj ?>/<?= $lanjut ?>";
</script>