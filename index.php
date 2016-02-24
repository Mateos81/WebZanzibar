<?php
    session_start();
    include("php/fonctions.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/ZanzibarSite.css" />
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
        </script>
    
        <div>
            <header></header>
        </div>

        <div id='banderole'>
                <a href="index.php" class=banderole-link>Accueil</a>
                <a href="photos.html" class=banderole-link>Photos</a>
                <a href="contact.html" class=banderole-link>Contact</a>
                <a href="espPro.php" class=banderole-link>Espace Pro</a>
        </div>

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
                            $picture= "Images/Zanzibar-Z-Logo.png";
                        }
                        
                        // Génération des objets HTML
                        echo
                            "<section style=\"margin-bottom: 15px;\">
                                <div id=\"img_article\">
                                    <img src=\"" . $picture . "\" />
                                </div>
                                <article>
                                    <h1>" . $title . "</h1>
                                    <p>Publié le " . $date . " par " . $author . "</p>
                                    <p>" . $content . "</p>
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
                    <!-- Calendrier -->
                    <div>
                        <h1>Calendrier</h1>
                    </div>
                </span>
            </span>
        </div>

        <footer></footer>
    </body>
</html>
