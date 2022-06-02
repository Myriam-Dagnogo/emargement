<?php 
session_start();
require_once('model/database.php');

try {
    $conn = new PDO ("mysql: host=localhost; dbname=presence;", "root","");

} catch (Exception  $e) {
    die ("Error:" .$e->getMessage());
}




if(isset($_GET['id'])){
    $id=htmlspecialchars($_GET['id']);
}

$data = array();

//selectionner tout ce qui est dans la base de donée conscernant le produit selectionné

if(isset($_POST['Modifier'])){
    $recup = $conn->prepare("SELECT * FROM formation WHERE id_formation=?");
    $recup->execute(array($id));
   
   
    $data = $recup->fetch();


    $nom = $data["nom_formation"];
    $debut = $data["date_debut"];
    $fin = $data["date_fin"];
    $partenaire = $data["partenaire"];

}if(isset($_POST['nom']) && isset($_POST['debut'])&& isset($_POST['fin'])&& isset($_POST['part'])){
   
        $nom=$_POST['nom'];
        $debut=$_POST['debut'];
        $fin=$_POST['fin'];
        $partenaire=$_POST['part'];
       
       
        $modif=$conn->prepare('UPDATE formation SET nom_formation=?, date_debut=? ,date_fin=?, partenaire=? WHERE id_formation=?');
        $modif->execute(array($nom ,$debut,$fin,$partenaire,$id));
    
    
    
     
        header("Location:insertFormation.php");
    }
        
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <?php include('views/styleLinks.php') ?>
    <link rel="stylesheet" href="assets/style/myStyle.css">
</head>

<body>
    <?php include('views/header.php') ?>
    <div class="container">
        <div class="row mt-5">
            <div class=" col-4">
                <h1>Modifier une formation </h1>
                <form action="" method="POST">
                    <div class="m-2 form-group">
                        <label for="nom">Nom de la formation:</label>
                        <input type="text" name="nom" id="nom" class="form-control"
                            value="<?php echo $data["nom_formation"] ?>">
                    </div>
                    <div class="m-2 form-group">
                        <label for="debut">Date de debut :</label>
                        <input type="date" name="debut" id="debut" class="form-control"
                            value="<?php echo $data["date_debut"] ?>">
                    </div>
                    <div class="m-2 form-group">
                        <label for="fin">Date de fin :</label>
                        <input type="date" name="fin" id="fin" class="form-control" maxlength="10" minlength="8"
                            value="<?php echo $data["date_fin"] ?>">
                    </div>
                    <div class="m-2 form-group">
                        <label for="part">Partenaire :</label>
                        <select class="form-select" name="part" id="part" value='choisir un partenaire'
                            value="<?php echo $data["partenaire"] ?>">
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
                        <input type="submit" name="add_formation" value="Modifier" class="btn btn-success">
                    </div>
                    <?php if (isset($error)) {
                        echo '<div class="alert text- bg-warning">' . $error . '</div>';
                    } ?>
                </form>

</body>

</html>