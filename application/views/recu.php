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
            <form method="POST" action="">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <center><span class="d-none d-sm-inline"><img src="<?php echo base_url()?>assets/recu.jpg" alt=""></span></center>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <center><h3>~~~~~RECU~~~~~</h3></center>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"><h6>de Mr:</h6></label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticAmount" class="col-sm-2 col-form-label"><h6>La somme de:</h6></label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticAmount" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticPurpose" class="col-sm-2 col-form-label"><h6>Pour:</h6></label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticPurpose" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticClass" class="col-sm-2 col-form-label"><h6>Classe de:</h6></label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticClass" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticDate" class="col-sm-2 col-form-label"><h6>Date:</h6></label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticDate" value="">
                        </div>
                    </div>
                    <center><h6>Observation: aucun remboursement ne sera accepté quel que soit le motif</h6></center>
                </div>
            </div>
            <div class="card-footer">
                <nav class="navbar">
                    <div class="container">
                        <button type="submit" name="generer_pdf" class="btn btn-outline-info d-grid gap-2 col-2">
                            <i class="fs-6 fa fa-file-pdf"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary d-grid gap-2 col-2">
                            <i class="fa-regular fa-paper-plane"></i>
                        </button>
            </div>
			</nav>
              
            </div>
  </form>


  <!-- Include jQuery (you can also use vanilla JS) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<!-- Add this script at the end of your HTML view file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Ajoutez ce script à votre vue principale ou à votre fichier JavaScript externe -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            // Envoyez les données du formulaire via AJAX au contrôleur
            $.ajax({
                url: "<?php echo base_url('controlle/generate_pdf'); ?>",
                type: "POST",
                data: {
                    // Envoyez les données du formulaire ici
                    name: $("#staticEmail").val(),
                    amount: $("#staticAmount").val(),
                    purpose: $("#staticPurpose").val(),
                    class: $("#staticClass").val(),
                    date: $("#staticDate").val(),
                    // Ajoutez d'autres champs du formulaire ici
                },
                success: function(response) {
                    // Gestion de la réponse si nécessaire
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Gestion des erreurs si nécessaire
                    console.error(error);
                }
            });
        });
    });
</script>

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