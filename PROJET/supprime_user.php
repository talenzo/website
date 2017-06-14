<?php 
include('session.php');
include('connexion.php');

if (isset($_POST['supprime_user'])) 
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
          $sql = "DELETE FROM tbl_share where sh_userid = " .$userid. "";
          $base->exec($sql);
          $sql1 = "DELETE FROM tbl_share where sh_usershid = " .$userid. "";
          $base->exec($sql1);
          $sql2 = "DELETE FROM tbl_files where up_fileuserid = " .$userid. "";
          $base->exec($sql2);
          $sql3 = "DELETE FROM tbl_user where id = " .$userid. "";
          $base->exec($sql3);
          
      }
    }
    $message = 1;
  }
  else
  {
    $message = 2;
  }
  header( "Location:gestion_delete.php?message=" .$message. "" );
}
