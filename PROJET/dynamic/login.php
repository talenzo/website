<?php
//
session_start();
try {
  include('connexion.php');

  $login = $_POST['login'];
  $password = $_POST['password'];

  // requete sql
  $sql = "SELECT * FROM tbl_user WHERE login = '" .$login. "' AND pwd ='" .$password. "'";
  //execution
  $reponse = $base->query($sql);
  //traitement des donnees
  while ($donnees = $reponse->fetch()) {
    $_SESSION['id'] = $donnees['id'];
    header('location:page_membre.php');
  }
  //verification
  if (!isset($_SESSION['id'])) {
  header("location:index.php?message=1");
  }
} 
//erreur
catch (Exception $e) {
  die('Erreur: ' .$e->getMessage());
}
?>