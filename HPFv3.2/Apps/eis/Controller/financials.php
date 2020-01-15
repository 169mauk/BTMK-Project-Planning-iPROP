<?php
switch (input::post("type")) {
	case 'f_search':
		$seacrh = F::URLSlugEncode(input::post("search"));
		
		
		//$project = DB::conn()->q("SELECT * FROM projects WHERE p_name LIKE '$data'")->results();
		
		
		?>
			<script>
				window.location = PORTAL + "financials/search/<?= $seacrh ?>";
			</script>
			
		<?php
		
	break;
	
	case "filter":
	
		$data = "&department=" . (!empty(Input::post("department")) ? implode(",", Input::post("department")) : "all");
		$data .= ("&sector=") . (!empty(Input::post("sector")) ? implode(",", Input::post("sector")) : "all");
		$data .= "&status=" . (!empty(Input::post("status")) ? implode(",", Input::post("status")) : "all");
		$data .= "&client=" . (!empty(Input::post("client")) ? implode(",", Input::post("client")) : "all");
		
		?>
			<script>
				window.location = PORTAL + "financials/<?= $data ?>";
			</script>
			
		<?php
	
	break;
}
?>
