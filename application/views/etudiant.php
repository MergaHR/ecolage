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

	<title> Suivi du payement </title>
</head>
<?php
   $alerte = $this->session->flashdata('alerte');
   if (!empty($alerte)) {
      echo $alerte;
   }
?>
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
                     <div class="col-sm-6 col-md-8 "><h3><i class="fs-4 fa fa-user-graduate"></i>Liste d'etudiant</h3></div>
                    <div class="col-6 col-md-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                       <!-- Button trigger modal --><?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#etudiantModal"><i class="fs-5 fa fa-pen-to-square"></i>Inscrire</button>
                       <?php } ?></div>
                    </div>
                    </div>
                   <!-- Barre de recherche -->
<div class="row mb-2">
    <form action="<?php echo site_url('controlle/search_keyword')?>" method="post" class="d-flex align-items-center">
        <div class="col-4">
            <label for="search_text" class="visually-hidden">Recherche...</label>
            <input type="text" id="search_text" name="keyword" class="form-control" placeholder="Recherche..." required minlength="3">
        </div>
        <div class="col">
            <input type="submit" class="btn btn-primary" value="Rechercher">
        </div>
    </form>
</div>

                </div>
                <!-- Ajoutez ces liens vers les fichiers CSS et JavaScript de Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                <div class="card-body">
                <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Sexe</th>
            <th scope="col">Adresse</th>
            <th scope="col">Telephone</th>
            <th scope="col">Mention</th>
            <th scope="col">Niveau</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * 4;
    if (isset($mod) && (is_array($mod) || is_object($mod))) :
    ?>
        <tbody>
            <?php for ($i = $start; $i < min($start + 4, count($mod)); $i++) : ?>
                <tr>
                    <th scope="row"><?php echo $mod[$i]->Numero_Matricule; ?></th>
                    <td><?php echo $mod[$i]->Nom_Etudiant; ?></td>
                    <td><?php echo $mod[$i]->Prenom_Etudiant; ?></td>
                    <td><?php echo $mod[$i]->Sexe; ?></td>
                    <td><?php echo $mod[$i]->Adresse; ?></td>
                    <td><?php echo $mod[$i]->Numero_telephone; ?></td>
                    <td><?php echo $mod[$i]->Mention; ?></td>
                    <td><?php echo $mod[$i]->Niveau; ?></td>
                    <td>
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#etudiantModalModif_<?php echo $mod[$i]->Numero_Matricule; ?>">
                            <i class="fs-6 fa fa-pen-to-square"></i>
                        </button>
                        <a type="button" class="btn btn-outline-danger" href="<?php echo site_url('controlle/supprimerEtudiant/' . $mod[$i]->Numero_Matricule) ?>">
                            <i class="fs-6 fa fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    <?php endif ?>
