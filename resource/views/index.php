<div class="jumbotron">
	<div class="alert alert-success" role="alert">
		<h1>ElectrifyPHP Starter Application</h1>
		<?php if(is_auth()) {
			echo "Welcome " . auth()->user('first_name');
		}else{
			echo "Welcome Guest";
		}
		?>
	</div>
	<?php if(is_guest()) { ?>
		<h4 class="text-center"> <a href="./register">Register</a> | <a href="./login">Login</a></h4>
	<?php } ?>
</div>