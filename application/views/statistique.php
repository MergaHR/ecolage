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
	<link rel="stylesheet" href="assets/style.css">
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

</div><!-- Modal -->
<form id="profileForm" action="<?= base_url('controlle/change_password'); ?>" method="post">
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenu du profil -->
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur:</label>
                        <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($this->session->userdata('admin_name')); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse e-mail:</label>
                        <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($this->session->userdata('admin_email')); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="oldPassword">Ancien mot de passe:</label>
                        <input type="password" class="form-control" id="oldPassword" name="ancien" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Nouveau mot de passe:</label>
                        <input type="password" class="form-control" id="newPassword" name="nouveau" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirmer le nouveau mot de passe:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirme" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Modifier le mot de passe</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Fin modal -->

			</div>
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
					
				
				<div class="container">
    <div class="row">
        <!-- Partie gauche de la page (espace restant) -->
        <div class="container">
    <div class="row g-1 text-center">
        <!-- Partie gauche de la page -->
        <div class="col-sm-6 col-md-8">
            <center>
                <div class="col-sm-5 col-lg-5">
                    <canvas id="myChart"></canvas>
                </div>
            </center>

            <br>
            <div class="col-md-12 card">
    <div class="card-header">
        <center><h5>Effectif par Mention</h5></center>  
    </div>
    <br>
    <div class="row row-cols-md-5 card-group">
        <?php
        // Vérifier si $mod est défini et n'est pas nul
        if (isset($mod) && (is_array($mod) || is_object($mod))) {
            // Initialiser le tableau pour stocker le compte de chaque mention
            $mentionCount = array();

            // Boucle à travers les étudiants pour compter les mentions
            foreach ($mod as $etudiant) {
                $mention = $etudiant->Mention;

                // Vérifier si la mention existe dans le tableau
                if (isset($mentionCount[$mention])) {
                    // Incrémenter le compteur de la mention existante
                    $mentionCount[$mention]++;
                } else {
                    // Ajouter la mention au tableau avec un compteur initial de 1
                    $mentionCount[$mention] = 1;
                }
            }

            // Afficher le compte de chaque mention dans les cartes
            foreach ($mentionCount as $mention => $count) {
                // Définir une classe CSS en fonction de la mention
                $class = '';
                switch ($mention) {
                    case 'Info':
                        $class = 'info-card';
                        break;
                    case 'GM':
                        $class = 'gestion-card';
                        break;
                    case 'BTP':
                        $class = 'batiment-card';
                        break;
                    case 'ICJ':
                        $class = 'communication-card';
                        break;
                    case 'Droit':
                        $class = 'droit-card';
                        break;
                    // Ajoutez d'autres cas au besoin
                }
        ?>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <!-- Ajouter la classe CSS à la carte -->
                    <div class="card border-primary mb-3 <?php echo $class; ?>" style="max-width: 14rem;">
                        <div class="card-header">
                            <!-- Ajouter des icônes ou des éléments spécifiques pour chaque mention -->
                            <?php
                            if ($mention == 'Info') {
                                echo '<i class="bi bi-pc-display"></i>';
                            } elseif ($mention == 'GM') {
                                echo '<i class="bi bi-building-gear"></i>';
                            } elseif ($mention == 'BTP') {
                                echo '<i class="bi bi-house-gear"></i>';
                            } elseif ($mention == 'ICJ') {
                                echo '<i class="bi bi-camera-reels"></i>';
                            } elseif ($mention == 'Droit') {
                                echo '<i class="bi bi-file-earmark-text"></i>';
                            }
                            ?>
                            <p class="ms d-inline"><?php echo $mention; ?></p>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $count; ?></h3>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            // Gérer le cas où $mod n'est pas défini ou est nul
            echo "Aucune donnée d'étudiant disponible.";
        }
        ?>
    </div></div>
    </div>

        <!-- Partie droite de la page (votre carte) -->
        <div class="col-6 col-md-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Coût par An en Ariary</h5>
            </div><br>
            <div class="card-body">
                <?php
                if (isset($modniv) && (is_array($modniv) || is_object($modniv))) {
                    foreach ($modniv as $niveau) {
                        echo  '<p class="card-text">'. $niveau->Grade . ':</p>';
                        echo '<h2 class="card-title" style="color: blue;">' . $niveau->Cout_niveau . '</h2>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<span class="fs-4 d-none d-sm-inline" > <img src="<?php echo base_url()?>assets/recu.jpg" alt="" ></span>
    </div>
</div>

						
					
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
 						 const ctx = document.getElementById('myChart');

							  new Chart(ctx, {
							    type: 'doughnut',
							    data: {
							      labels: ['Payer', 'Impayer'],
 							     datasets: [{
							        label: '# effectuer',
							        data: [12, 19],
							        borderWidth: 1
							      }]
							    },
							    /*options: {
							      scales: {
							        y: {
							          beginAtZero: true
							        }
							      }
							    }*/
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