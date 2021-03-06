<?php
    session_start();
    include("php/fonctions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/ZanzibarSite.css"/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
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
			<a href="photos.php" class=banderole-link>Photos</a>
			<a href="contact.php" class=banderole-link>Contact</a>
			<a href="espPro.php" class=banderole-link>Espace Pro</a>
		</div>

        <!--
        <div>
            <article style="text-align: center; width: 100%;">
                Retrouvez-nous sur Facebook : <a href="https://www.facebook.com/zanzibarchanson">https://www.facebook.com/zanzibarchanson</a>
            </article>
        </div>
        -->

        <span style="text-align: center; width: 100%;">
            <span id="Facebook" style="text-align: center; width: 100%;">
                <div class="fb-page" data-href="https://www.facebook.com/zanzibarchanson" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/zanzibarchanson">
                            <a href="https://www.facebook.com/zanzibarchanson">Facebook</a>
                        </blockquote>
                    </div>
                </div>
            </span>
        </span>

		<footer><?php echo copyright(); ?></footer>
	</body>
</html>
