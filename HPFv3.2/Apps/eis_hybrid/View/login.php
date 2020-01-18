<div class="card">
	<div class="card-header">
		Login <?= APP_NAME ?>
	</div>
	
	<div class="card-body">
		Username:
		<input type="text" class="form-control" placeholder="Username" id="username" /><br />
		
		Password:
		<input type="password" class="form-control" placeholder="Password" id="password" /><br />
		
		<button class="btn btn-sm btn-primary" id="login">
			Login
		</button>
	</div>
</div>

<script>
$(document).on("click", "#login", () => {
	if($("#username").val() == "" || $("#password").val() == ""){
		alert("Username and password cannot be empty.");
	}else{
		Run("Hello World");
		//alert(y);
	}
})
</script>