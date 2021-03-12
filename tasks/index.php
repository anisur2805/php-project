	<?php
		include_once "config.php";
		$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
		if ( !$connection ) {
		    throw new Exception( "Cannot connect to database" );
		}

		$query  = "SELECT * FROM " . DB_TABLE . " WHERE complete = 0 ORDER BY date";
		$result = mysqli_query( $connection, $query );

		$cQuery  = "SELECT * FROM " . DB_TABLE . " WHERE complete = 1 ORDER BY date";
		$cResult = mysqli_query( $connection, $cQuery );
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tasks Project</title>
	<link rel="stylesheet" href="assets/fonts.css">
	<link rel="stylesheet" href="assets/normalize.css">
	<link rel="stylesheet" href="assets/milligram.css">
	<style>
		#action{
	        display: inline-block;
	        width: auto;
	        margin-right: 10px;
		}
		.text-primary {
			color: #9d5eca;
		}
	</style>
</head>
<body>
	<section style="padding-top: 7.5rem;">
		<div class="container text-center">
			<h2>Welcome, to Task Project</h2>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi ipsum voluptates officia similique odit necessitatibus tempore accusantium, fuga iste. Quam quibusdam doloremque consequatur exercitationem, quae natus optio iste quod neque molestiae molestias ex deleniti sint doloribus nisi, totam, quis laboriosam? Unde deleniti explicabo necessitatibus eveniet.</p>
			<div class="row">
    			<div class="column">
				<?php if ( mysqli_num_rows( $cResult ) > 0 ) {
    ?>
					<h4>Complete Tasks</h4>
					<table>
						<thead>
							<tr>
								<th></th>
								<th>Id</th>
								<th>Task</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php while ( $cdata = mysqli_fetch_assoc( $cResult ) ) {
				        $timestamp = strtotime( $cdata['date'] );
				        $cdate     = date( "jS F, Y", $timestamp );
				        ?>
							<tr>
								<td><input type="checkbox" value="<?php echo $cdata['id']; ?>" class="label-inline"></td>
								<td><?php echo $cdata['id']; ?></td>
								<td><?php echo $cdata['task']; ?></td>
								<td><?php echo $cdate; ?></td>
								<td><a class="delete" data-taskid="<?php echo $cdata['id']; ?>" href="#">Delete</a> | <a class="incomplete" data-taskid="<?php echo $cdata['id']; ?>" href="#">Mark Incomplete</a></td>
							</tr>
							<?php
}
    ?>
						</tbody>
					</table>
<?php
}?>

				<?php
				if ( mysqli_num_rows( $result ) == 0 ) {
				echo "<p>No data found!</p>";
				} else {
				?>
				<h4>Upcoming Tasks</h4>
				<form action="tasks.php" method="post">
					<table>
						<thead>
							<tr>
								<th></th>
								<th>Id</th>
								<th>Task</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							while ( $data = mysqli_fetch_assoc( $result ) ) {
						        $timestamp = strtotime( $data['date'] );
						        $date      = date( "jS F, Y", $timestamp );
				        	?>
							<tr>
								<td><input type="checkbox" name="taskids[]" value="<?php echo $data['id']; ?>" class="label-inline"></td>
								<td><?php echo $data['id']; ?></td>
								<td><?php echo $data['task']; ?></td>
								<td><?php echo $date; ?></td>
								<td><a class="delete" data-taskid="<?php echo $data['id']; ?>" href="#">Delete</a> | <a class="complete" data-taskid="<?php echo $data['id']; ?>" href="#">Complete</a></td>
							</tr>
							<?php
							}
							mysqli_close( $connection );
							?>

						</tbody>
					</table>

					<select name="action" id="action" name="action" id="bulkaction">
						<option value="0">With Selected</option>
						<option value="bulkdelete">Delete</option>
						<option value="bulkcomplete">Mark as Completed</option>
					</select>
					<input class="button-primary" id="builsubmit" type="submit" value="Submit">
				</form>
				<?php }?>
				<h3>Add Tasks</h3>

				<form action="tasks.php" method="POST">
					<fieldset>
						<?php
						$added = $_GET['added'];
						if ( $added ) {
						    echo '<p class="text-primary">Task successfully added!</p>';
						}?>
						<label for="task">Task</label>
						<input type="text" placeholder="Task Details" id="task" name="task">
						<label for="date">Date</label>
						<input type="text" placeholder="Task Date" name="date" id="date">
						<input type="submit" value="Add Task" class="button-primary">
						<input type="hidden" name="action" value="add">
					</fieldset>
				</form>
				</div>
			</div>

		</div>
	</section>

	<form action="tasks.php" method="post" id="completeForm">
		<input type="hidden" id="caction" name="action" value="complete">
		<input type="hidden" id="taskid" name="taskid">
	</form>

	<form action="tasks.php" method="post" id="deleteForm">
		<input type="hidden" id="deleteAction" name="action" value="delete">
		<input type="hidden" id="dtaskid" name="dtaskid">
	</form>

	<form action="tasks.php" method="post" id="incompleteForm">
		<input type="hidden" id="iaction" name="action" value="incomplete">
		<input type="hidden" id="itaskid" name="itaskid">
	</form>

	<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/main.js"></script>
</body>
</html>
