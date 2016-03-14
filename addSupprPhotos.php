<?php
    session_start();
    include("php/fonctions.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/ZanzibarSite.css" />
        <script type="text/javascript" src="javascript/photos.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <title>Zanzibar</title>
    </head>
    <body>

        <div>
            <header></header>
        </div>

        <div id='banderole'>
            <a href="index.php" class=banderole-link>Accueil </a>
            <a href="photos.php" class=banderole-link>Photos</a>
            <a href="contact.php" class=banderole-link>Contact</a>
            <a href="espPro.php" class=banderole-link>Espace Pro</a>
        </div>

        <div id="ajoutImg">
            <form method="POST" action="php/upload.php" enctype="multipart/form-data">
                 <!-- On limite le fichier à 1Mo -->
                 <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                 Fichier : <input type="file" name="openFileDialog">
                 <input type="submit" name="envoyer" value="Envoyer le fichier">
            </form>
        </div>

        <script>loadXMLDocTable('xml/images.xml');</script>

        <div id="slideshow2"></div>

        <button onclick="supprImgs()">Supprimer</button>

        <footer><?php echo copyright(); ?></footer>
    </body>
</html>
