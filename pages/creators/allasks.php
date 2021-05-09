<?php
// Début de la page allasks, récupération des données
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
                <h1>Toutes les demandes</h1>
                <p>Toutes les demandes</p>
            </div>
        </div>

        <!-- Affichage des demandes des utilisateurs -->
        <div class="row mt-3">
            <?php
            include("../../php/connect.php");
            try {
                $mysqli = mysqli_connect(SERVEUR, LOGIN, MDP, BDD);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $reponse = mysqli_query($mysqli, 'SELECT * FROM `asks`');
            while ($donnees = $reponse->fetch_array()) {
            ?>
                <div class="col-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                if ($donnees['stl_path'] == "") {
                                    echo '<img src="../../images/3DHUB_index_logo_simple_black.png"  class="card-img-top" alt="...">';
                                }
                                else {
                                    $chemin = $donnees["stl_path"];
                                    echo '<div style="width: 100%; height: 200px;" class="mb-3" id="',$chemin,'" ></div>';
                                }
                            ?>
                            
                            <h5 class="card-title"><?php echo $donnees['title']; ?></h5>
                            <p class="card-text"><?php echo $donnees['description']; ?></p>
                            <p class="text-muted">De : <?php echo $donnees['user']; ?></p>
                            <a href="./ask-info.php?id=<?php echo $donnees['id']; ?>" class="btn btn-primary">Découvrir</a>
                        </div>
                    </div>
                </div>
                <script src="../../stl/stl_viewer.min.js"></script>
                <script>
                    var stl_viewer = new StlViewer(
                        document.getElementById("<?php echo $donnees['stl_path']; ?>"), {
                            models: [{
                                id: 1,
                                filename: "../pages/creators/upload/<?php echo $donnees['stl_path']; ?>"
                            }]
                        }
                    );
                </script>
            <?php
            }

            $reponse->close(); // Termine le traitement de la requête

            ?>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>