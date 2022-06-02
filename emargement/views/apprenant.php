<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('styleLinks.php')?>
    <title>Liste apprenant</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <div class="row mt-5">
            <h1 class="">Liste des apprenants</h1>
            <table class="table table-striped text-centertable-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenoms</th>
                        <th>Adresse e-mail</th>
                        <th>Contact</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('../model/database.php');
                    $selection = $bdd->query('SELECT * FROM apprenant');
                    while ($app = $selection->fetch()) { 
                        ?>
                    <tr>
                        <td><?= $app['nom_apprenant']?></td>
                        <td><?= $app['prenom_apprenant']?></td>
                        <td><?= $app['email_apprenant']?></td>
                        <td><?= $app['contact_apprenant']?></td>
                        <?php
                        echo '<td> <a href="../updateStudent.php?id=' . $app['id_apprenant'] . '" class="m-2">
                                Modifier</a> <a href="../deleteStudent.php?id=' . $app['id_apprenant'] . '" class="">
                                Supprimer</a> </td>'; ?>
                    </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>