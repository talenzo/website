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
// requete sql
$sql = "SELECT * FROM tbl_share WHERE sh_usershid = " .$id. "";
$data = $base->query($sql);
$data1 = $data->rowcount();

  if ($data1 == 0) 
  {
    echo "<h1>Vous n'avez accès à aucun fichier...</h1>";
  }
  else
  {
    echo "<h1>Fichiers accessibles</h1>";
    echo "<div class='fichiers'>
          <table class='table table-striped'>
          <thead>
          <tr>
          <th width=''>Fichiers</th>
          <th width=''>Auteurs</th>
          </tr>
          </thead>
          <tbody>";
  }

// requete sql
$sql = "SELECT up_filename, up_filerepertory, nom, prenom  FROM tbl_share, tbl_files, tbl_user WHERE sh_usershid = " .$id. " AND sh_fileid = up_id  AND up_fileuserid = id GROUP BY sh_fileid";
$reponse = $base->query($sql);

while ($donnees = $reponse->fetch()) 
{
 $filenom = $donnees['up_filename'];
 echo"<tr><td><a href=" .$donnees['up_filerepertory'].$donnees['up_filename']. ">" . substr($filenom, 0, 30); "
                      ";
                      
                      if (strlen($filenom) >= 30) {
                        echo "[...]";
                      }
  echo "<td>" .$donnees['nom']. " " .$donnees['prenom']. "</td>";
  echo"</tr>";
}

  if ($data1 == 0) 
  {
    echo "<a href='page_membre.php'>Retourner à l'accueil</a>";
  }
  else
  {
    echo "</table></tbody></div>";
  }
?>
 <?php 
include('navigation_droite.php')
 ?>
</body>
</html>