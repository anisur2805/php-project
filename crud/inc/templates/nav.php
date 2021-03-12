<?php
session_start( [
    'cookie_lifetime' => 300,
] );

?>

<div class="">
	<div class="float-left">
		<p>
			<a href="/crud/index.php?task=report">All Students</a>
			<?php if( hasPrivilage() ): ?>
			|
			<a href="/crud/index.php?task=add">Add Student</a>
			<?php 
			endif;
			if ( isAdmin() ): ?>
			|
			<a href="/crud/index.php?task=seed">Seed</a>
			<?php endif;?>
		</p>
	</div>
	<div class="float-right">
		<p>
			<?php if ( !$_SESSION['loggedin'] ): ?>
				<a href="/crud/auth.php">Log In</a>
			<?php else: ?>
				<a href="/crud/auth.php?logout=true">Log Out (<?php echo $_SESSION['role']; ?>)</a>
			<?php endif;?>
		</p>
	</div>
</div>
<div class="" style="clear: both;"></div>