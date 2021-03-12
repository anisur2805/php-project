<?php
session_start([
    'cookie_lifetime' => 300,
]);

// session_destroy();

// echo sha1('rabbit');

$error = false;

$fp       = fopen( './data/users.txt', 'r' );
$username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
$password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );

if ( $username && $password ) {
    $_SESSION['loggedin'] = false;
    $_SESSION['user']     = false;
    $_SESSION['role']     = false;
    while ( $data = fgetcsv( $fp ) ) {
        if ( $data[0] == $username && $data[1] == sha1( $password ) ) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user']     = $username;
            $_SESSION['role']     = $data[2];
            header( 'location: index.php' );
        }
    }

    if ( !$_SESSION['loggedin'] ) {
        $error = true;
    }

}

if ( isset( $_GET['logout'] ) ) {
    $_SESSION['loggedin'] = false;
    $_SESSION['user']     = false;
    $_SESSION['role']     = false;
    session_destroy();
    header( 'location: index.php' );
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
			<?php if ( $error ) {
    echo "<blockquote>Username and Password didn't match</blockquote>";
}?>
			<?php if ( false == $_SESSION['loggedin'] ): ?>
				<form method="POST">
					<label for="username">Username</label>
					<input type="text" id="username" name="username">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
					<button type="submit" class="primary-button" name="submit">Log In</button>
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