<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>


<body>
<?php
if( !isset( $_COOKIE['3dhub'] ) )
{
	$cookie_name = "3dhub";
	$cookie_value = "bandeau";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
 

  // affichage ici
  echo '<a href="https://borde-basse.mon-ent-occitanie.fr">Cliquez sur ce lien pour aller sur l ENT du lycée</a>';
}
?>
le corps du doc


</body>

</html>