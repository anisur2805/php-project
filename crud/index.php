<?php
require_once "inc/functions.php";
$info = "";
$task = $_GET['task'] ?? 'report';
$error = $_GET['error'] ?? '0';

if( 'edit' == $task ) {
	if( !hasPrivilage() ) {
		header( 'location: /crud/index.php?task=report');
		return;
	}
}

if('delete' == $task) {
	if( !isAdmin() ) {
		header( 'location: /crud/index.php?task=report');
		return;
	}
	
	$id   = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_STRING );
	deleteStudent( $id );
	header( 'location: /crud/index.php?task=report');
}
if ( 'seed' == $task ) {
	if( !isAdmin() ) {
		header( 'location: /crud/index.php?task=report');
		return;
	}
	
    seed();
    $info = "Seeding is complete";
}

$fname = '';
$lname = '';
$roll = '';

if ( isset( $_POST['submit'] ) ) {
    $fname = filter_input( INPUT_POST, 'fname', FILTER_SANITIZE_STRING );
    $lname = filter_input( INPUT_POST, 'lname', FILTER_SANITIZE_STRING );
    $roll   = filter_input( INPUT_POST, 'roll', FILTER_SANITIZE_STRING );
    $id   = filter_input( INPUT_POST, 'id', FILTER_SANITIZE_STRING );

	if( $id ) {
		if ( $fname != '' && $lname != '' && $roll != '' ) {
			$result = updateStudent( $id, $fname, $lname, $roll );
			if($result) {
				header( 'location: /crud/index.php?task=report');
			} else {
				$error = '1';
			}
		}
	} else {
	    if ( $fname != '' && $lname != '' && $roll != '' ) {
	        $result = addStudent( $fname, $lname, $roll );
			if($result) {
				header( 'location: /crud/index.php?task=report');
			} else {
				$error = '1';
			}
	    }
	}
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
<body>
	<section style="padding-top: 7.5rem;">
		<div class="container text-center">
			<h2>Welcome, to CRUD World</h2>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi ipsum voluptates officia similique odit necessitatibus tempore accusantium, fuga iste. Quam quibusdam doloremque consequatur exercitationem, quae natus optio iste quod neque molestiae molestias ex deleniti sint doloribus nisi, totam, quis laboriosam? Unde deleniti explicabo necessitatibus eveniet.</p>

			<?php include_once "inc/templates/nav.php";?>
			<hr>
			<?php
if ( $info != '' ) {
    echo "<p> {$info} </p>";
}
?>

			<?php if ( '1' == $error ): ?>
			<div class="row">
    			<div class="column">
					<blockquote>Duplicate roll found!</blockquote>
				</div>
			</div>
			<?php endif;?>

			<?php if ( 'report' == $task ): ?>
			<div class="row">
    			<div class="column">
				<?php generateData();?>
				<!-- <div>
					<pre>
						<?php printRaw(); ?>
					</pre>
				</div> -->
				</div>
			</div>
			<?php endif;?>


			<?php if ( 'add' == $task ): ?>
			<div class="row">
    			<div class="column">
					<form action="/crud/index.php?task=add" method="POST">
						<label for="fname">First Name</label>
						<input type="text" id="fname" name="fname" value="<?php echo $fname; ?>">
						<label for="lname">Last Name</label>
						<input type="text" id="lname" name="lname" value="<?php echo $lname; ?>">
						<label for="roll">Roll</label>
						<input type="number" id="roll" name="roll" value="<?php echo $roll; ?>">
						<button type="submit" class="primary-button" name="submit">Save</button>
					</form>
				</div>
			</div>
			<?php endif;?>

			<?php
				if ( 'edit' == $task ):
				$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
				$student = getStudent( $id );
				if( $student) :
			?>
			<div class="row">
    			<div class="column">

				<form method="POST">
					<input type="hidden" value="<?php echo $id; ?>" name="id">
					<label for="fname">First Name</label>
					<input type="text" id="fname" name="fname" value="<?php echo $student['fname']; ?>">
					<label for="lname">Last Name</label>
					<input type="text" id="lname" name="lname" value="<?php echo $student['lname']; ?>">
					<label for="roll">Roll</label>
					<input type="number" id="roll" name="roll" value="<?php echo $student['roll']; ?>">
					<button type="submit" class="primary-button" name="submit">Update</button>
				</form>
				</div>
			</div>
			<?php endif; endif; ?>

		</div>
	</div>
	</section>

	<script src="assets/main.js"></script>
</body>
</html>
