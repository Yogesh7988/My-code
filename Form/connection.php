<?php
$server="localhost";
$username="root123";
$password="root123";
$db="form";

//create a connection
$conn=mysqli_connect($server,$username,$password,$db);

//Check connection
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error() );
}
// echo "Connected Successfully";

if(!$_SESSION['loggedInUser']){
    header('Location: login.php');
}


?>