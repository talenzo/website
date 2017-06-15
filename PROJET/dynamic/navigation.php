<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php 
      include('connexion.php');
      $id = $_SESSION['id'];
      $sql1 = "SELECT * FROM tbl_user WHERE id = " .$id. "";
      //execution
      $reponse1 = $base->query($sql1);
      //traitement des donnees
      while ($donnees1 = $reponse1->fetch()) {
         $nom = $donnees1['nom'];
         $prenom = $donnees1['prenom'];
      }
       ?>
      <div class="navbar-brand"><?php echo "" . $prenom . " " . $nom . ""; ?></div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

        <?php 
        $page = $_SERVER['REQUEST_URI'];
        if (stripos($page, '/page_partage.php') !== FALSE){
          echo '<li><a href="page_membre.php">Accueil</a></li>
                <li class="active"><a href="page_partage.php">Mes partages</a></li>
                <li><a href="page_acces.php">Mes accès</a></li>';
                if ($_SESSION['id'] == 1)
                {
                  echo '<div class="dropdown" style="float: left; margin-top:8px;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion des utilisateurs
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="gestion_create.php">Créer</a></li>
                          <li><a href="gestion_modif.php">Modifier</a></li>
                          <li><a href="gestion_delete.php">Supprimer</a></li>
                        </ul>
                        </div>';
                }
        }
        elseif (stripos($page, '/formulaire.php') !== FALSE){
          echo '<li><a href="page_membre.php">Accueil</a></li>
                <li class="active"><a href="page_partage.php">Mes partages (partage)</a></li>
                <li><a href="page_acces.php">Mes accès</a></li>';
                if ($_SESSION['id'] == 1)
                {
                  echo '<div class="dropdown" style="float: left; margin-top:8px;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion des utilisateurs
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="gestion_create.php">Créer</a></li>
                          <li><a href="gestion_modif.php">Modifier</a></li>
                          <li><a href="gestion_delete.php">Supprimer</a></li>
                        </ul>
                        </div>';
                }
        }
        elseif (stripos($page, 'detail_partage.php') !== FALSE){
          echo '<li><a href="page_membre.php">Accueil</a></li>
                <li class="active"><a href="page_partage.php">Mes partages (détail)</a></li>
                <li><a href="page_acces.php">Mes accès</a></li>';
                if ($_SESSION['id'] == 1)
                {
                  // echo '<li><a href="./gestion.php">Gestion</a></li>';
                  echo '<div class="dropdown" style="float: left; margin-top:8px;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion des utilisateurs
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="gestion_create.php">Créer</a></li>
                          <li><a href="gestion_modif.php">Modifier</a></li>
                          <li><a href="gestion_delete.php">Supprimer</a></li>
                        </ul>
                        </div>';
                }
        }
        elseif (stripos($page, '/page_membre.php') !== FALSE){ 
          echo '<li class="active"><a href="page_membre.php">Accueil</a></li>
                <li><a href="page_partage.php">Mes partages</a></li>
                <li><a href="page_acces.php">Mes accès</a></li>';
                if ($_SESSION['id'] == 1)
                {
                  echo '<div class="dropdown" style="float: left; margin-top:8px;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion des utilisateurs
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="gestion_create.php">Créer</a></li>
                          <li><a href="gestion_modif.php">Modifier</a></li>
                          <li><a href="gestion_delete.php">Supprimer</a></li>
                        </ul>
                        </div>';
                }
        }
        elseif (stripos($page, '/page_acces.php') !== FALSE) {
          echo '<li><a href="page_membre.php">Accueil</a></li>
                <li><a href="page_partage.php">Mes partages</a></li>
                <li class="active"><a href="page_acces.php">Mes accès</a></li>';
                if ($_SESSION['id'] == 1)
                {
                  echo '<div class="dropdown" style="float: left; margin-top:8px;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion des utilisateurs
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="gestion_create.php">Créer</a></li>
                          <li><a href="gestion_modif.php">Modifier</a></li>
                          <li><a href="gestion_delete.php">Supprimer</a></li>
                        </ul>
                        </div>';
                } 
        }
        else
        {
          echo '<li><a href="page_membre.php">Accueil</a></li>
                <li><a href="page_partage.php">Mes partages</a></li>
                <li><a href="page_acces.php">Mes accès</a></li>';
                if ($_SESSION['id'] == 1)
                {
                  echo '<div class="dropdown" style="float: left; margin-top:8px;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gestion des utilisateurs
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="gestion_create.php">Créer</a></li>
                          <li><a href="gestion_modif.php">Modifier</a></li>
                          <li><a href="gestion_delete.php">Supprimer</a></li>
                        </ul>
                        </div>';
                } 
        }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li> <?php echo '<a href="./logout.php">Déconnexion <span class="glyphicon glyphicon-log-out"></span></a>'; ?>
      </ul>
    </div>
  </div>
</nav>