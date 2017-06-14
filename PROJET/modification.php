<?php 
include('session.php');
include('connexion.php');

if ($_SESSION['id'] <> 1)
{
    //Vous ne disposez pas des droits
    header("Location:page_membre.php?message=7");
}
else
{
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Validation d'inscription</title>
</head>
<body>
<?php 
$id = $_GET['user'];
$nom    = $_POST['nom'];
$prenom = $_POST['prenom'];
$login  = $_POST['login'];
$pwd    = $_POST['password'];
// $group  = $_POST['group'];
$quota  = $_POST['quota'] * 1000000000;
$stock  = 0;
/* Verifie si le formulaire est rempli */
if(!empty($nom) AND !empty($prenom) AND !empty($login) AND !empty($pwd) AND !empty($quota) AND ($pwd == $_POST['password2'])) 
{

    // Sinon on procede a l'inscription
    // Ajoute l'inscrit
    // $sql  = "INSERT INTO tbl_user(nom, prenom, login, pwd, groupe, quota, stock) VALUES('".$nom. "', '".$prenom."', '".$login."', '".$pwd."',  0, '".$quota."', '".$stock."')";
    $sql  = "UPDATE tbl_user SET nom = '".$nom. "', prenom = '".$prenom."', login = '".$login."', pwd = '".$pwd."', groupe = 0, quota = '".$quota."' WHERE id = " .$id. "";
       // $create_account = $base->prepare("INSERT INTO tbl_user SET nom = ?, prenom = ?, login = ?, pwd = ?, groupe = ?, quota = ?, stock = ?)");
    
    try 
    { 
        $base->exec($sql);
        $message = 1;
        // $create_account->execute([$nom, $prenom, $login, $pwd, $group, $quota, $stock]);
    } 
    catch (PDOException $e) 
    { 
        echo $e->getMessage();
        $message = 3; 
    } 
    // $ajou = $base->prepare($sql);
    // $ajou->execute(array( ':nom'=> $nom, ':prenom'=> $_POST['prenom'], ':login'=> $_POST['login'], ':pwd'=> $_POST['password'], ':group'=> $_POST['group']));
    // ajout échoué
}
elseif ($pwd <> $_POST['password2'])
{
    $message = 5;
}
else
{
    // Si il y a un probleme
    $message = 4;
}
header("Location:gestion_modif.php?message=" .$message. "&amp;user=" .$id. "");
?>

</body>
</html>
<?php 
}
?>