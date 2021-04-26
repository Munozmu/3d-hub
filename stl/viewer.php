<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mes fichiers STL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div class="container-fluid">
    <h1>Nos STL</h1>
    <p>En téléchargement</p>
    <p>Partie du site en construction ! Merci ;)</p>
    <div class="row">
        <?php
        // Boucle qui parse les STL présents dans le dossier
        $js = "<script>";
        $html = "";
        $i = 1;
        $di = new RecursiveDirectoryIterator('../../stl/');
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
            if (preg_match('~.(stl|STL)$~', $filename)) {
                $html .= '<div class="col-sm-3">';
                $html .= '<a href="' . $filename . '"><button type="button" class="btn btn-primary">' . $file->getFilename() . '</button></a>';
                $html .= '<div id="' . $filename . '" style="margin-top: 10px;"></div></div>';
                $js .= 'var stl_viewer= new StlViewer ( 
                document.getElementById("' . $filename . '"), 
                { models: [{
                    id:' . $i . ', 
                    filename:"' . str_replace('../../stl/','', $filename) . '"
                    }]
                }
                );';
                $i++;
            }
        }
        echo $html;
        ?>
    </div>
</div>
<script src="../../stl/stl_viewer.min.js"></script>
<?php echo $js . "</script>"; ?>
<!-- RTFM, Doc du plugin : https://www.viewstl.com/plugin/-->
</body>
</html>