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
                     <div class="col-sm-6 col-md-8 "><h3><i class="fs-4 fa fa-brain"></i>Niveau</h3></div>
                    <div class="col-6 col-md-4"><?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#niveauModal"><i class="fs-5 fa fa-add"></i>Ajouter</button>
                        </div><?php } ?>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-striped table-hover">
  
  <thead>
    <tr>
      <th>Code niveau</th>
      <th>Grade</th>
      <th>Coût niveau</th>
      <?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
      <th>Action</th>
      <?php } ?>
    </tr>
  </thead>
  <?php if(isset($modniv) && (is_array($modniv) || is_object($modniv))): ?>
    
  <tbody><?php foreach($modniv as $niveau): ?>
    <tr>
      <th><?php echo $niveau->Code_Niveau; ?></th>
      <td><?php echo $niveau->Grade; ?></td>
      <td><?php echo $niveau->Cout_niveau; ?></td>
      <?php if ($this->session->userdata('type_compte') == 1 or $this->session->userdata('type_compte') == 2){ ?>
      <td>
	    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#niveauModalModif_<?php echo $niveau->Code_Niveau; ?>">
			<i class="fs-6 fa fa-pen-to-square"></i>
		</button>
        <a type="button" class="btn btn-outline-danger" 
		 	href="<?php echo site_url('controlle/supprimerNiveau/'.$niveau->Code_Niveau)?>"> 
		 	<i class="fs-6 fa fa-trash-can"></i>
		</a>
	  </td>
    <?php } ?>
    </tr>
    <?php endforeach;?>
  </tbody>
  <?php endif?>
</table>
                </div>
				
                <div class="card-footer">
                <center>Institut de Formation Technique </center>
                <div class="modal fade lg" id="niveauModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
	  <form method="post" action="<?php echo site_url('controlle/ajoutNiveau')?>">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajout d'une nouvelle grade</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="row mb-4">
  <div class="col" hidden>
  <label for="formGroupExampleInput" class="form-label">Code niveau</label>
    <input type="text" class="form-control" placeholder="Code niveau" aria-label="Code niveau" name="code">
  </div>
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Grade</label>
    <input type="text" class="form-control" placeholder="Grade" aria-label="Grade" name="grade" required="">
  </div>
</div>
<div class="row mb-4">
  <div class="col">
  <label for="formGroupExampleInput" class="form-label">Coût</label>
    <input type="text" class="form-control" placeholder="Cout" aria-label="Cout" name="cout_niveau" required="">
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
    <?php foreach($modniv as $niveau): ?>
    <!-- Modal pour la modification -->
    <div class="modal fade lg" id="niveauModalModif_<?php echo $niveau->Code_Niveau; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo site_url('controlle/ModifierNiveau')?>">    
	<div class="modal-dialog">
            
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modification du grade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col" hidden>
                                <label for="formGroupExampleInput" class="form-label">Code niveau</label>
                                <input type="text" class="form-control" placeholder="Code niveau" aria-label="Code niveau" name="Code" value="<?php echo $niveau->Code_Niveau; ?>">
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">Grade</label>
                                <input type="text" class="form-control" placeholder="Grade" aria-label="Grade" name="Grade" value="<?php echo $niveau->Grade; ?>" required="">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">Coût</label>
                                <input type="text" class="form-control" placeholder="Cout" aria-label="Cout" name="Cout_niveau" value="<?php echo $niveau->Cout_niveau; ?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </div>
            
        </div></form>
    </div>
<?php endforeach; ?>
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