<?php
switch($_GET['code'])
{
case '404':header('Location: ./error-404.php');
break;
default:header('Location: ./index.php');
}
?>