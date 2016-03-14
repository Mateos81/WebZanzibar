<?php
    // On rajoute le nom du fichier dans le fichier XML
    $file = "../Texte/txtAccueil.txt";

    $handle = fopen($file, "r");
    $contenu = fread($handle, filesize($file));
    fclose($handle);

    echo $contenu;
?>
