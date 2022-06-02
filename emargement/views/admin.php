<?php
session_start();
require('../model/database.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('styleLinks.php') ?>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <title>Dashbord-admin</title>
</head>

<body>
    <div class="">
        <nav class="disp-flex justify-between align-items-center pad-10">
            <h1 class="text-white">Tableau de bord</h1>
            <div class="row">
                <ul class="nav disp-flex align-items-center">
                    <li class="nav-item ft-size-22 m-2"><a href="../index.php">Accueil</a></li>
                    <li class="nav-item ft-size-22 m-2"><a href="apprenant.php" class="m-2">Apprenants</a></li>
                    <li class="nav-item ft-size-22 m-2"><a href="insertPartenaire.php" class="m-2">Partenaires</a></li>
                    <li class="nav-item ft-size-22 m-2"><a href="insertFormation.php" class="m-2">Formations</a></li>
                    <li class="nav-item ft-size-22 m-2"><a href="../logoutAdmin.php">Deconnexion</a></li>
                    
                </ul>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-8 mt-5">
            <h1>Liste de presence du <?php echo date('d-m-Y') ?> </h1>
            <form action="" method="POST">
                
                <input type="submit" value="">
            </form>
            <table class="table table-striped text-center table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenoms</th>
                        <th>Adresse e-mail</th>
                        <th>Heure d'arrivée</th>
                        <th>Heure de depart</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $date = date('d-m-Y');
                    $selection = $bdd->query("SELECT * FROM liste_emargement WHERE date_connexion='$date'");
                    while ($admin = $selection->fetch()) {
                    ?>
                    <tr>
                        <td><?= $admin['nom'] ?></td>
                        <td><?= $admin['prenom'] ?></td>
                        <td><?= $admin['mail'] ?></td>
                        <td><?= $admin['arrivee'] ?></td>
                        <td><?= $admin['depart'] ?></td>
                    </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
    <script>
                $(document).ready(function() {
                    $('#example').DataTable( {
                        "scrollY":        "500px",
                        "scrollCollapse": true,
                        "paging":         false
                        } );
                    } );
            </script>
</body>

</html>