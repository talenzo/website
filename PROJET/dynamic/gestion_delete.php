<html>
<head>
<?php 
include('connexion.php');
include('session.php');
include('header.php'); 
include('navigation.php');
require('function.php');
?>
<title>Suppression utilisateur</title>
</head>
<body>
	  <div class="container-fluid text-center">
  <div class="row content">
    <?php
    include('navigation_gauche.php');
    if (isset($_GET['message']) && $_GET['message'] <> '0') {
      $id_message = $_GET['message'];
      getMessage($id_message);
    }
    ?>
    <div class="col-sm-8 text-left">
      <br/>
      <br/>
	<!-- <div style="margin-left: auto; margin-right: auto; text-align: center;"> -->
		<?php

    echo "<h1>Choisissez des utilisateurs à supprimer</h1>";
    echo "<div class='fichiers'>
          <form method='POST' action='supprime_user.php'>
          <table class='table table-striped'>
          <thead>
          <tr>
          <th width=''>Destinataires</th>
          <th width=''>Choix</th>
          </tr>
          </thead>
          <tbody>";

// requete sql
$sql2 = "SELECT * FROM tbl_user ORDER BY nom ASC";
// $sql2 = "SELECT * FROM tbl_share, tbl_user WHERE sh_userid = " .$id. " AND sh_fileid = 81 AND sh_usershid = id";
$reponse = $base->query($sql2);

while ($donnees = $reponse->fetch()) 
{
  $userid = $donnees['id'];
 	if ($userid <> 1) 
 	{
 	 	echo"<tr><td>" .$donnees['nom']. " " .$donnees['prenom']. "</input></td>";
  	echo"<td><input type='checkbox' name='select[]' value=" .$userid. "></input></td>";
  	echo"</tr>";	
 	} 
}
?>
</table>
<?php 

    echo "</tbody><input type='submit' name='supprime_user' value='Supprimer' class='btn btn-danger'>
          </form></div>";
include('navigation_droite.php')
 ?>

	<!-- </div> -->
</body>
</html>