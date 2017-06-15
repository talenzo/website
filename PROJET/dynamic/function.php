<?php 
function getMessage($id_message){
	switch ($id_message) {
		case '1':
			//Votre fichier a bien été enregistré !
			echo "  
			<div class='container'> 
			<div class='alert alert-success fade in'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <h4>Votre demande a été traitée avec succès.</h4>
			  </div>
			</div>";
			break;
		case '2':
			// vous n'avez rien selectionné
			echo "  
			<div class='container'> 
  				<div class='alert alert-warning fade in'>
    				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    				<h4>Vous n'avez rien sélectionné. Veuillez recommencer.</h4>
  				</div>
			</div>";
			break;
		case '3':
			# code...
			break;
		case '4':
			# code...
			break;
		case '5':
			//Le formulaire n'est pas rempli ou une erreur est survenue.
			echo "  
			<div class='container'> 
			  <div class='alert alert-danger fade in'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <h4>Le formulaire n'est pas rempli ou une erreur est survenue.</h4>
			  </div>
			</div>";
			break;
		case '6':
			//Pas d'espace de stockage
			echo "  
			<div class='container'> 
			<div class='alert alert-warning fade in'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <h4>Votre espace de stockage est insuffisant !</h4>
			  </div>
			</div>";
			break;
		case '7':
			// Fichier déjà éxistant !
			echo "  
			<div class='container'> 
			  <div class='alert alert-warning fade in'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <h4>Ce fichier est déjà présent dans votre bibliothèque !</h4>
			  </div>
			</div>";
			break;
		default:
			# code...
			break;
	}
}


?>