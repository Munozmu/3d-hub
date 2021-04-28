<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

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

<?php
if (!isset($_COOKIE['3DHUB'])) {
  $cookie_name = "3DHUB";
  $cookie_value = "bandeau";
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

  echo   '<div class="alert alert-primary" role="alert">Nous utilisons des cookies pour le bon fonctionnement du site. <a target="_blank" class="ensavoirplus" href="legals/Mentions légales.pdf">En savoir plus</a></div>';

}
?>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">3DHUB</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Accueil
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login/login.php">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login/register.php">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./legals/legals_mentions.pdf">Mentions légales</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Full Page Image Header with Vertically Centered Content -->
  <header class="masthead text-white">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12 text-center">
          <h1 class="font-weight-light">Vertically Centered Masthead Content</h1>
          <p class="lead">A great starter layout for a landing page</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <section class="py-5">
    <div class="container">
      <h2 class="font-weight-light">Page Content</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat reprehenderit expedita.</p>
    </div>
  </section>


  <style>
    .masthead {
      height: 100vh;
      min-height: 500px;
      background-image: url('https://www.reviewbox.fr/wp-content/uploads/2020/06/0-Impresora-3d-92230252_m.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>