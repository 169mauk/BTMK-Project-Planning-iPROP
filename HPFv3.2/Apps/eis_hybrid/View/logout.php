<div class="card">
	<div class="card-header">
		Logging Out
	</div>
	
	<div class="card-body text-center">
		Are you sure logging out?<br /><br />
		
		<button class="btn btn-danger btn-sm" id="logout">
			Logout
		</button>
	</div>
</div>
<script>
$(document).on("click", "#logout", () => {
	try {
		invokeCSharpAction("logout");
	}
	catch (err) {
		log(err);
	}
});
</script>