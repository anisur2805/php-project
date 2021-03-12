<?php
include_once "functions.php";

$allowedTypes = array(
    'image/png',
    'image/jpg',
    'image/jpeg',
);

// Single File Upload
// if($_FILES['photo']) {
//     if(in_array($_FILES['photo']['type'], $allowedTypes) !== false){
//         move_uploaded_file($_FILES['photo']['tmp_name'], 'files/' .$_FILES['photo']['name'] );
//         // die("File Uploaded!");
//     }
// }

// Multiple Files Upload
if ( $_FILES['photo'] ) {
    $totalFiles = count( $_FILES['photo'] );
    for ( $i = 0; $i < $totalFiles; $i++ ) {
        if ( in_array( $_FILES['photo']['type'][$i], $allowedTypes ) !== false ) {
            move_uploaded_file( $_FILES['photo']['tmp_name'][$i], 'files/' . $_FILES['photo']['name'][$i] );
            // die("File Uploaded!");
        }
    }
}

$fruits = ['mange', 'apple', 'orange'];
$foods  = ['mange', 'apple', 'orange'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HTML Webpage</title>
	<!-- Google Fonts -->
	<link rel="stylesheet" href="fonts.css">
	<!-- CSS Reset -->
	<link rel="stylesheet" href="normalize.css">
	<!-- Milligram CSS -->
	<link rel="stylesheet" href="milligram.css">
	<!-- You should properly set the path from the main file. -->
</head>
<body>
	<section style="padding-top: 7.5rem;">
		<div class="container text-center">
			<h2>Welcome, to PHP World</h2>
			<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni ipsum error enim tenetur dignissimos fuga!</p>


			<?php
$fname   = '';
$lname   = '';
$checked = '';

if ( isset( $_POST['ckb'] ) && $_POST['ckb'] == 1 ) {
    $checked = "checked";
}
if ( isset( $_POST['fname'] ) && !empty( $_POST['fname'] ) ) {
    $fname = filter_input( INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
}
if ( isset( $_POST['lname'] ) && !empty( $_POST['lname'] ) ) {
    $lname = filter_input( INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
}

if ( isset( $_POST['fruits'] ) && $_POST['fruits'] != '' ) {
    // printf( 'You have selected: %s', filter_input( INPUT_POST, 'fruits', FILTER_SANITIZE_STRING ) );
    $sfruits = filter_input( INPUT_POST, 'fruits', FILTER_SANITIZE_STRING );

	if ( $sfruits ) {
		echo 'You have selected:' . $sfruits;
	}
}

$sfoods = filter_input( INPUT_POST, 'foods', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY );
if ( $sfoods > 0 ) {
    echo 'You have selected: ' . join( ', ', $sfoods );
}
?>
			<div class="row">
    			<div class="column">
					<form method="POST" enctype="multipart/form-data">
					    <fieldset>
						    <!-- <label for="fname">First Name</label>
						    <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>">

						    <label for="lname">Last Name</label>
						    <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>">

							<input type="checkbox" id="ckb" name="ckb" value="1" <?php echo $checked; ?> >
							<label class="label-inline" for="ckb">Agree with terms and conditions.</label> <br>


							<label class="label-inline"><strong>Select Fruits</strong></label> <br>
							<input type="checkbox" name="fruits[]" value="orange" <?php isFruits( 'orange' );?> >
							<label class="label-inline">Orange</label> <br>
							<input type="checkbox" name="fruits[]" value="mango" <?php isFruits( 'mango' );?> >
							<label class="label-inline">Mango</label> <br>
							<input type="checkbox" name="fruits[]" value="banana" <?php isFruits( 'banana' );?> >
							<label class="label-inline">Banana</label> <br> -->

							<!-- <label class="label-inline"><strong>Select Fruits</strong></label> <br>
							<input type="checkbox" name="fruits[]" value="orange" <?php isChecked( 'fruits', 'orange' );?> >
							<label class="label-inline">Orange</label> <br>
							<input type="checkbox" name="fruits[]" value="mango" <?php isChecked( 'fruits', 'mango' );?> >
							<label class="label-inline">Mango</label> <br>
							<input type="checkbox" name="fruits[]" value="banana" <?php isChecked( 'fruits', 'banana' );?> >
							<label class="label-inline">Banana</label> <br> -->

							<!-- Single File Upload -->
							<!-- <label class="label-inline" for="photo">Upload Profile Image</label> <br>
							<input type="file" name="photo" id="photo" /> -->

							<!-- Multiple Files Upload -->
							<!-- <label class="label-inline" for="photo">Upload Profile Image</label> <br>
							<input type="file" name="photo[]" id="photo" /><br>
							<input type="file" name="photo[]" id="photo" /><br>
							<input type="file" name="photo[]" id="photo" /> -->

							<select name="fruits" id="fruits">
								<option value="" disabled selected>Select One</option>
								<?php displayOption( $fruits );?>
							</select>


							<!-- <select name="foods[]" id="foods" multiple>
								<option value="" disabled selected>Select Multiple</option>
								<?php //displayFoodOption( $foods, $sfoods );?>
							</select> -->

							<br>
							<input class="button-primary" type="submit" value="Submit">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	</section>
</body>
</html>
