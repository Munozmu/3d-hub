<?php

/*************************
 *  Page: masks.php
 *  Page encodée en UTF-8
 **************************/
include("../../php/connect.php");
session_start(); //session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le pseudo en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le pseudo soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici
if (!isset($_SESSION['pseudo'])) {
    header("Refresh: 5; url=../../login/login.php"); //redirection vers le formulaire de connexion dans 5 secondes
    echo "Vous devez vous connecter pour accéder à l'espace membre.<br><br><i>Redirection en cours, vers la page de connexion...</i>";
    exit(0); //on arrête l'éxécution du reste de la page avec exit, si le membre n'est pas connecté
}
$Pseudo = $_SESSION['pseudo']; //on défini la variable $Pseudo (Plus simple à écrire que $_SESSION['pseudo']) pour pouvoir l'utiliser plus bas dans la page
//on se connecte une fois pour toutes les actions possible de cette page:
$mysqli = mysqli_connect(SERVEUR, LOGIN, MDP, BDD); //'serveur','nom d'utilisateur','pass','nom de la base'
if (!$mysqli) {
    echo "Erreur connexion BDD";
    //Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
    //echo "<br>Erreur retournée: ".mysqli_error($mysqli);
    exit(0);
}
//on récupère les infos du membre si on souhaite les afficher dans la page:
$req = mysqli_query($mysqli, "SELECT * FROM membres WHERE pseudo='$Pseudo'");
$info = mysqli_fetch_assoc($req);
?>

<!doctype html>
<html lang="fr">

<head>
    <link rel="icon" href="../../images/icon.png" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>3DHUB</title>
</head>

<body>
    <?php include("./components/header.php"); ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <h1>Mes demandes</h1>
                <p>Vos demandes</p>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Faire une nouvelle demande
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Faire une nouvelle demande</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Titre de la demande</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Description</label>
                                        <textarea class="form-control" type="text" name="descr" placeholder="Entrez une decription" id="floatingTextarea2" style="height: 100px"></textarea>
                                    </div>

                                    <!-- envoi fichier -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000000000000000000">
                                    Fichier : <input type="file" name="image">
                                    <p class="text-danger">Uniquement des .stl ou je te démarre</p>

                                    <input type="submit" name="envoyer" value="Envoyer le fichier">
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p>
            <?php
            if (isset($_POST['title'])) {
                if (isset($_FILES['image'])) {
                    // Upload fichier
                    $dossier = 'upload/';
                    $fichier = basename($_FILES['image']['name']);
                    $taille_maxi = 100000000000;
                    $taille = filesize($_FILES['image']['tmp_name']);
                    $extensions = array('.stl', '.STL');
                    $extension = strrchr($_FILES['image']['name'], '.');
                    //Début des vérifications de sécurité...
                    if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                    {
                        $erreur = 'Vous devez uploader un fichier de type .stl';
                    }
                    if ($taille > $taille_maxi) {
                        $erreur = 'Le fichier est trop gros...';
                    }
                    if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                    {
                        //On formate le nom du fichier ici...
                        $fichier = strtr(
                            $fichier,
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
                        );
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                        {
                            echo 'Upload effectué avec succès !';
                        } else //Sinon (la fonction renvoie FALSE).
                        {
                            echo 'Echec de l\'upload !';
                        }
                    } else {
                        echo $erreur;
                    }
                    //  reste
                    $mysqli = new mysqli(SERVEUR, LOGIN, MDP, BDD);
                    $mysqli->set_charset("utf8");
                    $requete = 'INSERT INTO `asks` (`id`, `title`, `description`, `user`, `stl_path`) VALUES (NULL, "' . $_POST['title'] . '", "' . $_POST['descr'] . '", "' . $Pseudo . '","' . $fichier . '");';
                    $resultat = $mysqli->query($requete);
                    if ($resultat)
                        echo "<p>La demande a été ajoutée</p>";
                    else
                        echo "<p>Erreur</p>";
                }
            }
            ?>
            <?php
            if (isset($_POST['requetSQL'])) {
                $mysqli = new mysqli(SERVEUR, LOGIN, MDP, BDD);
                $mysqli->set_charset("utf8");
                $requete = '"' . $_POST['title'] . '";';
                $resultat = $mysqli->query($requete);
                if ($resultat)
                    echo "<p>La demande a été ajoutée</p>";
                else
                    echo "<p>Erreur</p>";
            }
            ?>
        </p>

        <!-- Affichage des demandes de l'utilisateur -->
        <div class="row mt-3">
            <?php
            include("../../php/connect.php");
            try {
                // On se connecte à MySQL
                $mysqli = mysqli_connect(SERVEUR, LOGIN, MDP, BDD);
            } catch (Exception $e) {
                // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : ' . $e->getMessage());
            }

            // Si tout va bien, on peut continuer

            // On récupère tout le contenu de la table asks où l'utilisateur est le même
            $reponse = mysqli_query($mysqli, 'SELECT * FROM `asks` WHERE USER = "' . $Pseudo . '"');
            //$reponse = $bdd->query('SELECT * FROM `asks` WHERE USER = "' . $Pseudo . '"');

            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch_array()) {
            ?>
                <div class="col-3 mt-3">
                    <div class="card">
                        <img src="./upload/<?php echo $donnees['stl_path']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $donnees['title']; ?></h5>
                            <p class="card-text"><?php echo $donnees['description']; ?></p>
                            <p class="text-muted">De : <?php echo $donnees['user']; ?></p>
                            <a href="./ask-info.php?id=<?php echo $donnees['id']; ?>" class="btn btn-primary">Découvrir</a>
                            <a class="btn btn-danger" href="./delete.php?id=<?php echo $donnees['id']; ?>">Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php
            }

            $reponse->close(); // Termine le traitement de la requête

            ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>