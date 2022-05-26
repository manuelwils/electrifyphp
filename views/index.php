<?php 
	load_file('views/components/header.php');
?>

<div class="jumbotron">
	<div class="alert alert-success" role="alert">
		<?php if(Auth::is_auth()) {
			echo "Welcome " . Auth::user('first_name');
		}else{
			echo "Welcome Guest";
		}
		?>
	</div>
	<?php if(Auth::is_guest()) { ?>
		<h4 class="text-center"> <a href="./register">Register</a> || <a href="./login">Login</a></h4>
	<?php } ?>
</div>

<?php 
	load_file('views/components/footer.php');
?>