<?php 
include('session.php');
include('connexion.php');

$id = $_SESSION['id'];

if (isset($_POST['supprime_partage'])) 
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
          $sql = "DELETE FROM tbl_share where sh_userid = " .$id. " AND sh_fileid = " .$valeur. "";
          $base->exec($sql);
      }
    }
    $message = 1;
  }
  else
  {
    $message = 2;
  }
  header( "Location:page_partage.php?message=" .$message. "" );
}

if (isset($_POST['detail_partage'])) 
{
  if (isset($_POST['fichier'])) { 
      ?>
      <html>
      <head>
      <?php include('header.php'); 
            include('navigation.php');?>
          <title>Mes partages (détail)</title>
      </head>
      <body>
      <div class="container-fluid text-center">
  <div class="row content">
    <?php
    include('navigation_gauche.php');
    ?>
    <div class="col-sm-8 text-left">
      <br/>
      <br/>

<?php

// vous n'avez rien selectionné
if (isset($_GET['message']) && $_GET['message'] == '2') {
echo "  
<div class='container'> 
  <div class='alert alert-warning fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <h4>Vous n'avez rien sélectionné. Veuillez recommencer.</h4>
  </div>
</div>";
}

// requete sql
$sql1 = "SELECT * FROM tbl_share WHERE sh_userid = " .$id. "";
$data = $base->query($sql1);
$data1 = $data->rowcount();

  if ($data1 == 0) 
  {
    echo "<h1>Le fichier n'est pas partagé.</h1>";
  }
  else
  {
    echo "<h1>Utilisateurs ayant accès à votre fichier</h1>";
    echo "<div class='fichiers'>
          <form method='POST' action='supprime_partage.php'>
          <table class='table table-striped'>
          <thead>
          <tr>
          <th width=''>Destinataires</th>
          <th width=''>Choix</th>
          </tr>
          </thead>
          <tbody>";
  }

$fichier = $_POST['detail_partage'];
$fichier_ext = substr($fichier, 0, 2);

// requete sql
$sql2 = "SELECT * FROM tbl_share, tbl_user WHERE sh_userid = " .$id. " AND sh_fileid = " .$fichier_ext. " AND sh_usershid = id GROUP BY nom";
// $sql2 = "SELECT * FROM tbl_share, tbl_user WHERE sh_userid = " .$id. " AND sh_fileid = 81 AND sh_usershid = id";
$reponse = $base->query($sql2);

while ($donnees = $reponse->fetch()) 
{
  $usershid = $donnees['sh_usershid'];
  
  echo"<tr><td><input type='hidden' name='fichierid' value='" .$fichier_ext. "'/>" .$donnees['nom']. " " .$donnees['prenom']. "</input></td>";
  echo"<td><input type='checkbox' name='select[]' value=" .$usershid. "></input></td>";
  echo"</tr>";
}
?>
</table>
<?php 
  if ($data1 == 0) 
  {
    echo "<a href='page_membre.php'>Retourner à l'accueil</a>";
  }
  else
  {
    echo "</tbody><input type='submit' name='supprime_partage' value='Supprimer' class='btn btn-danger'>
          </form></div>";
  }
?>
 <?php 
include('navigation_droite.php')
 ?>
</body>
</html>
<?php 
  }
}
?>