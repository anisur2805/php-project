<?php 

session_start();
$_user_id = $_SESSION['id'];
// if( $_user_id ) {
// 	header("Location: words.php");
// }

require_once "functions.php";
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
	
		.section-wrapper {
			background: #f5f5f5;
			height: 100vh;
		}
		body {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		.leftside {
			flex-basis: 350px !important;
			background: #f8f8f8;
			padding: 20px 10px !important;
			border-radius: 5px;
		}
		
		.rightside {
			padding-left: 25px !important;
		}
		
		.topbar {
			display: -webkit-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			justify-content: space-between;
			margin-bottom: 40px;;
		}
		
		.topbar select {
			flex-basis: 300px;
		}
		
		
	</style>
</head>
<body>
	<section class="section-wrapper" style="padding-top: 7.5rem;">
		<div class="container text-center">
			<div class="row">
				<div class="column leftside">
					<h2>Menu</h2>
					<ul>
						<li><a href="words.php" class="menu-item" data-target="form01">All Words</a></li>
						<li><a href="#" class="menu-item" data-target="form02">Add New Word</a></li>
						<li><a href="index.php?logout=true" >Logout</a></li>
					</ul>
				</div>
    			<div class="column rightside">
					<div class="helement" id="form01">
						<h2>My Vocabulary</h2>
						<div class="topbar">
							<select name="alphabets" id="alphabets">
								<option value="all">All Words</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="H">H</option>
								<option value="M">M</option>
								<option value="O">O</option>
								<option value="P">P</option>
							</select>
							<div class="search-wrapper">
								<form action="" method="POST">
									<button class="float-right" name="submit" value="submit">Search</button>
									<input type="text" name="search" class="float-left" style="width: calc(100% - 132px); margin-right: 20px;" placeholder="Search word here...">
								</form>
							</div>
						</div>
						
						<table class="words-tbl">
							<tr>
								<th>Word</th>
								<th>Definition</th>
							</tr>
							<?php 
							if( isset( $_POST['submit'] ) ) {
								$searchText = $_POST['search'];
								$words = getWord( $_user_id, $searchText ); 
							} else {
								$words = getWord( $_user_id ); 
							}
							if( count($words) > 0) {
								$length = count($words);
								for($i = 0; $i < $length; $i++) {
							?>
							<tr>
								<td><?php echo strtolower($words[$i]['word']); ?></td>
								<td><?php echo $words[$i]['meaning']; ?></td>
							</tr>
							
							<?php 
								}
							} ?>
						</table>
					</div>
					
					<form action="tasks.php" method="POST" id="form02" class="helement" style="display: none;">
						<h3>Add New Word</h3>

						<fieldset>
							<label for="word">word</label>
							<input type="text" placeholder="Word" id="word" name="word">
							<label for="meaning">Meaning</label>
							<textarea name="meaning" id="meaning" cols="30" rows="10" placeholder="Description"></textarea>
							<input type="submit" value="Add Word" class="button-primary">
							<input type="hidden" name="action" value="add_word">
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