</table>
<div class="pagination-container mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            // Calcul du nombre de pages
            $totalPages = ceil(count($mod) / 4);

            // Récupérer le numéro de la page actuelle à partir de la requête GET
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            // Bouton "Précédent"
            if ($currentPage > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Précédent</a></li>';
            }

           // Afficher le lien vers la page 1
           echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';

           // Afficher le lien vers la page 2 si elle existe
           if ($totalPages > 1) {
               echo '<li class="page-item"><a class="page-link" href="?page=2">2</a></li>';
           }

            // Bouton "Suivant"
            if ($currentPage < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Suivant</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>


                </div>
                <div class="card-footer">
                  
                <center>Institut de Formation Technique </center>
                  <form method="POST" action="<?php echo site_url('controlle/inscrirEtudiant')?>">
                <div class="modal fade lg" id="etudiantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Inscription un(e) etudiant(e)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           

          <div class="row mb-2">
  <div class="col" hidden>
  <label for="formGroupExampleInput" class="form-label">Numero Matricule</label>
    <input type="text" class="form-control" placeholder="Matricule" aria-label="Matricule" name="Matricule">
  </div>
  <div class="col">  
  <label for="formGroupExampleInput" class="form-label">Nom etudiant</label>
  <input type="text" class="form-control" placeholder="Nom etudiant" aria-label="Nom etudiant" name="Nom">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Prenom etudiant</label>
    <input type="text" class="form-control" placeholder="Prenom etudiant" aria-label="Prenom etudiant" name="Prenom">
  </div>
</div>
<div class="row mb-2">  
<div class="col">
  <label for="formGroupExampleInput" class="form-label">Date de naissance</label>
    <input type="date" class="form-control" name="Datenaissance" >
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Adresse</label>
    <input type="text" class="form-control" placeholder="Adresse" aria-label="Adresse" name="Adresse">
  </div>
  <!-- Champ de formulaire caché pour le sexe -->
<input type="hidden" id="selectedSexe" name="Sexe" value="">

<!-- Votre section de boutons radio -->
<div class="col">
    <label for="formGroupExampleInput" class="form-label">Sexe</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Homme">
        <label class="form-check-label" for="flexRadioDefault1">
            Homme
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Femme">
        <label class="form-check-label" for="flexRadioDefault2">
            Femme
        </label>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un bouton radio est sélectionné
        $('input[type=radio][name=flexRadioDefault]').change(function() {
            // Récupérer la valeur du bouton radio sélectionné
            var selectedSexe = $(this).val();
            // Mettre à jour la valeur du champ de formulaire caché
            $('#selectedSexe').val(selectedSexe);
        });
    });
</script>

</div>

<div class="row mb-2">
  <div class="col-auto">
  <label for="formGroupExampleInput" class="form-label">Numero Telephone</label>
    <input type="text" class="form-control" placeholder="Telephone" aria-label="Telephone" name="Telephone">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Email</label>
  <input type="text" class="form-control" placeholder="Email" aria-label="Email" name="Email">
  </div>
</div>
<!-- Champ de formulaire caché -->
<input type="hidden" id="selectedMention" name="Mention" value="">
<!-- Champ de formulaire caché -->
<input type="hidden" id="selectedNiveau" name="Niveau" value="">

<div class="row mb-2">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Mention</label>
    <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" name="Mention" aria-expanded="false">
    Mention
  </button> <?php if(isset($modmen) && (is_array($modmen) || is_object($modmen))): ?>
  <ul class="dropdown-menu"><?php foreach ($modmen as $mention) { ?>
    <li><button class="dropdown-item mention-item" type="button"><?php echo $mention->Nom_Mention; ?></button></li>

    <?php } ?>
  </ul>
   <?php endif?>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un dropdown-item est cliqué
        $('.mention-item').on('click', function() {
            // Récupérer le texte du dropdown-item sélectionné
            var selectedText = $(this).text();
            // Mettre à jour le texte du dropdown-toggle avec la valeur sélectionnée
            $('#dropdownMenuButton').text(selectedText);
            $('#selectedMention').val(selectedText);
        });
    });
</script>
  </div>
  <div class="col-auto">
  <label for="formGroupExampleInput" class="form-label">Niveau</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" id="dropdownMenuButton2" type="button" data-bs-toggle="dropdown" name="Niveau" aria-expanded="false">
    Niveau
  </button><?php if(isset($modniv) && (is_array($modniv) || is_object($modniv))): ?>
  <ul class="dropdown-menu"><?php foreach($modniv as $niveau): ?>
    <li><button class="dropdown-item niveau-item" type="button"><?php echo $niveau->Grade;?></button></li>
    
    <?php endforeach;?>
  </ul><?php endif?>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un dropdown-item est cliqué
        $('.niveau-item').on('click', function() {
            // Récupérer le texte du dropdown-item sélectionné
            var selectedText = $(this).text();
            // Mettre à jour le texte du dropdown-toggle avec la valeur sélectionnée
            $('#dropdownMenuButton2').text(selectedText);
            $('#selectedNiveau').val(selectedText);
        });
    });
