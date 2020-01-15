<?php
$data = "&department=" . (!empty(Input::post("department")) ? implode(",", Input::post("department")) : "all");
$data .= ("&sector=") . (!empty(Input::post("sector")) ? implode(",", Input::post("sector")) : "all");
$data .= "&status=" . (!empty(Input::post("status")) ? implode(",", Input::post("status")) : "all");
$data .= "&client=" . (!empty(Input::post("client")) ? implode(",", Input::post("client")) : "all");
?>
<script>
	window.location = PORTAL + "projects/<?= $data ?>";
</script>