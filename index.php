<!doctype html>
<html lang="fr">
<link rel="stylesheet" href="main.css" />
<!--Nom du fichier CSS à joindre-->

<head>

  <link rel="icon" href="images/icon.png" />
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>3DHUB</title>

  <head>
    <!--<link rel="stylesheet" media="screen" href="css/style.css" />-->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {

        //au chargement de la page je règle le marginTop de #barre à 0 (il etait fixé à -50px dans le css) en 500ms

        $('#barre').animate({
          marginTop: "0",
        }, 500);

        //au clic sur #fermer qui est la croix j'anime le marginTop de #barre à -30px pour le faire remonter et laisser le border bottom apparent

        $("#fermer").mousedown(function() {

          $('#barre').animate({
            marginTop: "-5%",
          }, 500);

        });
      });
    </script>
  </head>

  </div>


<body>

  <?php
  if (!isset($_COOKIE['3DHUB'])) {
    $cookie_name = "3DHUB";
    $cookie_value = "bandeau";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");


    echo   '<div id="barre">Nous utilisons des cookies pour le bon fonctionnement du site. <a target="_blank" class="ensavoirplus" href="legals/Mentions légales.pdf">En savoir plus</a> <div id="fermer"></div> </div>';
  }
  ?>
  <div class="accueil">
    <a class="hypertext" href="index.php">Accueil</a>&nbsp;&nbsp;
    <a class="hypertext" href="login/login.php">Se connecter</a>&nbsp;&nbsp;
    <a class="hypertext" href="login/register.php">S'inscrire</a>
  </div>
  <h1 class="titre"><a class="HUB" href="index.php">3DHUB</a></h1>

  <div class="question">Que recherchez vous ?</div>
  <div class="proposition1">Je veux proposer mes<br>services d'impressions</div>
  <div class="proposition2">Je cherche à imprimer une<br>pièce spécifique</div>
  <div class="bouton1"><a class="btn btn-primary" href="./login/register.php">Proposer mes services</a></div>
  <div class="bouton2"><a class="btn btn-primary" href="./login/register.php">Faire une demande</a></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>