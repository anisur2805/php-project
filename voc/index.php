<?php
session_start();
$_user_id = $_SESSION['id'];
if( $_user_id ) {
	header("Location: words.php");
}
include_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vocabulary Project</title>
	<link rel="stylesheet" href="../crud/assets/fonts.css">
	<link rel="stylesheet" href="../crud/assets/normalize.css">
	<link rel="stylesheet" href="../crud/assets/milligram.css">
	<style>
		body {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		#form01 {
			box-shadow: 0 0 4px 5px rgba(0,0,0,.15);
			padding: 20px;

		}
	</style>
</head>
<body>
	<section style="padding-top: 7.5rem;">
		<div class="container text-center">
			<h2>Welcome, to Vocabulary Project</h2>
				<div class="formaction" style="margin-bottom: 15px;">
					<a href="#" id="login">Login</a> | <a href="#" id="register">Register</a>
				</div>
			<div class="row">
    			<div class="column">
					<form action="tasks.php" method="POST" id="form01">
						<h3>Login</h3>

						<fieldset>
							<label for="email">Email</label>
							<input type="email" placeholder="Email" id="task" name="email">
							<label for="password">Password</label>
							<input type="password" placeholder="Password" name="password" id="password">
							
						
							<?php
								$status = $_GET['status'] ?? 0;
								if ( $status ) {
								    echo "<p>" . getStatusMessage( $status ) . "</p>";
								}
							?>
							</p>

							<input type="submit" value="Submit" class="button-primary">
							<input type="hidden" name="action" id="action" value="login">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</section>

	<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/main.js"></script>
</body>
</html>
