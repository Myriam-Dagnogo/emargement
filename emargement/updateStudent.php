<?php
session_start();

//Connexion a la base de donnée
require_once('model/database.php');
    //recuperer la reference du produit et le mettre dans la variable ref
    if (!empty($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
    }

    //Lorsqu'on arrive pour la première fois sur la page 
    $valeur_actuelle = $bdd->prepare('SELECT * FROM apprenant WHERE id_apprenant=?');
    $valeur_actuelle->execute(array($id));
    $info_app = $valeur_actuelle->fetch();
    if(empty($_POST['update'])){

        //Recuperer l'élément dans la base de donnée qui à la reference recuperée

        //Mettre la valeur libelle recupérée dans la variable nom
        $nom=$info_app['nom_apprenant'];

        //Mettre la valeur quantite_minimale recupérée dans la variable min
        $prenoms=$info_app['prenom_apprenant'];

        //Mettre la valeur quantite_en_stock recupérée dans la variable stock
        $mail=$info_app['email_apprenant'];
        $numero=$info_app['contact_apprenant'];
    }else{
        
        //S'il y'a modification du produit, faire la mise à jour
        $name = htmlspecialchars($_POST['nom']);
        $fName = $_POST['prenoms'];
        $email = htmlspecialchars($_POST['email']);
        $contact = $_POST['contact'];
        if (!empty($name) AND !empty($fName) AND !empty($email) AND !empty($contact)){
            $modif=$bdd->prepare('UPDATE apprenant SET nom_apprenant=?, prenom_apprenant=?, email_apprenant=?, contact_apprenant=? WHERE id_apprenant=? ');
            $modif->execute(array($name,$fName,$email,$contact, $id));
            //Redirection vers la liste des produits
            header('Location: views/apprenant.php');
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

    <!-- Custom Css files link  -->
    <link rel="stylesheet" href="./Assets/Css/myStyle.css">

     <!-- Bootstrap css files link -->
     <link rel="stylesheet" href="./Assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./Assets/bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="./Assets/bootstrap/bootstrap-reboot.min.css">

    <!-- Bootstrap Css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Modifier apprenant</title>
</head>

<body>
<?php include('views/header.php') ?>
    <!-- La barre de navigation  -->
    <div class="container row">
        <div class="col-sm-">
            <div class="disp-flex mt-5 flex-column align-items-center">

            <form action="" method="POST">
                <div class="m-2 form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $info_app['nom_apprenant']?>">
                </div>
                <div class="m-2 form-group">
                    <label for="prenom">Prenoms :</label>
                    <input type="text" name="prenoms" id="prenom" class="form-control" value="<?php echo $info_app['prenom_apprenant']?>">
                </div>
                <div class="m-2 form-group">
                    <label for="mail">Adresse e-mail :</label>
                    <input type="email" name="email" id="mail" class="form-control" value="<?php echo $info_app['email_apprenant']?>">
                </div>
                <div class="m-2 form-group">
                    <label for="tel">Numero de telephone :</label>
                    <input type="tel" name="contact" id="tel" class="form-control" value="<?php echo $info_app['contact_apprenant']?>">
                </div>
                <div class="m-2 form-group">
                    <input type="submit" name="update" value="Enregistrer" class="btn btn-success">
                </div>
                <?php if (isset($error)) {
                    echo '<div class="alert text- bg-warning">' . $error . '</div>';
                } ?>
            </form>
            </div>
        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
</body>

</html>