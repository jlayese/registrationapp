<?php // to destroy all the sessions and redirecting to home page
session_start();
if(session_destroy()) // Destroying All Sessions
{
	header("Location: index.php"); //Redirecting To Home Page
}
?>
