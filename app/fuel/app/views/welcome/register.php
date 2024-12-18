<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registers</title>
	<?php echo Asset::css('main.css'); ?>
	<?php echo Asset::css('home.css'); ?>
</head>
<body>
	<div class="background wrapper signin_wrapper ">
		<h3 class="main-heading">Sign Up</h3>
		<form action="/ecom/register" method="post">
			<div class="form-area">
				<input type="text" name="username" placeholder="Username" class="main-input">
				<p class="error">1111</p>
			</div>
            <div class="form-area">
				<input type="email" name="email" placeholder="Email" class="main-input">
				<p class="error">1111</p>
			</div>
			<div class="form-area">
				<input type="password" name="password" placeholder="password" class="main-input">
				<p class="error">1111</p>
			</div>
            <div class="form-area">
				<input type="password" name="confirm_password" placeholder="confirm password" class="main-input">
				<p class="error">1111</p>
			</div>
			<div class="button-area">
				<input type="submit" class="main-button" name="sigin" value="Sign In">
			</div>
		</form>
		<div class="signin_link">
			<a href="/register" class="main-link">Not a member</a>
		</div>
	</div>
</body>
</html>