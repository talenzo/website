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

/*Verifie si le pseudo est deja inscrit */
$reponse = $base->prepare('SELECT login FROM tbl_user WHERE login = :login'); 
$reponse->execute(array('login'=> $_POST['login']));
$count = $reponse->rowCount(); 
if($count == 1) 
{ 
    // Pseudo déjà utilisé 
    $message = 2;

} 
else 
{ 
    // Sinon on procede a l'inscription
    // Ajoute l'inscrit
    $sql  = "INSERT INTO tbl_user(nom, prenom, login, pwd, groupe, quota, stock) VALUES('".$nom. "', '".$prenom."', '".$login."', '".$pwd."',  0, '".$quota."', '".$stock."')";
    // $create_account = $base->prepare("INSERT INTO tbl_user SET nom = ?, prenom = ?, login = ?, pwd = ?, groupe = ?, quota = ?, stock = ?)");
    
    try 
    { 
        $base->exec($sql);
        $folderid = $base -> lastInsertId();
        $message = 1;
        // $create_account->execute([$nom, $prenom, $login, $pwd, $group, $quota, $stock]);
        $dossier = 'upload/' .$folderid. '';
        if(!is_dir($dossier)){
            mkdir($dossier);
        }
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
header("Location:gestion_create.php?message=" .$message. "");
?>

</body>
</html>
<?php 
}
?>