<?php
    session_start();
    include("php/fonctions.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/ZanzibarSite.css" />
        <!--<script type="text/javascript" src="fonctions.js" ></script>-->
        <title>Zanzibar</title>

        <script>
            /**
             *
             */
            function maj_form_ajout_article() {
                var slct_articles = document.getElementById("slct_articles");
                var isSelectedArticleEmpty = slct_articles.options[slct_articles.selectedIndex].text == "";

                btn_edit.disabled = isSelectedArticleEmpty;
                btn_suppression.disabled = isSelectedArticleEmpty;

                // TODO Vider les champs du formulaire
                // TODO Libellé bouton Ajout / MAJ
            }
        </script>
    </head>
    <body>
        <div>
            <header></header>
        </div>
        <div id="banderole">
                <a href="index.html" class=banderole-link>Accueil</a>
                <a href="photos.html" class=banderole-link>Photos</a>
                <a href="contact.html" class=banderole-link>Contact</a>
                <a href="espPro.php" class=banderole-link>Espace Pro</a>
        </div>

        <div id="login" >
            <?php
                // Variable pour simplifier les traitements
                $logged= false;

                // Vérification de session
                if (session_status() != PHP_SESSION_NONE)
                {
                    $form_conn=
                        "<form name=\"Form_conn\" action=\"php/connexion.php\" method=\"post\">
                            <table>
                                <tr>
                                    <td><label>Identifiant</label></td>
                                    <td><input name=\"id\" type=\"text\" /></td>
                                </tr>
                                <tr>
                                    <td><label>Mot de passe</label></td>
                                    <td><input name=\"mdp\" type=\"password\" /></td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\"><button id=\"btn_conn\" type=\"submit\">Connexion</button></td>
                                </tr>
                            </table>
                        </form>";

                    if (isset($_SESSION['connexion']))
                    {
                        if ($_SESSION['connexion'])
                        {
                            $logged= true;

                            // Bouton de déconnexion
                            echo
                                "<form name=\"Form_deconn\" method=\"post\">",
                                "<button id=\"btn_deconn\">Déconnexion</button>",
                                "</form>";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST')
                            {
                                $logged= false;
                                deconnexion();
                            }
                        }
                        else
                        {
                            // Si on a une session mais pas la variable, c'est dû à un échec de connexion
                            echo "<label id=\"lbl_erreur\" style=\"color: red;\">Echec de connexion. Vérifiez vos identifiants.</label><br />";
                            echo $form_conn;
                        }
                    }
                    else
                    {
                        // Pas de session : on peut se log-in
                        echo $form_conn;
                    }
                }
            ?>

        </div>

        <?php
            if ($logged)
            {
                echo
                    "<div style=\"text-align: center;\">
                        <button id=\"ajout_article\" class=\"btn_espPro\" type=\"button\">Ajouter un nouvel article</button>
                        <button id=\"ajout_event\" class=\"btn_espPro\" type=\"button\">Ajouter un nouvel événement</button>
                        <button id=\"ajout_util\" class=\"btn_espPro\" type=\"button\">Ajouter un nouvel Administrateur</button>
                    </div>";
            }
        ?>

        <!-- TODO Après tests, générer en PHP -->
        <?php
            // Connexion, construction directe de la requête, exécution, récupération résultat
            $server= "localhost";
            $user= "root";
            $password= "";
            $base= "zanzibar";
            $con= mysqli_connect($server, $user, $password, $base);
            if (mysqli_connect_errno($con))
            {
                echo "<p style=\"color: #580000 ;\">Erreur de connexion : " . mysqli_connect_error() . "</p>";
                return;
            }

            $req= "SELECT * FROM articles ORDER BY Date DESC;";
            $res= mysqli_query($con, $req); // mysqli_query retourne un objet mysqli_result
        ?>
        <span style="text-align: center;">
            <div class="span_espPro">
                <?php
                    // FIXME
                    // ICI
                    // Gestion du mode Edition
                    $titleEdition= $contentEdition= "";
                    $texteBouton= "Ajout";

                    if (session_status() != PHP_SESSION_NONE)
                    {
                        if (isset($_SESSION['connexion']) AND isset($_SESSION['edition']))
                        {
                            if ($_SESSION['connexion'] AND $_SESSION['edition'] != "")
                            {
                                // Récupération de la combinaison Date - Titre
                                $full_title= $_SESSION['edition'];

                                // Découpage en deux variables
                                $resEdition= decoupage_full_title($full_title);
                                $date= $resEdition[0];
                                $title= $resEdition[1];

                                // Pour le titre, on l'a retraité dans le cas où il était trop long,
                                // il faut donc vérifier si on a un titre long,
                                // auquel cas il faut enlever les points de suspension
                                // TODO Titres à la con (juste "...", ...)...
                                $title= str_replace("...", "", $title);

                                // Récupération des données
                                $reqEdition=
                                "SELECT * FROM articles " .
                                "WHERE Date = '" . $date . "' AND Title LIKE '" . $title . "%';";
                                //echo $reqEdition;
                                //echo "<br />";
                                $resEdition= mysqli_query($con, $reqEdition);

                                // Remplissage des champs correspondant du formulaire :
                                // txtb_titre et ta_content
                                while ($rowEdition = mysqli_fetch_assoc($resEdition))
                                {
                                    $titleEdition= $rowEdition['Title'];
                                    $contentEdition= $rowEdition['Content'];
                                }

                                //echo "Titre à éditer : " . $titleEdition;
                                //echo "<br />";
                                //echo "Contenu à éditer : " . $contentEdition;
                                //echo "<br />";

                                // TODO Changement de libellé pour le bouton
                                $texteBouton= "Mise à jour";

                                // Traitement terminé, on unset la variable de session,
                                // pour éviter tout soucis (refresh, ...)
                                unset($_SESSION['edition']);

                                // Comme on a unset cet variable, ça devient compliqué de générer
                                // une requête UPDATE : on va donc créer une variable de session
                                // contenant une requête à finir de construire.
                                // On dispose toujours de titleEdition et contentEdition ici.
                                // Il suffira de remplacer SET.
                                // Cette variable permet aussi de savoir que nous sommes en mode Edition.
                                // TODO Image
                                $reqUpdate=
                                "UPDATE articles " .
                                "SET " .
                                "WHERE Title LIKE '" . str_replace("'", "''", $titleEdition) . "%' " .
                                "AND Content = '" . str_replace("'", "''", $contentEdition) . "';";

                                $_SESSION['rqtUpdate']= $reqUpdate;
                            }
                        }
                    }
                ?>
                <form action="php/form_article.php" method="post">
                    <label id="lbl_articles" style="text-align: center;">Articles</label><br />
                    <table>
                        <tr>
                            <td rowspan="2">
                                <select id="slct_articles" name="slct_articles" size="3" onchange="maj_form_ajout_article()">
                                    <option selected></option>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($res))
                                        {
                                            // Formatage de la date vers un format plus français
                                            $date_tmp= date_create($row["Date"]);
                                            $date= date_format($date_tmp, "d/m/Y");

                                            // Si le titre est trop long, on le crop
                                            $title= $row["Title"];
                                            $title= strlen($title) > 23 ? substr($title, 0, 20) . "..." : $title;

                                            // Le formatage est prêt à être intégré au select
                                            echo "<option>" . $date . " - " . $title . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <button id="btn_edit" name="btn_edit" disabled>Editer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id="btn_suppression" name="btn_suppression" disabled>Supprimer</button>
                            </td>
                        </tr>
                    </table>
                    <input type="text" name="txtb_titre" value="<?php echo $titleEdition; ?>"/>
                    <input type="text" name="txtb_upload"/><br />
                    <textarea name="ta_content" cols="50" rows="5"><?php echo $contentEdition; ?></textarea><br />
                    <button id="btn_ajout_maj" name="btn_ajout_maj" type="submit"><?php echo $texteBouton; ?></button>
                </form>
            </div>
        </span>

        <footer></footer>
    </body>
</html>
