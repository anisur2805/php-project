<?php
session_start();
// session_destroy();
include_once "config.php";

$action     = $_POST['action'] ?? '';
$errorCode  = 0;
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
mysqli_set_charset( $connection, "utf8" );

if ( !$connection ) {
    throw new Exception( "Cannot connect to database" );
} else {

    if ( 'register' == $action ) {
        $email    = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
        $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
        $hash     = password_hash( $password, PASSWORD_BCRYPT );
        echo "Email: $email and Password: $hash";

        if ( $email && $hash ) {
            $query = "INSERT INTO users (email, password) VALUES ('{$email}','{$hash}') ";
            mysqli_query( $connection, $query );

            if ( mysqli_error( $connection ) ) {
                $status = 1;
            } else {
                $status = 3;
            }
        } else {
            $status = 2;
        }
        header( "Location: index.php?status={$status}" );
    } else if ( 'login' == $action ) {
        $email    = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
        $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
        // $_password =
        if ( $email && $password ) {
            $query  = "SELECT id, password FROM users WHERE email='{$email}'";
            $result = mysqli_query( $connection, $query );

            if ( mysqli_num_rows( $result ) > 0 ) {
                $data      = mysqli_fetch_assoc( $result );
                $_password = $data['password'];
                $_id       = $data['id'];

                if ( password_verify( $password, $_password ) ) {
                    $_SESSION['id'] = $_id;
                    header( 'Location: words.php' );
                    die();
                } else {
                    $status = 4;
                }
            } else {
                $status = 5;
            }
        } else {
            $status = 2;
        }
        header( "Location: index.php?status={$status}" );
    } else if ( 'add_word' == $action ) {
        $word    = filter_input( INPUT_POST, 'word', FILTER_SANITIZE_STRING );
        $meaning = filter_input( INPUT_POST, 'meaning', FILTER_SANITIZE_STRING );
        $user_id = $_SESSION['id'] ?? '';
		echo $user_id . $word . $meaning;
        if ( $word && $meaning && $user_id ) {
			$query = "INSERT INTO words (user_id, word, meaning) VALUES('{$user_id}','{$word}', '{$meaning}')";
			// print_r($query);
			// echo "hellow";
            mysqli_query( $connection, $query );
        }

        header( "location: words.php" );
    }
}
mysqli_close( $connection );
