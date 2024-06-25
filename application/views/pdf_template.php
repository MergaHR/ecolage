
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
    <!-- Ajoutez des styles supplémentaires au besoin -->
</head>
<body><?php foreach ($rows as $row){?>
    <h1>~~~~~RECU~~~~~</h1>

    <h6>de Mr: <?php echo $row["Prenom_Etudiant"]; ?></h6>

    <h6>La somme de: <?php echo $row["Mention"]; ?></h6>

    <!-- Ajoutez dautres champs du formulaire ici -->

    <h6>Date: <?php echo date('Y-m-d'); ?></h6>

    <h6>Observation : aucun remboursement ne sera accepté quel que soit le motif</h6><?php } ?>
</body>
</html>