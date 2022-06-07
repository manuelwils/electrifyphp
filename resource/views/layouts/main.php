<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- css files -->
		<link rel="stylesheet" type="text/css" href="<?php echo assets('css/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo assets('css/style.css'); ?>" />
		<!--<link rel="stylesheet" type="text/css" href="css2/bootstrap.css"/>-->
		<!-- js files -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<title>Web</title>
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div id="navbar" class="" style="margin-bottom: -20px">
						<ul>
							<li><a class="navbar-brand" href="./">HOME</a></li>
							<?php if(is_guest()) { ?>
								<li><a href="./login" class="btn btn-primary text-white" style="margin-top: -10px">Login</a></li>
							<?php } else {  ?>
							<!-- 	<li><a href="admin.php">Admin</a></li>  -->
								<li style="margin-top: -10px">
									<form method="post" action="./logout">
										<input type="submit" class="btn btn-primary" value="Logout">
									</form>
								</li>
							<?php } ?>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</nav>

            {{content}}
            
        </div>
    </body>
</html>