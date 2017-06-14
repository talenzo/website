<?php 
include('session.php');
include('connexion.php');

$id = $_SESSION['id'];
?>
<html>
<head>
<?php include('header.php') ?>
  <title>Mes partages</title>
</head>
<body>

<?php 
include('navigation.php');

// GESTION DES MESSAGES

//Votre fichier a bien été enregistré !
if (isset($_GET['message']) && $_GET['message'] == '1') {
echo "  
<div class='container'> 
<div class='alert alert-success fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    Votre demande a été traitée avec succès.
  </div>
</div>";
}

if (isset($_GET['message']) && $_GET['message'] == '2') {
echo "  
<div class='container'> 
  <div class='alert alert-danger fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    Vous n'avez rien sélectionné. Veuillez recommencer.
  </div>
</div>";
}

// FIN MESSAGES
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
$sql = "SELECT * FROM tbl_share WHERE sh_userid = " .$id. "";
$data = $base->query($sql);
$data1 = $data->rowcount();

  if ($data1 == 0) 
  {
    echo "<h1>Pas de fichiers partagés</h1>";
  }
  else
  {
    echo "<h1>Mes fichiers partagés</h1>";
    echo "<div class='fichiers'>
          <form method='POST' action='detail_partage.php'>
          <table class='table table-striped'>
          <thead>
          <tr>
          <th width=''>Fichiers</th>
          <th width=''>Choix</th>
          <th width=''>Détail du fichier n°</th>
          </tr>
          </thead>
          <tbody>";
  }

// requete sql
$sql = "SELECT * FROM tbl_share, tbl_files WHERE sh_userid = " .$id. " AND up_id = sh_fileid GROUP BY sh_fileid";
$reponse = $base->query($sql);

while ($donnees = $reponse->fetch()) 
{
  $up_id = $donnees['up_id'];
  $filenom = $donnees['up_filename'];
 echo"<tr><td>" . substr($filenom, 0, 25); "
                      ";
                      
                      if (strlen($filenom) >= 25) {
                        echo "[...]";
                      }
  echo"</td>";
  echo"<td><input type='checkbox' name='select[]' value=" .$up_id. "></input></td>";
  echo"<input type='hidden' name='fichier' value='" .$up_id. "'/>";
  echo"<td><input type='submit' name='detail_partage' value='" .$up_id. "' class='btn btn-info' style='height:22px; text-align: center; line-height: 0px;'></input></td>";
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