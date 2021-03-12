<?php
session_name( 'myApp', array(
    'cookie_lifetime' => 10,
) );

// session_destroy('myApp');

$error = false;

if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
    if ( 'admin' == $_POST['username'] && 'a51e47f646375ab6bf5dd2c42d3e6181' == md5($_POST['password']) ) {
        $_SESSION['loggedin'] = true;
    } else {
		$error = true;
        $_SESSION['loggedin'] = false;
    }
}


if( isset($_POST['logout'])) {
	$_SESSION['loggedin'] = false;
	session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CRUD Project</title>
	<link rel="stylesheet" href="assets/fonts.css">
	<link rel="stylesheet" href="assets/normalize.css">
	<link rel="stylesheet" href="assets/milligram.css">
</head>
<body style="margin-top: 4.5rem;">
	<div class="container">
		<div class="row">
		<div class="column column-60 column-offset-20">
		<h1>Simple Authentication</h1>
		<?php if ( true == $_SESSION['loggedin'] ): ?>
			Hello, Admin, Welcome.
			<?php else: ?>
				Hello, Stranger, Loggedin Below.
				<?php endif;?>
		</div>
		</div>
		<div class="row" style="margin-top: 40px;">
			<div class="column column-60 column-offset-20">
			<?php if($error) {
				echo "<blockquote>Username and Password didn't match</blockquote>";
			}?>
			<?php if ( false == $_SESSION['loggedin'] ): ?>
				<form method="POST">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="<?php echo $username; ?>">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="<?php echo $password; ?>">
					<button type="submit" class="primary-button" name="submit">Loggedin</button>
				</form>
			<?php else: ?>
				<form action="auth.php" method="POST">
					<input type="hidden" name="logout" value="1" />
					<button type="submit" class="primary-button" name="submit">Log Out</button>
				</form>

			<?php endif;?>
			</div>
		</div>
	</div>
</body>
</html>