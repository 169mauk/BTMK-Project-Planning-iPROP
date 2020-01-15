<?php

switch (input::post("type")) {
	case 'f_search':
		$seacrh = F::URLSlugEncode(input::post("search"));
		
		?>
			<script>
				window.location = PORTAL + "vo/search/<?= $seacrh ?>";
			</script>
			
		<?php
		
	break;
	
	case 'filter':
		$data = "&department=" . (!empty(Input::post("department")) ? implode(",", Input::post("department")) : "all");
		$data .= ("&sector=") . (!empty(Input::post("sector")) ? implode(",", Input::post("sector")) : "all");
		$data .= "&status=" . (!empty(Input::post("status")) ? implode(",", Input::post("status")) : "all");
		$data .= "&client=" . (!empty(Input::post("client")) ? implode(",", Input::post("client")) : "all");
		$data .= "&status_vo=" . (!empty(Input::post("status_vo")) ? implode(",", Input::post("status_vo")) : "all");
		?>
			<script>
				window.location = PORTAL + "vo/<?= $data ?>";
			</script>
		<?php
	break;
}
?>