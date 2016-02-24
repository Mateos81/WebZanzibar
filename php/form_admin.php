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

                if (isset($_POST["btn_ajout_admin"]))
                {
                    // Vérification du login et des mots de passe
                    $login= trim(htmlspecialchars($_POST['txtb_login']));
                    $mdp1= trim(htmlspecialchars($_POST['txtb_mdp1']));
                    $mdp2= trim(htmlspecialchars($_POST['txtb_mdp2']));

                    if ($login == "" || $mdp1 == "" || $mdp1 != $mdp2)
                    {
                        $_SESSION['ajout_util_succes']= "mdp";
                    }
                    else
                    {
                        // Vérification de l'unicité du login voulu
                        $req= "SELECT login FROM users WHERE login = '" . $login . "';";
                        $res= mysqli_num_rows(mysqli_query($con, $req));

                        if ($res != 0)
                        {
                            $_SESSION['ajout_util_succes']= "login";
                        }
                        else
                        {
                            // Ajout
                            $req= "INSERT INTO users VALUES('" . $login . "', '" . $mdp1 . "');";
                            $res= mysqli_query($con, $req);

                            if (!$res)
                            {
                                echo "<p style=\"color: red;\">Echec de l'insertion d'un nouvel admin.</p>";
                                return;
                            }

                            $_SESSION['ajout_util_succes']= "ok";
                        }
                    }
                }
            }
        }
    }

    // Redirection vers l'Espace Pro
    header('Location: ../espPro.php');
?>
