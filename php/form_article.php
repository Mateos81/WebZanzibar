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
                $con= connexion();

                /*
                 * Split des actions selon quel bouton a été préssé
                 */
                if (isset($_POST["btn_ajout_maj"]))
                {
                    //echo "Button btn_ajout_maj pressed.";

                    // Si $_SESSION['rqtUpdate'] est défini, c'est une MAJ, sinon une ajout
                    if (!isset($_SESSION['rqtUpdate']))
                    {
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
                            echo "<p style=\"color: red;\">La requête INSERT a échoué.</p>";
                            return;
                        }
                    }
                    else
                    {
                        // Récupération et complétion de la requête de MAJ
                        $req= $_SESSION['rqtUpdate'];

                        // Récupération des nouveaux titre, contenu, et si besoin image
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

                        $clauseSet=
                        "SET Title = '" . str_replace("'", "''", $title) . "', ".
                        "Content = '" . str_replace("'", "''", $content) . "'";

                        $req= str_replace("SET", $clauseSet, $req);

                        echo $req . "<br />";

                        // Exécution de la requête
                        if (!mysqli_query($con, $req))
                        {
                            echo "<p style=\"color: red;\">La requête UPDATE a échoué.</p>";
                            return;
                        }

                        // Nettoyage
                        unset($_SESSION['rqtUpdate']);
                    }
                }
                else if (isset($_POST["btn_edit"]))
                {
                    //echo "Button btn_edit pressed.";

                    // Création d'un objet session spécifique pour espPro.php
                    $_SESSION['edition']= htmlspecialchars($_POST['slct_articles']);

                    if (!isset($_SESSION['edition']) OR $_SESSION['edition'] == "")
                    {
                        echo "<p style=\"color: red;\">La création de SESSION['edition'] a échoué.</p>";
                        return;
                    }

                    //echo $_SESSION['edition'];

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
