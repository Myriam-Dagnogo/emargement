<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=Presence;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}

if (isset($_POST['add_formation'])) {
    if (!empty($_POST['nom']) and !empty($_POST['debut']) and !empty($_POST['fin']) and !empty($_POST['part'])) {

        $nom = htmlspecialchars($_POST['nom']);
        $debut = $_POST['debut'];
        $fin = htmlspecialchars($_POST['fin']);
        $partenaire = $_POST['part'];

        $add = $bdd->prepare('INSERT INTO formation(nom_formation,date_debut,date_fin,partenaire) VALUES(?, ?, ?,?)');
        $add->execute(array($nom, $debut, $fin, $partenaire));

        header('Location: admin.php');
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
    <title>Ajouter une formation</title>
</head>

<body>
<?php include('header.php') ?>
    <div class="container">
        <div class="row mt-5">
            <div class=" col-4">
                <h1>Ajouter une formation </h1>
                <form action="" method="POST">
                    <div class="m-2 form-group">
                        <label for="nom">Nom de la formation:</label>
                        <input type="text" name="nom" id="nom" class="form-control">
                    </div>
                    <div class="m-2 form-group">
                        <label for="debut">Date de debut :</label>
                        <input type="date" name="debut" id="debut" class="form-control">
                    </div>
                    <div class="m-2 form-group">
                        <label for="fin">Date de fin :</label>
                        <input type="date" name="fin" id="fin" class="form-control" maxlength="10" minlength="8">
                    </div>
                    <div class="m-2 form-group">
                        <label for="part">Partenaire :</label>
                        <select class="form-select" name="part" id="part" value='choisir un partenaire'>
                            <option> --Choisir un partenaire -- </option>
                            <?php
                            $part = $bdd->query('SELECT * FROM partenaires');
                            while ($info_part = $part->fetch()) {
                                echo '<option value="' . $info_part['nom_partenaire'] . '">' . $info_part['nom_partenaire'] . '</option>';
                            };
                            ?>
                        </select>
                    </div>
                    <div class="m-2 form-group">
                        <input type="submit" name="add_formation" value="Ajouter" class="btn btn-success">
                    </div>
                    <?php if (isset($error)) {
                        echo '<div class="alert text- bg-warning">' . $error . '</div>';
                    } ?>
                </form>
            </div>
            <div class="col-8 mt-5">
                <table class="table table-striped text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Nom de la formation</th>
                            <th>Date de debut</th>
                            <th>Date de fin </th>
                            <th>Partenaire </th>
                            <th>action1 </th>
                            <th>action2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $selection = $bdd->query('SELECT * FROM formation');
                        while ($admin = $selection->fetch()) { ?>

                            <tr>
                            <td><?= $admin['nom_formation']?></td>
                            <td><?= $admin['date_debut']?></td>
                            <td><?= $admin['date_fin']?></td>
                            <td><?= $admin['partenaire']?></td>
                            <td><button class="btn-danger  td-none "><a class="text-white"  href="../deleteFormation.php?id=<?php echo $admin['id_formation'] ?>">supprimer</a></button></td>
	                        <td><button class= "btn-primary"><a class="text-white" href="../updateFormation.php?id=<?php echo $admin['id_formation'] ?>">modifier</a></button></td>
                        //<?php
                           // echo  '<td> <a href="../updateStudent.php?id=' . $admin['id_formation'] . '" class="m-2"> Modifier</a> <a href="../deleteFormation.php?id=' . $admin['id_formation'] . '" class=""> Supprimer</a> </td>';
                           // echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>