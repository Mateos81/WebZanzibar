<?php

	$dossier = '../Images/';
	$fichier = basename($_FILES['openFileDialog']['name']);
	$taille_maxi = 1000000;
	$taille = filesize($_FILES['openFileDialog']['tmp_name']);
	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
	$extension = strrchr($_FILES['openFileDialog']['name'], '.'); 
	//Début des vérifications de sécurité...
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
	}
	if($taille>$taille_maxi)
	{
		 $erreur = 'Le fichier est trop gros...';
	}
	if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
	{
		 //On formate le nom du fichier ici...
		 $fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		 if(move_uploaded_file($_FILES['openFileDialog']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		 {
			//echo 'Upload effectue avec succes !';
			
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
		 else //Sinon (la fonction renvoie FALSE).
		 {
			  echo 'Echec de l\'upload !';
		 }
	}
	else
	{
		 echo $erreur;
	}
	
	header('Location: ../photos.html');
		
?>