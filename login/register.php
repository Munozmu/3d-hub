<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Inscription</title>
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
        <h1>S'inscrire</h1>
        
        <?php
        include ("../php/connect.php");
        //si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
        if(isset($_POST['valider'])){
            //vérifie si tous les champs sont bien  pris en compte:
            //on peut combiner isset() pour valider plusieurs champs à la fois
            if(!isset($_POST['pseudo'],$_POST['mdp'],$_POST['mail'])){
                echo "Un des champs n'est pas reconnu.";
            } else {
                //on vérifie le contenu de tous les champs, savoir si ils sont correctement remplis avec les types de valeurs qu'on souhaitent qu'ils aient
                if(!preg_match("#^[a-z0-9]{1,15}$#",$_POST['pseudo'])){
                    //la preg_match définie: ^ et $ pour dire commence et termine par notre masque;
                    //notre masque défini a-z pour toutes les lettres en minuscules et 0-9 pour tous les chiffres;
                    //d'une longueur de 1 min et 15 max
                    echo "Le pseudo est incorrect, doit contenir seulement des lettres minuscules et/ou des chiffres, d'une longueur minimum de 1 caractère et de 15 maximum.";
                    //Il est préférable que le pseudo soit en lettres minuscules ceci afin d'être unique, par exemple si le choix peut être avec majuscule, deux membres pourrait avoir le même pseudo, par exemple Admin et admin et ce n'est pas ce que l'on veut.
                } else {
                    //on vérifie le mot de passe:
                    if(strlen($_POST['mdp'])<5 or strlen($_POST['mdp'])>15){
                        echo "
                        <div class=\"alert alert-danger\" role=\"alert\">
                          Le mot de passe doit contenir entre 5 et 15 caractères max.
                        </div>
                        ";
                    } else {
                        //on vérifie que l'adresse est correcte:
                        if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,30}$#i",$_POST['mail'])){
                            //cette preg_match est un petit peu complexe, je vous invite à regarder l'explication détaillée sur mon site c2script.com
                            echo "
                            <div class=\"alert alert-danger\" role=\"alert\">
                              L'adresse mail est incorrecte.
                            </div>";
                            //normalement l'input type="email" vérifie que l'adresse mail soit correcte avant d'envoyer le formulaire mais il faut toujours être prudent et vérifier côté serveur (ici) avant de valider définitivement
                        } else {
                            if(strlen($_POST['mail'])<7 or strlen($_POST['mail'])>50){
                                echo "
                                <div class=\"alert alert-danger\" role=\"alert\">
                                  Le mail doit être d'une longueur minimum de 7 caractères et de 50 maximum.
                                </div>";
                            } else {
                                //tout est précisés correctement, on inscrit le membre dans la base de données si le pseudo n'est pas déjà utilisé par un autre utilisateur
                                //d'abord il faut créer une connexion à la base de données dans laquelle on souhaite l'insérer:
                                $mysqli=mysqli_connect(SERVEUR,LOGIN,MDP,BDD);//'serveur','nom d'utilisateur','pass','nom de la base'
                                if(!$mysqli) {
                                    echo "
                                    <div class=\"alert alert-danger\" role=\"alert\">
                                    Erreur de connexion à la BDD.
                                    </div>
                                    ";
                                    //Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
                                    echo "<br>Erreur retournée: ".mysqli_error($mysqli);
                                } else {
                                    $Pseudo=htmlentities($_POST['pseudo'],ENT_QUOTES,"UTF-8");//htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
                                    $Mdp=md5($_POST['mdp']);// la fonction md5() convertie une chaine de caractères en chaine de 32 caractères d'après un algorithme PHP, cf doc
                                    $Mail=htmlentities($_POST['mail'],ENT_QUOTES,"UTF-8");
                                    if(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='$Pseudo'"))!=0){//si mysqli_num_rows retourne pas 0
                                        echo "
                                        <div class=\"alert alert-danger\" role=\"alert\">
                                        Ce pseudo est déjà utilisé par un autre membre, veuillez en choisir un autre svp.
                                        </div>";
                                    } else {
                                        //insertion du membre dans la base de données:
                                        if(mysqli_query($mysqli,"INSERT INTO membres SET pseudo='$Pseudo', mdp='$Mdp', mail='$Mail'")){
                                            echo "
                                            <div class=\"alert alert-success\" role=\"alert\">
                                              Inscrit avec succès! Vous pouvez vous connecter: <a href='./login.php'>Cliquez ici</a>.
                                            </div>
                                            ";
                                            $TraitementFini=true;//pour cacher le formulaire
                                        } else {
                                            echo "
                                            <div class=\"alert alert-danger\" role=\"alert\">
                                            Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.
                                            </div>";
                                            //echo "<br>Erreur retournée: ".mysqli_error($mysqli);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
            ?>

        <form method="post" action="register.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pseudo</label>
            <input type="text" name="pseudo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adresse Email</label>
            <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
            <input type="password" name="mdp" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" name="valider" class="btn btn-primary">S'inscrire</button>
          <a type="button" class="btn btn-outline-primary" href="login.php">Se connecter</a>
        </form>
      </div>
      <div class="col-3"></div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>

</body>

</html>