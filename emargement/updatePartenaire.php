
<?php
session_start();

//Connexion a la base de donnée
require_once('model/database.php');
    //recuperer la reference du produit et le mettre dans la variable ref
    if (!empty($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
    }

    //Lorsqu'on arrive pour la première fois sur la page 
    $recup = $bdd->prepare('SELECT * FROM partenaires WHERE id_partenaire=?');
    $recup->execute(array($id));
    $data = $recup->fetch();
    if(empty($_POST['Modifier'])){

        //Recuperer l'élément dans la base de donnée qui à la reference recuperée
        $nom = $data["nom_partenaire"];
        $mail = $data["mail_partenaire"];
        $tel = $data["contact_partenaire"];
        $formation = $data["formation_financée"];
        
       
    }else{
        
        //S'il y'a modification du produit, faire la mise à jour
        $name = htmlspecialchars($_POST['nom']);
        $pmail = $_POST['prenoms'];
        $contact = htmlspecialchars($_POST['email']);
        $form = $_POST['contact'];
        if (!empty($name) AND !empty($pmail) AND !empty($contact) AND !empty($form)){
            $modif=$bdd->prepare('UPDATE partenaires SET nom_partenaire=?, mail_partenaire=?, contact_partenaire=?, formation_financée=? WHERE id_partenaire=? ');
            $modif->execute(array($name,$pmail,$contact,$form, $id));
            //Redirection vers la liste des produits
            header('Location: views/insertPartenaire.php');
        }
        else{
            $erreur='Veuillez remplir tous les champs ';
        }
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
                <h1>Modifier partenaires </h1>
                <form action="" method="POST">
                    <div class="m-2 form-group">
                        <label for="nom">Nom du partenaire:</label>
                        <input type="text" name="nom" id="nom" class="form-control"
                            value="<?php echo $data["nom_partenaire"] ?>">
                    </div>
                    <div class="m-2 form-group">
                        <label for="debut">Adresse e-mail :</label>
                        <input type="email" name="mail" id="debut" class="form-control"
                            value="<?php echo $data["mail_partenaire"] ?>">
                    </div>
                    <div class="m-2 form-group">
                        <label for="fin">Numero de telephone :</label>
                        <input type="tel" name="tel" id="fin" class="form-control" maxlength="10" minlength="8"
                            value="<?php echo $data["contact_partenaire"] ?>">
                    </div>
                    <div class="m-2 form-group">
                        <label for="part">Formation financée :</label>
                        <select class="form-select" name="formation" id="part" value='choisir un partenaire'
                            value="<?php echo $data["formation_financée"] ?>">
                            <option> <?php  $part = $bdd->query('SELECT * FROM partenaires  WHERE id=.?'); ?></option>
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