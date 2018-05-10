<?php
//unset the session variables and logout the user
session_start();
if(session_destroy())
{
header("Location: login.php");
}
?>