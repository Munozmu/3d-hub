<?php
    /*************************
    *  Page: connexion.php
    *  Page encodée en UTF-8
    **************************/
session_start();//session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le pseudo en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le pseudo soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici
?>
<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Connexion</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">3DHUB</a>
    </div>
  </nav>

  <div class="container">
    <div class="row mt-5">
      <div class="col-3"></div>
      <div class="col-6">
        <h3>Bienvenue sur 3DHUB</h3>
        <h1>Se connecter</h1>

        <?php
        include ("../php/connect.php");
        //si une session est déjà "isset" avec ce visiteur, on l'informe:
        if(isset($_SESSION['pseudo'])){
            echo "Vous êtes déjà connecté, vous pouvez accéder à l'espace membre en <a href='../pages/creators/home.php'>cliquant ici</a>.";
        } else {
            //si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
            if(isset($_POST['valider'])){
                //vérifie si tous les champs sont bien pris en compte:
                if(!isset($_POST['pseudo'],$_POST['mdp'])){
                    echo "Un des champs n'est pas reconnu.";
                } else {
                    //tous les champs sont précisés, on regarde si le membre est inscrit dans la bdd:
                    //d'abord il faut créer une connexion à la base de données dans laquelle on souhaite regarder:
                    $mysqli=mysqli_connect(SERVEUR,LOGIN,MDP,BDD);//'serveur','nom d'utilisateur','pass','nom de la base'
                    if(!$mysqli) {
                        echo "Erreur connexion BDD";
                        //Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
                        //echo "<br>Erreur retournée: ".mysqli_error($mysqli);
                    } else {
                        //on défini nos variables:
                        $Pseudo=htmlentities($_POST['pseudo'],ENT_QUOTES,"UTF-8");//htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
                        $Mdp=md5($_POST['mdp']);
                        $req=mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='$Pseudo' AND mdp='$Mdp'");
                        //on regarde si le membre est inscrit dans la bdd:
                        if(mysqli_num_rows($req)!=1){
                            echo "Pseudo ou mot de passe incorrect.";
                        } else {
                            //pseudo et mot de passe sont trouvé sur une même colonne, on ouvre une session:
                            $_SESSION['pseudo']=$Pseudo;
                            echo "
                            <div class=\"alert alert-success\" role=\"alert\">
                            Vous êtes connecté avec succès $Pseudo! Vous pouvez accéder à l'espace membre en <a href='../pages/creators/home.php'>cliquant ici</a>.
                            </div>";
                            $TraitementFini=true;//pour cacher le formulaire
                        }
                    }
                }
            }
            if(!isset($TraitementFini)){//quand le membre sera connecté, on définira cette variable afin de cacher le formulaire
                ?>

        <form method="post" action="login.php">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="pseudo" aria-describedby="emailHelp" required>

          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" name="mdp" id="exampleInputPassword1" required>
          </div>
          <button type="submit" name="valider" class="btn btn-primary">Se connecter</button>
          <a type="button" class="btn btn-outline-primary" href="register.php">S'incrire</a>
        </form>
      </div>
      <div class="col-3"></div>
    </div>
    <?php
            }
        }
        ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>

</body>

</html>