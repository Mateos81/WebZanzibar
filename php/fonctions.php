<?php
    //session_start();
    
    /**
     * Connexion à la base de données de Zanzibar.
     *
     * @return L'objet connexion pour être utilisé au travers de requêtes.
     */
    function connexion()
    {
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
        
        return $con;
    }
    
    /**
     * Prend un titre complet au format "dd/mm/yyyy - Title",
     * et le découpe en deux variables prêtes à être utilisées dans une requête.
     *
     * @return Un tableau de deux chaînes de caractères, avec la date formatée et le titre.
     */
    function decoupage_full_title($full_title)
    {
        $date= substr($full_title, 0, 10);
        
        $dateT= date_create();
        date_date_set($dateT, substr($date, 6, 4), substr($date, 3, 2), substr($date, 0, 2));
        
        $date= date_format($dateT, "Y-m-d");
        $title= substr($full_title, 13, strlen($full_title) - 1);
        
        return array ($date, $title);
    }

    /*
     * Mise à zéro des variables de session,
     * et destruction de la session.
     */
    function deconnexion()
    {
        session_unset();
        session_destroy();
        header('Location: espPro.php');
    }
	
	function ajoutImage($fichier)
	{
		// On rajoute le nom du fichier dans le fichier xml
			$xmlFile = "../xml/images.xml";
			
			$handle = fopen($xmlFile, "r");
			$contenu = fread($handle, filesize($xmlFile));
			fclose($handle);
			
			// On vérifie que le fichier xml ne contient pas déjà le fichier
			if (!strrpos($contenu, $fichier))
			{			
				$contenu = substr($contenu, 0, strrpos($contenu, '</IMAGES>'));
				$fp=fopen($xmlFile,"w");
				fwrite($fp,$contenu .
				'<IMG>' . $fichier . '</IMG>
				</IMAGES>');
			}
		
	}
	
	function supprImages($fichier)
	{
		// On rajoute le nom du fichier dans le fichier xml
			$xmlFile = "../xml/images.xml";
			
			$handle = fopen($xmlFile, "r");
			$contenu = fread($handle, filesize($xmlFile));
			fclose($handle);
						
			// On vérifie que le fichier xml contient le fichier
			if (strrpos($contenu, $fichier))
			{			
				$contenu = str_replace('<IMG>' . $fichier . '</IMG>', '', $contenu);
				$fp=fopen($xmlFile,"w");
				fwrite($fp,$contenu);
			}
		
	}
	
	function nbImgs() {
		$xmlFile = "../xml/images.xml";
		$handle = fopen($xmlFile, "r");
		$contenu = fread($handle, filesize($xmlFile));
		fclose($handle);
		
		return substr_count($contenu, '<IMG>');
	}
	
	function verifCoche() {
		
		$url = 'http://localhost/zanzibar/test.html';
		$doc = new DOMDocument();
		$doc->loadHTMLFile("http://localhost/zanzibar/test.html");
		echo "test" . $doc->getElementById('img0');
		/*for ($i = 0; $i < nbImgs(); $i = $i + 1)
		{
			if (isset($_POST['cb' + $i]))
			{
				$doc = new DomDocument;
				$doc->validateOnParse = true;
				$doc->Load('http://localhost/zanzibar/test.html');
				return $doc->getElementById('img' . $i);				
			}
				
		}*/
		
	}
	
?>
