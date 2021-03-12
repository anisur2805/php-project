<?php
include_once "config.php";

$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    throw new Exception( "Cannot connect to database" );
} else {
    echo "Connected";
    echo mysqli_query( $connection, "INSERT INTO tasks (id, task, date) VALUES (1, 'Something', '2021-03-11')" );

    // $result = mysqli_query( $connection, "SELECT * FROM tasks" );
    // while ( $data = mysqli_fetch_assoc( $result ) ) {
    //     echo "<pre>";
    //     print_r( $data );
    //     echo "</pre>";

    // }
    mysqli_close( $connection );
}
