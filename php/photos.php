<?php

    $fichier = $_POST['img'];
    
	
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

	
?>