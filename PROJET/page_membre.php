<?php
include('session.php');
include('connexion.php');
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
?>
<html>
<head>
  <?php 
  include('header.php');
  ?>
	<title>Mon espace</title>
</head>
<body>


<?php 
include('navigation.php');

// GESITON DES ERREURS

//Le formulaire n'est pas rempli ou une erreur est survenue.
if (isset($_GET['message']) && $_GET['message'] == '5') {
echo "  
<div class='container'> 
  <div class='alert alert-danger fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <h4>Le formulaire n'est pas rempli ou une erreur est survenue.</h4>
  </div>
</div>";
}

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

// Fichier déjà éxistant !
if (isset($_GET['message']) && $_GET['message'] == '7') {
echo "  
<div class='container'> 
  <div class='alert alert-warning fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <h4>Ce fichier est déjà présent dans votre bibliothèque !</h4>
  </div>
</div>";
}

//Votre fichier a bien été enregistré !
if (isset($_GET['message']) && $_GET['message'] == '1') {
echo "  
<div class='container'> 
<div class='alert alert-success fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <h4>Votre demande a été traitée avec succès.</h4>
  </div>
</div>";
}

//Pas d'espace de stockage
if (isset($_GET['message']) && $_GET['message'] == '6') {
echo "  
<div class='container'> 
<div class='alert alert-warning fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <h4>Votre espace de stockage est insuffisant !</h4>
  </div>
</div>";
}


// FIN DE GESTION DES ERREURS


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
$up_filerepertory = 'upload/' .$_SESSION['id']. '/';;
$id = $_SESSION['id'];

// requete sql
$sql = "SELECT * FROM tbl_files WHERE up_fileuserid = " .$id. "";
$data = $base->query($sql);
$data1 = $data->rowcount();

  if ($data1 == 0) 
  {
    echo "<h2>Vous n'avez pas de fichiers !</h2>";
  }
  else
  {
    echo "<h1>Mes fichiers</h1>
          <p>
          <div class='fichiers'>
          <form method='POST' action='formulaire.php'>
          <table  class='table table-striped'>
          <thead>
          <tr>
          <th width=''>Fichiers</th>
          <th width=''>Choix</th>
          </tr>
          </thead>
          <tbody>";
  }
//  si le dossier pointe existe
if (is_dir($up_filerepertory)) {

   // si il contient quelque chose
   if ($dh = opendir($up_filerepertory)) {

       // boucler tant que quelque chose est trouve
       while (($file = readdir($dh)) !== false) {

           // affiche le nom et le type si ce n'est pas un element du systeme
           if( $file != '.' && $file != '..') {
               // requete sql
               try{
                  $sql = "SELECT * FROM tbl_files WHERE up_filerepertory = '" .$up_filerepertory. "' AND up_filename = '" .$file. "' AND up_fileuserid = " .$id. "";
                  //execution
                  $reponse = $base->query($sql);
                  //traitement des donnees
                  while ($donnees = $reponse->fetch()) {
                     $up_id = $donnees['up_id'];
                     echo"<tr><td><a href=" .$up_filerepertory.$file. ">" . substr($file, 0, 30); "</a>
                      ";
                      
                      if (strlen($file) >= 30) {
                        echo "[...]";
                      }

                      
                    echo "
                     </td>";
                     echo"<td><input type='checkbox' name='select[]' value=" .$up_id. "></input></td>";
                     echo"</tr>";
                     // echo " <a href=" .$up_filerepertory. $file .">$file</a><br/>";
                  }
               }
               catch (Exception $e) {
               die('Erreur: ' .$e->getMessage());
               }
           }
       }
       // on ferme la connection
       closedir($dh);
   }
}

if ($data1 == 0) 
  {
    
  }
  else
  {
    echo "</tbody></table>
<input type='submit' name='supprimer' value='Supprimer' class='btn btn-default'>
<input type='submit' name='partager' value='Partager' class='btn btn-primary'></form></p>
</div>";
  }
?>
 <?php 
include('navigation_droite.php')
 ?>
</body>
</html>