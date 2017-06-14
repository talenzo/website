   </div>
    <div class="col-sm-2 sidenav">
      <h2>Espace occupé</h2>
      <div class="progress">
        <?php 
        // requete sql
        try{
           $sql = "SELECT * FROM tbl_user WHERE id = " .$id. "";
           //execution
           $reponse = $base->query($sql);
           //traitement des donnees
           while ($donnees = $reponse->fetch()) {
              $quota = $donnees['quota'];
              $stock = $donnees['stock'];
              // echo " <a href=" .$up_filerepertory. $file .">$file</a><br/>";
           }
           }
           catch (Exception $e) {
              die('Erreur: ' .$e->getMessage());
           }

          $total1 = ((100/$quota) * $stock);
          $total = round($total1, 0);
          // $totalf = 100 - $total;

          // echo '<div class="progress-bar-" role="progressbar" aria-valuenow="' .$total. '" aria-valuemin="0" aria-valuemax="100" style="width:' .$total. '%">
                // <span>' .$total. '% / ' .$totalf. '%</div></span>';
          // echo $total . " / 100%";
          if ($total1 == 0) {
                  echo '<div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar" role="progressbar"
                        style="width:100%">
                        Espace libre: 100%
                        </div>
                        </div>';
          }
          if (($total <= 40) AND ($total <= 1)) {
                  echo '<div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                        aria-valuenow="' .$total. '" aria-valuemin="0" aria-valuemax="100" style="width:' .$total. '%">
                        ' .$total. '%
                        </div>
                        </div>';
                }      
          if ($total <= 60) {
                  echo '<div class="progress">
                        <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"
                        aria-valuenow="' .$total. '" aria-valuemin="0" aria-valuemax="100" style="width:' .$total. '%">
                        ' .$total. '%
                        </div>
                        </div>';
                }      
          if ($total <= 80) {
                  echo '<div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
                        aria-valuenow="' .$total. '" aria-valuemin="0" aria-valuemax="100" style="width:' .$total. '%">
                        ' .$total. '%
                        </div>
                        </div>';
                }      
          if ($total > 80) {
                  echo '<div class="progress">
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar"
                        aria-valuenow="' .$total. '" aria-valuemin="0" aria-valuemax="100" style="width:' .$total. '%">
                        ' .$total. '%
                        </div>
                        </div>';
                }      
        ?>       
      </div>
      <?php
      // echo "$total $quota $stock";
      $espaceGo = $quota / 1000000000;
      $espaceMo = $quota / 1000000;
      $utiliseGo = $stock / 1000000000;
      $utiliseMo = $stock / 1000000;
      $utiliseGo = round($utiliseGo, 2);
      $utiliseMo = round($utiliseMo, 2);
      if ($espaceGo < 1) 
      {
          echo "Espace utilisé : ".$utiliseMo. "Mo sur " .$espaceMo."Mo";
      }
      elseif ($espaceGo <= 1 AND $utiliseGo < 1)
      {
          echo "Espace utilisé : ".$utiliseMo. "Mo sur " .$espaceGo."Go";
      }
      elseif ($espaceGo > 1 AND $utiliseGo >= 1)
      {
          echo "Espace utilisé : ".$utiliseGo. "Go sur " .$espaceGo."Go";
      }
      ?>
    </div>
  </div>
</div>
</br>
<footer class="container-fluid text-center">
  <p><a href="mailto:xxx@yz.org" style='color:white'<a>Contacter l'administrateur</a></p>
</footer>