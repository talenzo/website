<?php 
include('session.php');
include('connexion.php');

$id = $_SESSION['id'];
?>
<html>
<head>
  <?php include('header.php'); ?>
  <title>Mes partages</title>
</head>
<body>

<?php 
include('navigation.php');
?>
<div class="container-fluid text-center">
  <div class="row content">
    <?php
    include('navigation_gauche.php');
    ?>
    <div class="col-sm-8 text-left">
      <br/>
      <br/>
<?php
$i = 0;
$array = array();

if (isset($_POST['supprimer'])) 
{
  if (isset($_POST['select'])) 
  {
   if (sizeof($_POST['select'])==0)
   {
    header( "refresh:2;url=page_membre.php" );
   }
   else
   {
     foreach ($_POST['select'] as $valeur)
     {       
  	   // requete sql
       $sql = "SELECT * FROM tbl_files WHERE up_fileuserid = " .$id. " AND up_id = ".$valeur."";
  			//execution
       $reponse = $base->query($sql);
  			//traitement des donnees
       while ($donnees = $reponse->fetch()) 
       {
         $fichier_sup = "'".$donnees['up_filerepertory'] . $donnees['up_filename']."'" ;
  				//ouverture du dossier pour suppression du fichier
         $repertoire = opendir($donnees['up_filerepertory']);

         while (false !== ($fichier = readdir($repertoire)))
         {
					 $chemin = $donnees['up_filerepertory'].$donnees['up_filename']; // On définit le chemin du fichier à effacer.

					 // Si le fichier n'est pas un répertoire…
					 if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier))
           {
       			 unlink($chemin); // On efface.
       			 break 1;
       		 }
         }

         $up_filesize = $donnees['up_filesize'];
         // requete pour vérifier si quota non atteint
         $sql = "SELECT quota, stock  FROM tbl_user WHERE id = " .$id. "";
         $reponse = $base->query($sql);

         while ($donnees = $reponse->fetch()) 
         {
             $quota = $donnees['quota'];
             $stock = $donnees['stock'];
             $size  = $stock - $up_filesize;
         }

         //requete pour mettre à jour le quota utilisé
         $sql = "UPDATE tbl_user SET stock =" .$size. " WHERE id = " .$id. "";
         $base->exec($sql);

          closedir($repertoire);
       }
          $sql = "DELETE FROM tbl_share where sh_userid = " .$id. " AND sh_fileid = " .$valeur. "";
          $base->exec($sql);

          $sql = $base->prepare("DELETE FROM tbl_files where up_id = :up_id");
          $sql->bindParam(':up_id', $valeur, PDO::PARAM_STR);
          $sql->execute();
      }
    }
    // succès
    $message = 1;
  }
  else
  {
    $message = 2;
    // Aucun élément sélectionnné !
  }
  header( "Location:page_membre.php?message=" .$message. "" );
}
elseif (isset($_POST['partager'])) 
{
  if (isset($_POST['select'])) 
  {
   if (sizeof($_POST['select'])==0)
   {
    header( "Location:url=page_membre.php?message=2" );
   }
   else
   {
    ?>

    <body>
    <a href="page_membre.php">Retourner à l'accueil</a>
    <h2>Mes fichiers</h2>
    <?php
    foreach ($_POST['select'] as $valeur)
    {
      // requete sql
      $sql = "SELECT * FROM tbl_files WHERE up_fileuserid = " .$id. " AND up_id = ".$valeur."";
      $reponse = $base->query($sql);

      while ($donnees = $reponse->fetch()) 
       {
          $array[] = $donnees['up_id'];
          echo $donnees['up_filename']. "</br>";
          // $i = $i + 1;
       }
    }       
   }
   $tableau = implode('|', $array);
   ?>
   <h2>Utilisateurs</h2>
   <form method='POST' action='partage.php'>
   <div>
   <table class='table table-striped'>
   <thead>
   <tr>
   <td width=''>Utilisateurs</td>
   <td width=''>Choix</td>
   </tr>
   </thead>
   <tbody>
   <?php
    // requete sql
    $sql = "SELECT * FROM tbl_user WHERE id <> " .$id. " ORDER BY nom ASC";
    $reponse = $base->query($sql);

    while ($donnees = $reponse->fetch()) 
    {
      $idd = $donnees['id'];
      echo"<tr><td><div>" .$donnees['nom']. " " .$donnees['prenom']. "<div></td>";
      echo"<td><input type='checkbox' name='select[]' value=" .$idd. "></input></td>";
      echo"</tr>";
    }
    echo "<input  name='tableau' type='hidden' value='".$tableau."'>";
    ?>
    </tbody>
    </table>
    </div>
    <input type="submit" name="partager" value="Partager">
    </form>
    </body>
    </html>
    <?php
  }
  else
  {
    //Aucun élément sélectionnné !
    header( "Location:page_membre.php?message=2" );
  }
}
?>
 <?php 
include('navigation_droite.php')
 ?>
</body>
</html>