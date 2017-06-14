
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
<?php 
include('header.php'); 
?>
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
        <h4>L'utilisateur a été créé ! Vous pouvez dès à présent vous connecter avec celui-ci.</h4>
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
	<h2>Créer un nouvel utilisateur</h2>
	<form action="validation.php" method="POST">
	<p><label>Nom :</label><br/> <input type="text" placeholder="Nom" name="nom" class="input_perso"/></p>
	<p><label>Prénom :</label><br/> <input placeholder="Prénom" name="prenom" class="input_perso"/></p>
	<p><label>Identifiant :</label><br/> <input placeholder="Identifiant" name="login" class="input_perso"/></p>
	<p><label>Mot de passe :</label><br/> <input placeholder="Mot de passe" name="password" class="input_perso"/></p>
	<p><label>Mot de passe (confirmation) :</label><br/> <input type="password" placeholder="Mot de passe" name="password2" class="input_perso"/></p>
	<!-- <p><label>Groupe :</label><br/> <input placeholder="Groupe" name="group" class="input_perso"/></p> -->
	<p><label>Quota en Go :</label><br/> <input placeholder="Quota" name="quota" class="input_perso"/></p>
	<input type="submit" name="creation"value="Inscription" class="input_perso" />
	</form>
</div>
</body>
</html>
<?php
}
?>