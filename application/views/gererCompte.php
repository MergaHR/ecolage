<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/fontawesome-free-6.0.0-beta3-web/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
	<link rel="icon" href="<?php echo base_url()?>assets/logoift.jpg">
	<script src="<?php echo base_url()?>assets/chart/dist/chart.min.js"></script>

<!-- CSS de Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- JS de Bootstrap (inclus jQuery et Popper.js) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- CSS de Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<title> Gerer Employer</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row flex-nowrap">
			<div class="bg-dark col-auto col-md-4 col-lg-3 min-vh-100 " >
				<div class="gb-dark p-2">
					<a class="d-flex text-decoration-none mt-1 align-items-center text-white" >
						
						<span class="fs-4 d-none d-sm-inline" > <img src="<?php echo base_url()?>assets/ift.jpg" alt="" ></span>
					</a>
					<ul class="nav nav-pills flex-column mt-4">
                    <?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
						<li class="nav-item py-2 py-sm-0">
							<a href="<?php echo site_url('controlle/statistique')?>" class="nav-link text-white" aria-current="page">
								<i class="fs-4 fa fa-gauge"></i>
								<span class="fs-4 ms-3 d-none d-sm-inline">Statistique</span>
							</a>
						</li><?php } ?>
						<li class="nav-item py-2 py-sm-0">
							<a href="<?php echo site_url('controlle/payement')?>" class="nav-link text-white" aria-current="page">
								<i class="fs-4 fa fa-money-check-dollar"></i>
								<span class="fs-4 ms-3 d-none d-sm-inline">Paiement</span>
							</a>
						</li>
						<li class="nav-item py-2 py-sm-0">
							<a href="<?php echo site_url('controlle/verification')?>" class="nav-link text-white" aria-current="page">
								<i class="fs-4 fa fa-clipboard-check"></i>
								<span class="fs-4 ms-4 d-none d-sm-inline">Verification</span>
							</a>
						</li><?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
						<li class="nav-item py-2 py-sm-0">
							<a href="<?php echo site_url('controlle/etudiant')?>" class="nav-link text-white" aria-current="page">
								<i class="fs-4 fa fa-user-graduate"></i>
								<span class="fs-4 ms-4 d-none d-sm-inline">Etudiant</span>
							</a>
						</li><?php } ?>
						<li class="nav-item py-2 py-sm-0">
							<a href="<?php echo site_url('controlle/mention')?>" class="nav-link text-white" aria-current="page">
								<i class="fs-4 fa fa-graduation-cap"></i>
								<span class="fs-4 ms-3 d-none d-sm-inline">Mention</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo site_url('controlle/niveau')?>" class="nav-link text-white" aria-current="page">
								<i class="fs-4 fa fa-brain"></i>
								<span class="fs-4 ms-4 d-none d-sm-inline">Niveau</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="dropdown open p-3">
    <button class="btn border-none dropdown-toggle text-white" type="button" id="triggerId" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-user"></i><span class="ms-2 d-none d-sm-inline"><?php echo $this->session->userdata('admin_name'); ?></span>
    </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">Profile</a>
    <?php if ($this->session->userdata('type_compte') == 1 ){ ?>
    <a class="dropdown-item" href="<?php echo base_url('index.php/controlle/GererCompte')?>">Gérer Compte</a>
    <?php } ?>  
    <?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
    <a class="dropdown-item" href="<?php echo base_url('index.php/controlle/GererEmp')?>">Gérer Employées</a>
    <?php } ?>  
        <a class="dropdown-item" href="<?php echo base_url('index.php/controlle/Logout')?>">Deconnexion</a>
    </div>
</div></div>
			<!--content-->
			<div class="col-lg ">
			<nav class="navbar">
  				<div class="container">
    				<a class="navbar-brand text-dark"><h5>Compte: <?php echo $this->session->userdata('admin_name'); ?></h5></a>
            <a href="<?php echo base_url('index.php/controlle/Logout')?>"> 
                    <button class="btn btn-outline-info text-dark" type="submit">
                      <i class="fa-solid  fa-arrow-right-from-bracket"></i>
						<p class="ms-2 d-none d-sm-inline">Deconnexion</p>
					 </button>
                    </a>
      			</div>
			</nav>
            <!--Ato aby ny tantara-->
			<div class="container">
            <div class="card">
            <div class="card-header">
                    <div class="row g-0 text-center">
                     <div class="col-sm-6 col-md-8 ">
                      <h3><i class="fs-4 fa fa-user">
                         </i>Compte Enregistrer <span class="badge bg-secondary"><?php $nombreDeLignes = count($modGr); ?>
    <!-- Affichez le nombre de lignes si nécessaire -->
    <?php echo $nombreDeLignes; ?></span>
                      </h3>
                     </div>                     
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-striped table-hover">
  <thead>
    <tr>
    
      <th scope="col">ID</th>
      <th scope="col">Nom utilisateur</th>
      <th scope="col">Adresse Email</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
	</thead><?php if(isset($modGr) && (is_array($modGr) || is_object($modGr))): ?>
  <tbody><?php foreach ($modGr as $compte) { ?>
    <?php 
        $nom_type_compte = '';
        if ($compte->Id_type_compte == 1) {
            $nom_type_compte = 'Administrateur';
        } elseif ($compte->Id_type_compte == 2) {
            $nom_type_compte = 'Gestionnaire';
        } elseif ($compte->Id_type_compte == 3) {
            $nom_type_compte = 'Etudiant(e)';
        } else {
            // Si le type de compte n'est ni 1 ni 2, passe à l'itération suivante
            continue;
        }
    ?>
    <tr>
        <th scope="row"><?php echo isset($compte->Id_compte) ? $compte->Id_compte : ''; ?></th>
        <td><?php echo isset($compte->Nom_utilisateur) ? $compte->Nom_utilisateur : ''; ?></td>
        <td><?php echo isset($compte->Adresse_Email) ? $compte->Adresse_Email : ''; ?></td>
        <td><?php echo $nom_type_compte; ?></td>
        <td>
            <a type="button" class="btn btn-outline-danger" href="<?php echo site_url('controlle/supprimerCompte/'.$compte->Id_compte) ?>">
                Supprimer
            </a>
        </td>
    </tr>
<?php } ?>



  </tbody>
