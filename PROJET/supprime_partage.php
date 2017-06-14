<?php 
include('session.php');
include('connexion.php');

$id = $_SESSION['id'];

if (isset($_POST['supprime_partage'])) 
{
  if (isset($_POST['select'])) 
  {
   if (sizeof($_POST['select'])==0)
   {
     $message = 2;
   }
   else
   {
     foreach ($_POST['select'] as $userid)
     {       
          $sql = "DELETE FROM tbl_share where sh_userid = " .$id. " AND sh_usershid = " .$userid. " AND sh_fileid = " .$_POST['fichierid']. "";
          $base->exec($sql);
          
      }
    }
    $message = 1;
  }
  else
  {
    $message = 2;
  }
  header( "Location:page_partage.php?message=" .$message. "" );
}
