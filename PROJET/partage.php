<?php 
include('session.php');
include('connexion.php');

$user_id = $_SESSION['id'];                        //id de l'auteur
$i = 0;
$array = explode('|', $_POST['tableau']);          //tableau contenant les id des fichiers
$up_filedate     = date('Y-m-d H:i:s');            //date au format YYYY-mm-dd h:m:s

if (isset($_POST['partager'])) 
{
  if (isset($_POST['select'])) 
  {
   if (sizeof($_POST['select'])==0)
   {
    $message = 2;
   }
   else
   {
     foreach ($_POST['select'] as $valeur)
     {       
     	$usersh_id = $valeur;
     	foreach($array as $valeur) 
  		{  
     		//on envoie les données du fichier dans la bdd
			$sql  = "INSERT INTO tbl_share(sh_userid, sh_fileid, sh_usershid, sh_groupshid, sh_debdatesh, sh_findatesh) 
					 VALUES(:sh_userid, :sh_fileid, :sh_usershid, :sh_groupshid, :sh_debdatesh, :sh_findatesh)";
 			$insert = $base->prepare($sql);
 			$insert->execute(array(':sh_userid'=> $user_id, ':sh_fileid'=> $valeur, ':sh_usershid'=> $usersh_id, 
 						   		   ':sh_groupshid'=> 0, ':sh_debdatesh'=> $up_filedate, ':sh_findatesh'=> 0));
  		}
     }
    }
    //Fichier(s) partagé(s) !;
    $message = 1;
  }
  else
  {
    $message = 2;
  }
  header( "Location:page_membre.php?message=" .$message. "" );
}
?>