<?php 
try
{
    // On se connecte à MySQL
    $base = new PDO('mysql:host=localhost; dbname=dynamic', 'root', '');
	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$base->exec("SET CHARACTER SET utf8");
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    echo 'Nous avons un petit problème sur le site veuillez réessayer plus tard<br/>';
        die('Erreur : '.$e->getMessage());
}
?>