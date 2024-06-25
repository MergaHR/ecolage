<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>S'inscrire</title>
    <link rel="icon" href="<?php echo base_url()?>assets/logoift.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php
    $alerte = $this->session->flashdata('alerte');
    if (!empty($alerte)) {
        echo $alerte;
    }
    ?>
</head>

<body style="background: url('<?php echo base_url()?>assets/img/cv-bureau.jpg') no-repeat; background-size: cover;">
    </br></br></br></br></br></br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fs-4 d-none d-sm-inline align-items-start">
                            <img src="<?php echo base_url()?>assets/ift.jpg" alt="" class="img-fluid" style="max-width: 70px; max-height: 50px;">
                        </span>
                        <h4 class="card-title mx-3 font-family-roboto text-center">S'inscrire</h4>
                        <span class="fs-4 d-none d-sm-inline align-items-end">
                            <img src="<?php echo base_url()?>assets/logoift.jpg" alt="" class="img-fluid" style="max-width: 70px; max-height: 50px;">
                        </span>
                    </div>

                    <div class="card-body">
                        <form id="registerForm" method="POST" action="<?php echo site_url('controlle/insertionCompte')?>">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="mb-3">
                                <label for="email" class="form-label">Nom utilisateur</label>
                                <input type="text" name="Nom_utilisateur" class="form-control" id="Nom_utilisateur" required minlength="1">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="Adresse_Email" class="form-control" id="Adresse_Email" required minlength="6">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" name="Mdp" class="form-control" id="Mdp" required minlength="3">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Confirmation mot de passe</label>
                                <input type="password" name="conf_Mdp" class="form-control" id="conf_Mdp" required minlength="3">
                            </div>
                            <div class="mb-3" hidden>
                                <label for="email" class="form-label">Id_type_compte</label>
                                <input type="number" name="type" class="form-control" id="type" value="3">
                            </div>
                            <!-- Ajouter d'autres champs d'inscription au besoin -->
                            <button id="submitButton" class="btn btn-primary w-100" type="submit">
                                <span class="spinner-border spinner-border-sm visually-hidden" role="status" aria-hidden="true"></span>
                                S'inscrire
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS de Bootstrap 5 (inclus Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript pour afficher le spinner lors de la soumission du formulaire -->
    <script>
        document.getElementById('registerForm').addEventListener('submit', function() {
            document.getElementById('submitButton').innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> En cours...';
            document.getElementById('submitButton').disabled = true;
        });
    </script>
</body>
</html>
