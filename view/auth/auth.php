<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: /");
	exit;
} else {
	session_destroy();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Authentication</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/main.css">

	<link rel="stylesheet" type="text/css" href="../../assets/css/auth.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">
		<div class="login">
			<form method="post" action="../../backend/auth.php">
				<label id="login" for="chk" aria-hidden="true">Login</label>
				<input type="hidden" name="auth" value="login">
				<input type="email" name="email" placeholder="Email" required="">
				<?php
					if (isset($_SESSION['login_email_error'])) {
				?>
				<span class="login_error_message">
					<?php echo $_SESSION['login_email_error']; ?>
				</span>
				<?php
					}
				?>
				<input type="password" name="password" placeholder="Password" required="">
				<?php
					if (isset($_SESSION['login_password_error'])) {
				?>
				<span class="login_error_message">
					<?php echo $_SESSION['login_password_error']; ?>
				</span>
				<?php
					}
				?>
				<button>Login</button>
			</form>
		</div>
		<div class="signup">
			<form method="post" action="../../backend/auth.php">
				<label id="signup" for="chk" aria-hidden="true">Sign up</label>
				<input type="hidden" name="auth" value="signup">
				<input type="text" name="name" placeholder="User name" required="">
				<?php
					if (isset($_SESSION['signup_name_error'])) {
				?>
				<span class="signup_error_message">
					<?php echo $_SESSION['signup_name_error']; ?>
				</span>
				<?php
					}
				?>
				<input type="email" name="email" placeholder="Email" required="">
				<?php
					if (isset($_SESSION['signup_email_error'])) {
				?>
				<span class="signup_error_message">
					<?php echo $_SESSION['signup_email_error']; ?>
				</span>
				<?php
					}
				?>
				<input type="password" name="password" placeholder="Password" required="">
				<?php
					if (isset($_SESSION['signup_password_error'])) {
				?>
				<span class="signup_error_message">
					<?php echo $_SESSION['signup_password_error']; ?>
				</span>
				<?php
					}
				?>
				<button>Sign up</button>
			</form>
		</div>
	</div>
</body>
	<?php
		if (isset($_SESSION['signup_form'])) {
	?>
	<script>
		if (<?php echo $_SESSION['signup_form']; ?> === 1) {
			let element = document.getElementById('signup')
			element.click()
		}
	</script>
	<?php
		}
	?>
</html>