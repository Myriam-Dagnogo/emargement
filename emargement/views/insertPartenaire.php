<?php
require_once('../model/database.php');

if (isset($_POST['add_partenaire'])) {
    if (!empty($_POST['nom']) and !empty($_POST['mail']) and !empty($_POST['tel']) and !empty($_POST['formation'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $mail = $_POST['mail'];
        $contact = htmlspecialchars($_POST['tel']);
        $formation = $_POST['formation'];

        $add = $bdd->prepare('INSERT INTO partenaires(nom_partenaire,mail_partenaire,contact_partenaire,formation_financée) VALUES(?, ?, ?, ?)');
        $add->execute(array($nom, $mail, $contact, $formation));
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('styleLinks.php') ?>
    <title>Inscription</title>
</head>

<body>
<?php include('header.php') ?>
    <div class="container mt-5">
        <div class="row">
            <h1>Ajouter un partenaire</h1>
            <form action="" method="POST" class="col-4">
                <div class="m-2 form-group">
                    <label for="nom">Nom du partenaire:</label>
                    <input type="text" name="nom" id="nom" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <label for="mail">Adresse e-mail :</label>
                    <input type="email" name="mail" id="mail" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <label for="tel">Numero de telephone :</label>
                    <input type="tel" name="tel" id="tel" class="form-control" maxlength="10" minlength="8">
                </div>
                <div class="m-2 form-group">
                    <label for="form">Formation financée :</label>
                    <select class="form-select" name="formation" id="form" value='choisir une formation'>
                        <option> --Choisir une formation -- </option>
                         <?php 
                        $part = $bdd->query('SELECT * FROM formation');
                        while($info_part =$part->fetch()){
                            echo '<option value="'.$info_part['nom_formation'].'">'.$info_part['nom_formation'].'</option>';
                        };
                        ?>
                    </select>
                </div>
                <div class="m-2 form-group">
                    <input type="submit" name="add_partenaire" value="Ajouter" class="btn btn-success">
                </div>
                <?php if (isset($error)) {
                    echo '<div class="alert text- bg-warning">' . $error . '</div>';
                } ?>
            </form>
            <div class="col-8">
                
                <table class="table table-striped text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Nom du partenaire</th>
                            <th>Formation financée</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         require('../model/database.php');
                        $selection = $bdd->query('SELECT * FROM partenaires');
                        while ($admin = $selection->fetch()) {
                            echo '<tr>';
                            echo '<td>' . $admin['nom_partenaire'] . '</td>';
                            echo '<td>' . $admin['formation_financée'] . '</td>';
                            echo '<td>' . $admin['contact_partenaire'] . '</td>';
                            echo  '<td> <a href="../updatePartenaire.php?id=' . $admin['id_partenaire'] . '" class="m-2"> Modifier</a>
                                        <a href="../deletePartenaire.php?id=' . $admin['id_partenaire'] . '" class=""> Supprimer</a> </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>