</script>
  </div>
</div>
<!-- Include jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
   $(document).ready(function() {
      $('.dropdown-toggle').dropdown();
   });
</script>


<div class="row mb-2">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Responsable</label>
    <input type="text" class="form-control" placeholder="Responsable" aria-label="Responsable" name="responsable">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Fonction</label>
  <input type="text" class="form-control" placeholder="Fonction" aria-label="Fonction" name="Fonction">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Email responsable</label>
    <input type="text" class="form-control" placeholder="Email responsable" aria-label="Email responsable" name="Emailresponsable">
  </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-success"><i class="bi bi-check"></i>Effectuer</button>
          </div>
        </div>
        </form>
      </div>
    </div>

     <!-- Modal pour la modification -->

    <?php foreach ($mod as $etudiant) { ?>
      <form method="POST" action="<?php echo site_url('controlle/ModifierEtudiant')?>">
                <div class="modal fade lg" id="etudiantModalModif_<?php echo $etudiant->Numero_Matricule; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modification d'un(e) etudiant(e)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           

          <div class="row mb-2">
  <div class="col" hidden>
  <label for="formGroupExampleInput" class="form-label">Numero Matricule</label>
    <input type="text" class="form-control" placeholder="Matricule" aria-label="Matricule" name="Matricule" value=" <?php echo $etudiant->Numero_Matricule; ?>">
  </div>
  <div class="col">  
  <label for="formGroupExampleInput" class="form-label">Nom etudiant</label>
  <input type="text" class="form-control" placeholder="Nom etudiant" aria-label="Nom etudiant" name="Nom" value="<?php echo $etudiant->Nom_Etudiant; ?>">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Prenom etudiant</label>
    <input type="text" class="form-control" placeholder="Prenom etudiant" aria-label="Prenom etudiant" name="Prenom" value="<?php echo $etudiant->Prenom_Etudiant; ?>">
  </div>
</div>
<div class="row mb-2">  
<div class="col">
  <label for="formGroupExampleInput" class="form-label">Date de naissance</label>
    <input type="date" class="form-control" name="Datenaissance" value="<?php echo $etudiant->Date_Naissance; ?>">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Adresse</label>
    <input type="text" class="form-control" placeholder="Adresse" aria-label="Adresse" name="Adresse" value="<?php echo $etudiant->Adresse; ?>">
  </div>
  <!-- Champ de formulaire caché pour le sexe -->
<input type="hidden" id="selectedSexe" name="Sexe"  value="<?php echo $etudiant->Sexe; ?>"value="">

<!-- Votre section de boutons radio -->
<div class="col" hidden>
    <label for="formGroupExampleInput" class="form-label">Sexe</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Masculin">
        <label class="form-check-label" for="flexRadioDefault1">
            Homme
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Feminin">
        <label class="form-check-label" for="flexRadioDefault2">
            Femme
        </label>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un bouton radio est sélectionné
        $('input[type=radio][name=flexRadioDefault]').change(function() {
            // Récupérer la valeur du bouton radio sélectionné
            var selectedSexe = $(this).val();
            // Mettre à jour la valeur du champ de formulaire caché
            $('#selectedSexe').val(selectedSexe);
        });
    });
</script>

</div>

<div class="row mb-2">
  <div class="col-auto">
  <label for="formGroupExampleInput" class="form-label">Numero Telephone</label>
    <input type="text" class="form-control" placeholder="Telephone" aria-label="Telephone" name="Telephone" value="<?php echo $etudiant->Numero_telephone; ?>">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Email</label>
  <input type="text" class="form-control" placeholder="Email" aria-label="Email" name="Email" value="<?php echo $etudiant->Email; ?>">
  </div>