<?php endif ?>

  </tbody>
</table>
</div>
                <div class="card-footer">
				<center>Institut de Formation Technique </center>
</div>
  </div>
  </div><div class="modal fade lg" id="EmployeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
	  <form method="post" action="<?php echo site_url('controlle/insertionCompteEmp')?>">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajout d'un employé</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="row mb-4">
  
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Nom utilisateur</label>
    <input type="text" class="form-control" placeholder="Nom utilisateur" aria-label="Nom_utilisateur" name="Nom_utilisateur" required="">
  </div>
</div>
<div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Adresse Email</label>
    <input type="text" class="form-control" placeholder="Email" aria-label="Adresse_Email" name="Adresse_Email" required="">
  </div>
</div>
  <!-- Champ de formulaire caché -->
<input type="hidden" id="selectedRole" name="Role" value="">
<div class="row mb-4">
    <div class="col">
        <label for="formGroupExampleInput" class="form-label">Role</label>
        <div class="dropdown-center">
            <button class="btn btn-outline-secondary dropdown-toggle form-control" id="dropdownRole" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Role
            </button>
            <?php if(isset($modtype) && (is_array($modtype) || is_object($modtype))): ?>
                <ul class="dropdown-menu">
                    <?php foreach ($modtype as $type_compte) { ?>
                        <?php 
                            $Id_type_compte = '';
                            if ($type_compte->Nom_type =='Administrateur' ) {
                                $Id_type_compte = 1;
                            } elseif ($type_compte->Nom_type =='Gestionnaires' ) {
                                $Id_type_compte = 2;
                            } else {
                                // Si le type de compte n'est ni 1 ni 2, passe à l'itération suivante
                                continue;
                            }
                        ?>
                        <li><button class="dropdown-item typeCompte-item" type="button" data-id="<?php echo $Id_type_compte; ?>"><?php echo $type_compte->Nom_type; ?></button></li>
                    <?php } ?>
                </ul>
            <?php endif?>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un dropdown-item est cliqué
        $('.typeCompte-item').on('click', function() {
            // Récupérer le texte du dropdown-item sélectionné
            var selectedText = $(this).text();
            // Mettre à jour le texte du dropdown-toggle avec la valeur sélectionnée
            $('#dropdownRole').text(selectedText);
            
            // Récupérer la valeur associée au type de compte
            var selectedId = $(this).data('id');
            // Mettre à jour la valeur du champ de formulaire caché
            $('#selectedRole').val(selectedId);
        });
    });
</script>

<div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Mot de passe défaut</label>
    <input type="text" class="form-control" aria-label="Mdp" name="Mdp" value="gestionnaireIFT" readonly>
  </div>
</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-success">Ajouter</button>
          </div>
        </div></from>
      </div>
    </div>
  </div>           
 </div></div>
        </div>
  </form><!-- ... Votre code HTML précédent ... -->

<!-- Ajoutez le code JavaScript après l'inclusion de jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('.btn-outline-info').click(function(){
        var matricule = $(this).data('matricule');
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("controlle/search_keywordhisto"); ?>',
            data: { matricule: matricule },
            success: function(response) {
                // Mettez à jour le contenu de la modal avec les données récupérées
                $('#historiqueModal .modal-body').html(response);
                // Affichez la modal
                $('#historiqueModal').modal('show');
            }
        });
    });
});
</script>

</body>
</html>



               
	</div>

<script src="<?php echo base_url()?>assets/Bootstrap/js/bootstrap.bundle.js"></script>
<!-- JS de Bootstrap (inclus jQuery et Popper.js) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <!-- JS de Bootstrap 5 (inclus Popper.js) -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>