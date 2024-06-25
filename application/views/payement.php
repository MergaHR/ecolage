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
      <br><br><br>
      <?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
            <!--Ato aby ny tantara-->
            <form method="POST" action="<?php echo site_url('controlle/Payer')?>">
		<div class="container">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
    <h3>Effectuer une paiement <i class="bi bi-check2-all"></i></h3>
    <a type="button" class="btn btn-secondary position-relative" href="<?php echo site_url('controlle/payementEtu')?>">
        Paiement
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        <?php $nombreDeLignes = count($modpayetu); ?>
    <!-- Affichez le nombre de lignes si nécessaire -->
    <?php echo $nombreDeLignes; ?>
            <span class="visually-hidden">unread messages</span>
        </span>
        </a>
</div>

             <div class="card-body">
             <div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Numero Matricule</label>
    <input type="number" class="form-control" placeholder="Matricule" aria-label="Matricule" name="Matricule">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Date de paiement</label>
    <input type="date" class="form-control" name="DatePayer">
  </div>
</div>
<div class="row mb-4" hidden>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Code mention</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Mention
  </button>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item" type="button">Informatique</button></li>
    <li><button class="dropdown-item" type="button">Gestion et Management</button></li>
    <li><button class="dropdown-item" type="button">Batiment et Traveaux Publique</button></li>
  </ul>
</div>
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Code niveau</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Niveau
  </button>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item" type="button">L1</button></li>
    <li><button class="dropdown-item" type="button">L2</button></li>
    <li><button class="dropdown-item" type="button">M1</button></li>
  </ul>
</div>
  </div>
</div>
<!-- Champ de formulaire caché -->
<input type="hidden" id="selectedModeP" name="ModePayer" value="">
<div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Tranche de paiement</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" id="dropdownPayement" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Tranche de paiement
  </button> <?php if(isset($modpay) && (is_array($modpay) || is_object($modpay))): ?>
  <ul class="dropdown-menu"><?php foreach ($modpay as $modepayement) { ?>
    <li><button class="dropdown-item payement-item" type="button"><?php echo $modepayement->Nom; ?></button></li>
	<?php } ?>
  </ul>
    <?php endif?>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un dropdown-item est cliqué
        $('.payement-item').on('click', function() {
            // Récupérer le texte du dropdown-item sélectionné
            var selectedText = $(this).text();
            // Mettre à jour le texte du dropdown-toggle avec la valeur sélectionnée
            $('#dropdownPayement').text(selectedText);
            $('#selectedModeP').val(selectedText);
        });
    });
</script>

  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Motif</label>
    <input type="text" class="form-control" placeholder="Motif" aria-label="Motif" name="Motif">
  </div>
</div>
<div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Montant</label>
    <input type="text" class="form-control" placeholder="Montant" aria-label="Montant" name="Montant">
  </div>
  <div class="col" hidden>
  <label for="formGroupExampleInput" class="form-label">Reste a payer</label>
    <input type="text" class="form-control" placeholder="Reste a payer" aria-label="Reste a payer">
  </div>
</div>
             </div>
             <div class="card-footer">
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn btn-success" ><i class="bi bi-cash-stack"></i>Payer</button>
            </div>
            </div>
  </form>
  <?php } ?>
  
  <?php if ($this->session->userdata('type_compte') == 3){ ?>
  <form method="POST" action="<?php echo site_url('controlle/PayerEtu')?>">
		<div class="container">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
    <h3>Effectuer une paiement <i class="bi bi-check2-all"></i></h3>
</div>

             <div class="card-body">
             <div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Numero Matricule</label>
    <input type="number" class="form-control" placeholder="Matricule" aria-label="Matricule" name="Matricule">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Date de paiement</label>
    <input type="date" class="form-control" name="DatePayer">
  </div>
</div>
<div class="row mb-4" hidden>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Code mention</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Mention
  </button>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item" type="button">Informatique</button></li>
    <li><button class="dropdown-item" type="button">Gestion et Management</button></li>
    <li><button class="dropdown-item" type="button">Batiment et Traveaux Publique</button></li>
  </ul>
</div>
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Code niveau</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Niveau
  </button>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item" type="button">L1</button></li>
    <li><button class="dropdown-item" type="button">L2</button></li>
    <li><button class="dropdown-item" type="button">M1</button></li>
  </ul>
</div>
  </div>
</div>
<!-- Champ de formulaire caché -->
<input type="hidden" id="selectedModeP" name="ModePayer" value="">
<div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Tranche de paiement</label>
  <div class="dropdown-center">
  <button class="btn btn-outline-secondary dropdown-toggle form-control" id="dropdownPayement" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Tranche de paiement
  </button> <?php if(isset($modpay) && (is_array($modpay) || is_object($modpay))): ?>
  <ul class="dropdown-menu"><?php foreach ($modpay as $modepayement) { ?>
    <li><button class="dropdown-item payement-item" type="button"><?php echo $modepayement->Nom; ?></button></li>
	<?php } ?>
  </ul>
    <?php endif?>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lorsqu'un dropdown-item est cliqué
        $('.payement-item').on('click', function() {
            // Récupérer le texte du dropdown-item sélectionné
            var selectedText = $(this).text();
            // Mettre à jour le texte du dropdown-toggle avec la valeur sélectionnée
            $('#dropdownPayement').text(selectedText);
            $('#selectedModeP').val(selectedText);
        });
    });
</script>

  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Motif</label>
    <input type="text" class="form-control" placeholder="Motif" aria-label="Motif" name="Motif">
  </div>
</div>
<div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Montant</label>
    <input type="text" class="form-control" placeholder="Montant" aria-label="Montant" name="Montant">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Preuve</label>
  <input type="file" class="form-control" id="inputGroupFile02" name="Preuve">
  </div>

  <div class="col" hidden>
  <label for="formGroupExampleInput" class="form-label">Reste a payer</label>
    <input type="text" class="form-control" placeholder="Reste a payer" aria-label="Reste a payer">
  </div>
</div>
             </div>
             <div class="card-footer">
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn btn-success" ><i class="bi bi-cash-stack"></i>Payer</button>
            </div>
            </div>
  </form>
  <?php } ?>

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