<?php
include_once "config.php";

$action = isset( $_POST['action'] ) ? $_POST['action'] : '';

$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    throw new Exception( "Cannot connect to database" );
} else {
    if ( !$action ) {
        header( 'Location: index.php' );
        die();
    } else {
        if ( 'add' == $action ) {
            // $task = $_POST['task'];
            // $date = $_POST['date'];

            $task = filter_input( INPUT_POST, 'task', FILTER_SANITIZE_STRING );
            $date = filter_input( INPUT_POST, 'date', FILTER_SANITIZE_STRING );

            if ( $task && $date ) {
                $query = "INSERT INTO " . DB_TABLE . "(task, date) VALUES ('{$task}', '{$date}')";
                mysqli_query( $connection, $query );
                header( 'Location: index.php?added=true' );
            }
        } else if ( 'complete' == $action ) {
            // $taskid = filter_input( INPUT_POST, 'taskid', FILTER_SANITIZE_STRING ); 
			$taskid = $_POST['taskid'];
			
            if ( $taskid ) {
                $query = "UPDATE tasks SET complete=1 WHERE id={$taskid} LIMIT 1"; 
                mysqli_query( $connection, $query );
            }
            header( 'Location: index.php' );
        } else if ( 'delete' == $action ) {
            // $taskid = filter_input( INPUT_POST, 'taskid', FILTER_SANITIZE_STRING ); 
			$taskid = $_POST['dtaskid'];
			// echo $taskid;
			// die();
            if ( $taskid ) {
                $query = "DELETE FROM tasks WHERE id={$taskid} LIMIT 1";
                mysqli_query( $connection, $query );
            }
            header( 'Location: index.php' );
        } else if ( 'incomplete' == $action ) {
            // $taskid = filter_input( INPUT_POST, 'taskid', FILTER_SANITIZE_STRING ); 
			$taskid = $_POST['itaskid'];
			// echo $taskid;
			// die();
            if ( $taskid ) {
                $query = "UPDATE tasks SET complete=0 WHERE id={$taskid} LIMIT 1"; 
                mysqli_query( $connection, $query );
            }
            header( 'Location: index.php' );
        } else if ( 'bulkcomplete' == $action ) {
            // $taskid = filter_input( INPUT_POST, 'taskid', FILTER_SANITIZE_STRING ); 
			$taskids = $_POST['taskids']; 
			$_taskids = join(",", $taskids); 
			if ( $taskids ) {
                $query = "UPDATE tasks SET complete=1 WHERE id in ($_taskids)"; 
                mysqli_query( $connection, $query );
            }
            header( 'Location: index.php' );
        } else if ( 'bulkdelete' == $action ) {
            // $taskid = filter_input( INPUT_POST, 'taskid', FILTER_SANITIZE_STRING ); 
			$taskids = $_POST['taskids']; 
			$_taskids = join(",", $taskids); 
			if ( $taskids ) {
                $query = "DELETE FROM tasks WHERE id in ($_taskids)"; 
                mysqli_query( $connection, $query );
            }
            header( 'Location: index.php' );
        }
    }
}
mysqli_close( $connection );