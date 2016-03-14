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
                if (isset($_POST["btn_modif_txt_accueil"]))
                {

                    // Récupération du contenu
					$txt= htmlspecialchars($_POST['ta_txt_accueil']);
					if (!(isset($txt)))
					{
						echo "<p style=\"color: red;\">Erreur d'affectation.</p>";
						return;
					}
					else if ($txt == "")
					{
						echo "<p style=\"color: red;\">Contenu vide !</p>";
						return;
					}

					setTexte($txt);
                }
            }
        }
    }

    // Redirection vers l'Espace Pro
    header('Location: ../espPro.php');
?>
