<?php
    session_start();
    include("php/fonctions.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/ZanzibarSite.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>	
		<script type="text/javascript" src="javascript/texte.js"></script>
        <title>Zanzibar</title>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
                fjs.parentNode.insertBefore(js, fjs);
            }
            (document, 'script', 'facebook-jssdk'));

            function numCols() {
                var width = parseInt(((window.innerWidth * 0.85 * 0.60 * 0.50) / 5).toString());
                var nbContent = 0;
                while (document.getElementById("ta_content" + nbContent) != null) {
                    var ta_content = document.getElementById("ta_content" + nbContent);
                    ta_content.setAttribute("cols", width);
                    nbContent++;
                }
            }
        </script>

        <div>
            <header></header>
        </div>

        <div id='banderole'>
            <a href="index.php" class=banderole-link>Accueil</a>
            <a href="photos.php" class=banderole-link>Photos</a>
            <a href="contact.php" class=banderole-link>Contact</a>
            <a href="espPro.php" class=banderole-link>Espace Pro</a>
        </div>

		<div id="txtAccueil"></div>
		<script>		
			loadTxtFile('Texte/txtAccueil.txt');
		</script> 
        <div>
            <img id="img_grp" src="Images/Zanzibar_Color.jpg" />
        </div>

        <div>
            <span>
                <?php
                    // Connexion à la base de données
                    $con= connexion();

                    // Construction de la requête pour remonter les articles
                    $req= "SELECT * FROM articles ORDER BY Date DESC;";

                    // Exécution de la requête
                    if (!($res= mysqli_query($con, $req)))
                    {
                        echo "<p style=\"color: red;\">La requête SELECT a échoué.</p>";
                        return;
                    }

                    // Parcours des résultats
                    $nbArticles = 0;
                    while ($row = mysqli_fetch_assoc($res))
                    {
                        // Récupération de toutes les informations
                        $date= $row['Date'];
                        $title= $row['Title'];
                        $content= $row['Content'];
                        $picture= $row['Picture'];
                        $author= $row['Author'];

                        // Formatage de la date
                        $date= date_create($date);
                        $date= date_format($date,"d/m/Y");

                        // Image par défaut si besoin
                        if ($picture == "")
                        {
                            $picture= "Zanzibar-Z-Logo.png";
                        }

                        // Génération des objets HTML
                        echo
                            "<section style=\"height: auto; margin-bottom: 15px;\">
                                <div id=\"img_article\">
                                    <img src='Images/" . $picture . "' />
                                </div>
                                <article>
                                    <h1>" . $title . "</h1>
                                    <p>Publié le " . $date . " par " . $author . "</p>
                                    <textarea ID=\"ta_content" . $nbArticles . "\" class=\"TextArea\" cols=\"75\" rows=\"10\">" . $content . "</textarea>
                                </article>
                            </section>";
                    }
                ?>
            </span>

            <span id="FB_Cal">
                <span id="Facebook" >
                    <!-- Facebook -->
                    <div class="fb-page" data-href="https://www.facebook.com/zanzibarchanson" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <div class="fb-xfbml-parse-ignore">
                            <blockquote cite="https://www.facebook.com/zanzibarchanson">
                                <a href="https://www.facebook.com/zanzibarchanson">Facebook</a>
                            </blockquote>
                        </div>
                    </div>
                </span>

                <span id="Calendrier" >
                    <div>
                        <h1>Calendrier</h1>
                    </div>
                </span>
            </span>
        </div>

        <script>
            numCols();
        </script>

        <footer><?php echo copyright(); ?></footer>
    </body>
</html>
