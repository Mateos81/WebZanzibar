<?php
    session_start();
    include("fonctions.php");

    // Sert pour les textes affichés en rouge, s'il y a des accents...
    echo
        "<head>
            <meta charset=\"utf-8\" />
        </head>";
        
    // Vérification de la session
    if (session_status() != PHP_SESSION_NONE)
    {
        if (isset($_SESSION['connexion']))
        {
            if ($_SESSION['connexion'])
            {
                // Connexion à la base de données
                $server= "localhost";
                $user= "root";
                $password= "";
                $base= "zanzibar";
                $con= mysqli_connect($server, $user, $password, $base);
                if (mysqli_connect_errno($con))
                {
                    echo "<p style=\"color: red;\">Erreur de connexion : " . mysqli_connect_error() . "</p>";
                    return;
                }

                /*
                 * Split des actions selon quel bouton a été préssé
                 */
                if (isset($_POST["btn_ajout_maj"]))
                {
                    //echo "Button btn_ajout_maj pressed.";
                    
                    // TODO Check le texte du bouton, pour savoir s'il s'agit d'un ajout ou d'une MAJ
                    
                    // Récupération du titre, du contenu, et si besoin de l'image
                    $title= htmlspecialchars($_POST['txtb_titre']);
                    // TODO Image
                    $content= htmlspecialchars($_POST['ta_content']);
                    if (!(isset($title) AND isset($content)))
                    {
                        echo "<p style=\"color: red;\">Au moins le titre et du contenu sont attendus.</p>";
                        return;
                    }
                    else if ($title == "" OR $content == "")
                    {
                        echo "<p style=\"color: red;\">Au moins le titre et du contenu sont attendus.</p>";
                        return;
                    }

                    // Formatage de la requête d'ajout
                    // TODO Formatage conditionnel (avec ou sans IMG)
                    $req=
                    "INSERT INTO articles(Date, Title, Content, Author) " .
                    "VALUES(NOW(), '" . $title . "', '" . $content . "', '" . $_SESSION['author'] . "');";
                    //echo $req;

                    // Exécution de la requête
                    if (!mysqli_query($con, $req))
                    {
                        echo  "<p style=\"color: red;\">La requête INSERT a échoué.</p>";
                        return;
                    }
                }
                else if (isset($_POST["btn_edit"]))
                {
                    //echo "Button btn_edit pressed.";
                    
                    // Création d'un objet session spécifique à espPro.php
                    $_SESSION['edition']= htmlspecialchars($_POST['slct_articles']);
                    
                    /*
                        // Récupération de la valeur sélectionnée dans le TextArea
                        // afin de construire une requête SELECT
                        
                        // Construction & exécution de la requête
                        
                        // Envoi des infos à la page principale...
                    */
                }
                else if (isset($_POST["btn_suppression"]))
                {
                    //echo "Button btn_suppression pressed.";
                    
                    // Découpage du titre pour construire la requête
                    $full_title= htmlspecialchars($_POST['slct_articles']);
                    $res = decoupage_full_title($full_title);
                    $date= $res[0];
                    $title= $res[1];
                    
                    // Construction de la requête de suppression
                    // TODO Plutôt utiliser un flag booléen en cas de piratage ? DELETE -> UPDATE
                    $req= "DELETE FROM articles WHERE Date = '" . $date . "' AND Title LIKE '" . $title . "*';";
                    echo $req;
                    
                    // Exécution de la requête
                    if (!mysqli_query($con, $req))
                    {
                       echo "<p style=\"color: red;\">La requête DELETE a échoué.</p>";
                       return;
                    }
                }
            }
        }
    }

    // Redirection vers l'Espace Pro
    header('Location: ../espPro.php');
?>