</div>
<!-- Champ de formulaire caché -->
<input type="hidden" id="selectedMentionmod_<?php echo $etudiant->Numero_Matricule; ?>" name="Mention" value="">
<!-- Champ de formulaire caché -->
<input type="hidden" id="selectedNiveaumod_<?php echo $etudiant->Numero_Matricule; ?>" name="Niveau" value="">

<div class="row mb-2" >
  <div class="col" hidden>
  <label for="formGroupExampleInput" class="form-label">Mention</label>
    <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" id="dropdownMenuButton_<?php echo $etudiant->Numero_Matricule; ?>" type="button"  data-bs-toggle="dropdown" name="Mention" aria-expanded="false">
            <?php echo $etudiant->Mention; ?> <!-- Eto ilay anaran"ny button dropdown-->
  </button> <?php if(isset($modmen) && (is_array($modmen) || is_object($modmen))): ?>
  <ul class="dropdown-menu"><?php foreach ($modmen as $mention) { ?>
    <li><button class="dropdown-item mention-item" type="button"><?php echo $mention->Nom_Mention; ?></button></li>

    <?php } ?>
  </ul>
   <?php endif?>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un dropdown-item est cliqué
        $('.mention-item').on('click', function() {
            // Récupérer le texte du dropdown-item sélectionné
            var selectedText = $(this).text();
            // Mettre à jour le texte du dropdown-toggle avec la valeur sélectionnée
            $('#dropdownMenuButton_<?php echo $etudiant->Numero_Matricule; ?>').text(selectedText);
            $('#selectedMentionmod_<?php echo $etudiant->Numero_Matricule; ?>').val(selectedText);
        });
    });
</script>
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Niveau</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" id="dropdownMenuButton2_<?php echo $etudiant->Numero_Matricule; ?>" type="button" data-bs-toggle="dropdown" name="Niveau" aria-expanded="false">
          <?php echo $etudiant->Niveau; ?> <!-- Eto ilay anaran"ny button dropdown-->
  </button><?php if(isset($modniv) && (is_array($modniv) || is_object($modniv))): ?>
  <ul class="dropdown-menu"><?php foreach($modniv as $niveau): ?>
    <li><button class="dropdown-item niveau-item" type="button"><?php echo $niveau->Grade; ?></button></li>
    <?php endforeach;?>
  </ul><?php endif?>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un dropdown-item est cliqué
        $('.niveau-item').on('click', function() {
            // Récupérer le texte du dropdown-item sélectionné
            var selectedText = $(this).text();
            // Mettre à jour le texte du dropdown-toggle avec la valeur sélectionnée
            $('#dropdownMenuButton2_<?php echo $etudiant->Numero_Matricule; ?>').text(selectedText);
            $('#selectedNiveaumod_<?php echo $etudiant->Numero_Matricule; ?>').val(selectedText);
        });
    });
</script>
  </div>
</div>

<div class="row mb-2">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Responsable</label>
    <input type="text" class="form-control" placeholder="Responsable" aria-label="Responsable" name="responsable" value="<?php echo $etudiant->Responsable; ?>">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Fonction</label>
  <input type="text" class="form-control" placeholder="Fonction" aria-label="Fonction" name="Fonction" value="<?php echo $etudiant->Fonction; ?>">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Email responsable</label>
    <input type="text" class="form-control" placeholder="Email responsable" aria-label="Email responsable" name="Emailresponsable" value="<?php echo $etudiant->Email_Responsable; ?>">
  </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-success"><i class="bi bi-check"></i>Enregistrer</button>
          </div>
        </div>
       
      </div>
    </div> </div></div></div>   </form>
    <?php } ?>
                </div>
            </div>

        </div>
</div>
	</div>

<script src="<?php echo base_url()?>assets/Bootstrap/js/bootstrap.bundle.js"></script>
<!-- JS de Bootstrap (inclus jQuery et Popper.js) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <!-- JS de Bootstrap 5 (inclus Popper.js) -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>