<?php
include("../../php/connect.php");

$db = mysqli_connect(SERVEUR, LOGIN, MDP, BDD);

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_GET['id']; // get id through query string

$del = mysqli_query($db, 'DELETE FROM `E15`.`asks` WHERE ID = "' . $id . '"');


if($del)
{
    mysqli_close($db); // Close connection
    header("location:masks.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>