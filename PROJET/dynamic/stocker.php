<?php
include('session.php');
include('connexion.php');

$id = $_SESSION['id'];

//On vérifie si un fichier à bien été choisis et qu'il n'y a pas d'erreur
if (isset($_FILES['fichier']) AND $_FILES['fichier']['error'] == 0)
{

//on regarde si la taille est en dessous ou égale à 10485760 Octets(=10Mo)
if ($_FILES['fichier']['size'] <= 9910485760)
{
$info                = pathinfo($_FILES['fichier']['name']);
$extension           = $info['extension'];
$extension_autoriser = array('jpg', 'jpeg', 'bmp', 'png', 'doc', 'docx', 'pdf','xls', 'xlsx', 'ppt', 'pptx');
if(in_array($extension, $extension_autoriser))
{
	//on stocke les données du fichiers dans des variables avant envoi dans la bdd
	$up_filenameold  = ($_FILES['fichier']['name']);     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
	$up_filetype     = $_FILES['fichier']['type'];     //Le type du fichier. Par exemple, cela peut être « image/png ».
	$up_filesize     = $_FILES['fichier']['size'];     //La taille du fichier en octets.
	$up_filetmp_name = $_FILES['fichier']['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
	$up_fileerror    = $_FILES['fichier']['error'];    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
	$up_filerepertory= 'upload/' .$_SESSION['id']. '/';//repertoire du fichier sauvegardé
	$up_filedate     = date('Y-m-d H:i:s');            //date au format YYYY-mm-dd h:m:s
	$up_fileuserid   = $_SESSION['id'];                //id de l'utilisateur auteur de l'envoi
	

	$up_filename     = str_replace('%20', '_', $up_filenameold);
	$up_filename     = strtr($up_filename, " 'çéèêëÉôòÓùûàáâñí", "__ceeeeEooOuuaaani");
	$up_filedirectory1 = $up_filerepertory . $up_filenameold;
	$up_filedirectory2 = $up_filerepertory . $up_filename;
	
	// requete pour vérifier si quota non atteint
	$sql = "SELECT quota, stock  FROM tbl_user WHERE id = " .$id. "";
	$reponse = $base->query($sql);

	while ($donnees = $reponse->fetch()) 
	{
  		$quota = $donnees['quota'];
  		$stock = $donnees['stock'];
  		$size  = $up_filesize + $stock;

  		if ($quota < $size) 
  		{
  			//Espace de stockage insufisant !
  			$message = 6;
  		}
  		else
  		{
  			//requete pour mettre à jour le quota utilisé
  			$sql = "UPDATE tbl_user SET stock =" .$size. " WHERE id = " .$id. "";
          	$base->exec($sql);

  			// requete sql pour définir si le fichier existe déjà 
			$sql = "SELECT * FROM tbl_files WHERE up_fileuserid = " .$id. " AND up_filename = '" .$up_filename. "'";
			$data = $base->query($sql);
			$data1 = $data->rowcount();

  			if ($data1 == 0) 
  			{
  				//on stock le fichier dans le dossier de l'utilisateur connecté
				move_uploaded_file($up_filetmp_name, $up_filerepertory . basename($up_filenameold));
				//Votre fichier a bien été enregistré !
				$message = 1;
				//on envoie les données du fichier dans la bdd
				rename($up_filedirectory1, $up_filedirectory2);
				$sql  = "INSERT INTO tbl_files(up_filename, up_filetype, up_filesize, up_filetmp_name, up_filerepertory, up_filedate, up_fileuserid) 
						 VALUES(:up_filename, :up_filetype, :up_filesize, :up_filetmp_name, :up_filerepertory, :up_filedate, :up_fileuserid)";
 				$insert = $base->prepare($sql);
 				$insert->execute(array(':up_filename'=> $up_filename, ':up_filetype' => $up_filetype, ':up_filesize'=> $up_filesize, 
 							   ':up_filetmp_name'=> $up_filetmp_name, ':up_filerepertory'=> $up_filerepertory, ':up_filedate'=> $up_filedate, ':up_fileuserid'=> $up_fileuserid));
			}
  			else
  			{
  				//Fichier déjà éxistant dans vos documents !
    			$message = 7;
  			}
		}
	}
}
else
{
	//Le fichier n'a pas l'extension autorisée.
	$message = 3;
}
}
else 
{
   //Le fichier est trop gros.
   $message = 4;
}
}
else 
{
	//Le formulaire n'est pas rempli ou une erreur est survenue.
	$message = 2;
}

header( "Location:page_membre.php?message=" .$message. "" );
?>