<html>
<head>
<title>Formulaire d'identification</title>
<?php include('header.php'); ?>
</head>
<body>

<div class="container_co">
<form action="login.php" method="post" class="form-signin">
<p><h2 class="form-signin-heading">Identifiez-vous</h2>
<label class="sr-only">Votre login</label><br/><input class="form-control" type="text" name="login" placeholder="Login">
<label class="sr-only">Votre mot de passe</label><br/><input class="form-control" type="password" name="password" placeholder="Mot de passe"><br/>
<input class="btn btn-lg btn-primary btn-block" type="submit" value="Connexion"></p><br/>
<?php 
if (isset($_GET['message']) && $_GET['message'] == '1') {
  echo "<span style='color:#ff0000'>Login/Mot de passe incorrect</span>";
}
else{
  echo "Veuillez saisir vos identifiants";
}
?>
</form>
</div>
</body>
</html>