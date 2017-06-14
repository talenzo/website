<?php 
include('session.php');
include('connexion.php');

$up_fileuserid = $_SESSION['id'];

if (isset($_POST['supprimer'])) {

  if (isset($_POST['select'])) {
   if (sizeof($_POST['select'])==0){
    header( "refresh:2;url=page_membre.php" );
  }
  else{
    foreach ($_POST['select'] as $valeur){

  			// requete sql
     $sql = "SELECT * FROM tbl_files WHERE up_fileuserid = " .$up_fileuserid. " AND up_id = ".$valeur."";
  			//execution
     $reponse = $base->query($sql);
  			//traitement des donnees
     while ($donnees = $reponse->fetch()) {
       $fichier_sup = "'".$donnees['up_filerepertory'] . $donnees['up_filename']."'" ;
  				//ouverture du dossier pour suppression du fichier
       $repertoire = opendir($donnees['up_filerepertory']);

       while (false !== ($fichier = readdir($repertoire))){
					$chemin = $donnees['up_filerepertory'].$donnees['up_filename']; // On définit le chemin du fichier à effacer.

					// Si le fichier n'est pas un répertoire…
					if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier)){
       					unlink($chemin); // On efface.
       					break 1;
       				}
            }

            closedir($repertoire);
          }

          $sql = $base->prepare("DELETE FROM tbl_files where up_id = :up_id");
          $sql->bindParam(':up_id', $valeur, PDO::PARAM_STR);
          $sql->execute();

        }
      }
      echo "Selection supprimée !";
    }
    else{
     echo "Aucun élément sélectionnné !";
   }
   header( "refresh:2;url=page_membre.php" );
 }

 // Si nous sommes en partage de fichier, on affiche tous les utilisateurs
 elseif (isset($_POST['partager'])) {

  if (isset($_POST['delete'])) {
    if (sizeof($_POST['delete'])==0){
      header( "refresh:2;url=page_membre.php" );
    }
    else{
      foreach ($_POST['delete'] as $valeur){

      }
    }
    echo "Selection partagée !";
  }
  else{
    echo "Aucun élément sélectionnné !";
  }
  header( "refresh:2;url=page_membre.php" );
}
?>