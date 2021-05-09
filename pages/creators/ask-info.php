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

$id = $_GET['id']; // on récupère les données dans l'url

$response = mysqli_query($mysqli, 'SELECT * FROM `asks` WHERE ID = "' . $id . '" ');
$donnees = mysqli_fetch_assoc($response);

$bestPropositon = mysqli_fetch_assoc(mysqli_query($mysqli, 'SELECT * FROM `proposition` ORDER BY valu' ));
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
    <div class="container">
        <nav aria-label="breadcrumb" class="mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home.php">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $donnees['title']; ?></li>
            </ol>
        </nav>
        <div class="row mt-5">
            <div class="col-12">
                <h1><?php echo $donnees['title']; ?></h1>
                <small>Par : <?php echo $donnees['user']; ?> </small>
                <hr>
            </div>
            <div class="col-12">
                <h4>Description :</h4>
                <p class="m-5"><?php echo $donnees['description']; ?></p>
            </div>
        </div>

        <!-- Affichage de la pièce -->
        <div class="row">
            <div class="col-12">
                <h4>Pièce :</h4>
                <div id="test" style="margin-top: 10px; height: 500px; border: 1px gray solid;" class="m-3"></div>
                <p><?php echo $donnees['stl_path']; ?></p>
                <a href="../../stl/stl/trepied.STL"><button type="button" class="btn btn-primary">Télécharger le .STL de la pièce</button></a>

            </div>
        </div>

        <!-- Affichage de la meilleure proposition -->
        <div class="row mt-5">
            <div class="col-12">
                <h2>Meilleure proposition :</h2>
                <h1><?php echo $bestPropositon['valu']; ?> €</h1>
                <small>Par : <?php echo $bestPropositon['member']; ?></small>
                 
            </div>
        </div>

        <!-- Faire une nouvelle demande -->
        <div class="row">
            <div class="col-12">
                <div class="row mt-5">
                    <div class="col-6">
                        <form method="POST" enctype="multipart/form-data">
                        <p class="text-danger">Attention ! Votre proposition doit être inférieure à celle en cours.</p>
                            <div class="input-group mb-3">
                                <input type="text" name="price_value" class="form-control" placeholder="Prix proposé" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">€</span>
                            </div>
                            <input type="submit" name="envoyer" value="Faire la proposition">
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_POST['price_value'])) {

                    //  reste
                    $mysqli = new mysqli(SERVEUR, LOGIN, MDP, BDD);
                    $mysqli->set_charset("utf8");
                    $requete = 'INSERT INTO `proposition` (`id`, `id_ask`, `valu`, `member`) VALUES (NULL, "' . $id . '", "' . $_POST['price_value'] . '", "' . $Pseudo . '");';
                    $resultat = $mysqli->query($requete);
                    if ($resultat)
                        echo '<p class="text-success">La proposition a été ajoutée</p>';
                    else
                        echo "<p>Erreur</p>";
                }
                ?>
            </div>
        </div>

        <!-- Affichage des propositions existantes pour cette demande -->
        <div class="row">
            <div class="col-12">
                
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
                    $reponse = mysqli_query($mysqli, 'SELECT * FROM `proposition` WHERE id_ask = "' . $id . '" ORDER BY valu');
                    // On affiche chaque entrée une à une
                    while ($donnees = $reponse->fetch_array()) {
                    ?>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">Proposition : <?php echo $donnees['valu']; ?> €</div>
                                    <div class="col-6"> Par : <?php echo $donnees['member']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    $reponse->close(); // Termine le traitement de la requête

                    ?>
                </div>
            </div>
            <div class="row" style="height: 200px;"></div>
        </div>




        <script src="../../stl/stl_viewer.min.js"></script>
                <script>
                    var stl_viewer = new StlViewer(
                        document.getElementById("test"), {
                            models: [{
                                id: 1,
                                filename: "../pages/creators/upload/<?php echo $donnees['stl_path']; ?>"
                            }]
                        }
                    );
                </script>
</body>
</html>
</div>
</div>
</div>
</body>