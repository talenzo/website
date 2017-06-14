
<?php 
include('session.php');

if ($_SESSION['id'] <> 1)
{
    header("Location:page_membre.php");
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
<?php include('header.php'); ?>
<link rel="stylesheet" href="inscription.css" />
<title>Gestion des utilisateurs</title>
</head>
<body>
<?php include('navigation.php');

   	// vous n'avez rien selectionné
    if (isset($_GET['message']) && $_GET['message'] == '1') {
    echo "  
    <div class='container'> 
      <div class='alert alert-success fade in'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <h4>L'utilisateur a été modifié ! Vous pouvez dès à présent vous connecter avec celui-ci.</h4>
      </div>
    </div>";
    }


    if (isset($_GET['message']) && $_GET['message'] == '2') {
    echo "  
    <div class='container'> 
    <div class='alert alert-warning fade in'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <h4>Identifiant déjà éxistant !</h4>
      </div>
    </div>";
    }


    if (isset($_GET['message']) && $_GET['message'] == '4') {
    echo "  
    <div class='container'> 
    <div class='alert alert-warning fade in'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <h4>Veuillez remplir toutes les champs du formulaire !</h4>
      </div>
    </div>";
    }

     //mot de passe incorrect
    if (isset($_GET['message']) && $_GET['message'] == '5') {
    echo "  
    <div class='container'> 
    <div class='alert alert-warning fade in'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <h4>Les mots de passe ne sont pas identiques ! </h4>
      </div>
    </div>";
    }
    ?>
<div style="margin-left: auto; margin-right: auto; text-align: center;">
<h2>Modifier un utilisateur</h2>
<SELECT name="user" size="1" onChange="window.location.href=this.value">
<option value=''>Aucun
<?php
// requete sql
$sql = "SELECT * FROM tbl_user ORDER BY nom ASC";
// $sql2 = "SELECT * FROM tbl_share, tbl_user WHERE sh_userid = " .$id. " AND sh_fileid = 81 AND sh_usershid = id";
$reponse = $base->query($sql);

while ($donnees = $reponse->fetch()) 
{
  $userid = $donnees['id'];
 	if ($userid <> 1) 
 	{
 	 	echo "<option value='gestion_modif.php?user=" .$userid. "'>" .$donnees['nom']. " " .$donnees['prenom'];	
 	} 
}
?>
</SELECT>

<?php 
// vous n'avez rien selectionné
    if (isset($_GET['user']) && $_GET['user'] <> '1' && $_GET['user'] <> '0' && $_GET['user'] <> '') 
    {
    	// requete sql
		$sql2 = "SELECT * FROM tbl_user WHERE id=" .$_GET['user']. "";
		// $sql2 = "SELECT * FROM tbl_share, tbl_user WHERE sh_userid = " .$id. " AND sh_fileid = 81 AND sh_usershid = id";
		$chargement = $base->query($sql2);

		while ($donnees = $chargement->fetch()) 
		{
 			$nom    = $donnees['nom'];
			$prenom = $donnees['prenom'];
			$login  = $donnees['login'];
			$pwd    = $donnees['pwd'];
			// $group  = $_POST['group'];
			$quota  = $donnees['quota'] / 1000000000;
			$stock  = $donnees['stock'];

 			if ($_GET['user'] <> 1) 
 			{
 	 			echo ' 
    					<form action="modification.php?user=' .$donnees["id"]. '" method="POST">
						<p><label>Nom :</label><br/> <input type="text" placeholder="Nom" name="nom" class="input_perso" value="' .$nom. '"/></p>
						<p><label>Prénom :</label><br/> <input placeholder="Prénom" name="prenom" class="input_perso" value="' .$prenom. '"/></p>
						<p><label>Identifiant :</label><br/> <input placeholder="Identifiant" name="login" class="input_perso" value="' .$login. '"/></p>
						<p><label>Mot de passe :</label><br/> <input type="password" placeholder="Mot de passe" name="password" class="input_perso" value="' .$pwd. '"/></p>
						<p><label>Mot de passe (confirmation) :</label><br/> <input type="password" placeholder="Mot de passe" name="password2" class="input_perso" value="' .$pwd. '"/></p>
						<p><label>Quota en Go :</label><br/> <input placeholder="Quota" name="quota" class="input_perso" value="' .$quota. '"/></p>
						<input type="submit" value="Modifier" class="input_perso" />
						</form>';
			} 
		}
    }
    else
    {
    ?>
    <form action="modification.php" method="POST">
	<p><label>Nom :</label><br/> <input type="text" placeholder="Nom" name="nom" class="input_perso"/></p>
	<p><label>Prénom :</label><br/> <input placeholder="Prénom" name="prenom" class="input_perso"/></p>
	<p><label>Identifiant :</label><br/> <input placeholder="Identifiant" name="login" class="input_perso"/></p>
	<p><label>Mot de passe :</label><br/> <input type="password" placeholder="Mot de passe" name="password" class="input_perso"/></p>
	<!-- <p><label>Mot de passe (confirmation) :</label><br/> <input type="password" placeholder="Mot de passe" name="password2" class="input_perso"/></p> -->
	<p><label>Groupe :</label><br/> <input placeholder="Groupe" name="group" class="input_perso"/></p>
	<p><label>Quota en Go :</label><br/> <input placeholder="Quota" name="quota" class="input_perso"/></p>
	<input type="submit" value="Modifier" class="input_perso" />
	</form>
   	<?php
    }
?>
	
</div>
</body>
</html>
<?php
}
?>