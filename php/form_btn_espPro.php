<?php
    session_start();

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
                /*
                 * Split des actions selon quel bouton a été préssé
                 */
                if (isset($_POST["ajout_article"]))
                {
                    $_SESSION['ajout_article']= true;
                }
                else if (isset($_POST["ajout_util"]))
                {
                    $_SESSION['ajout_util']= true;
                }
            }
        }
    }

    header('Location: ../espPro.php');
?>
