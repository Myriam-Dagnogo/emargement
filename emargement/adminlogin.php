<?php
session_start();
require_once('model/database.php');

/*/On verifie si les données entrées par l'utilisateur existe dans la base de donnée.On le connecte si oui et on lui affiche un message d'erreur si non */

if(!empty($_POST['teachConn'])){
    if(!empty($_POST['teach']) AND !empty($_POST['teachPass'])){
        $coachName = htmlspecialchars($_POST['teach']);
        $coachPass = ($_POST['teachPass']);

        $infos = $bdd->prepare('SELECT * FROM formateur WHERE nom_formateur=? AND pass_formateur=?');
        $infos->execute(array($coachName, $coachPass));
        $data = $infos->fetch();
        $exist = $infos->rowCount();

    if($exist == 0){
        $error = "Le nom ou le mot de passe est incorrect";
    }else{
        $_SESSION['id_coach']= $data['nom_formateur'];
        header('Location: ./views/admin.php');
    }

    }else{
        $error = 'Veuillez remplir tous les champs';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>adminlogin</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="disp-flex justify-content-center border mt-5">
                <h4 class="text-center">Connection Formateur </h4>
                <form action="" method="POST" class="col-5">
                    <div class="m-2 form-group">
                        <label for="teacher">Votre nom svp :</label>
                        <input type="text" name="teach" id="teacher" class="form-control">
                    </div>
                    <div class="m-2 form-group">
                        <label for="tex">Entrez votre mot de passe :</label>
                        <input type="password" name="teachPass" id="teachPass" class="form-control">
                    </div>
                    <div class="m-2 form-group">
                        <input type="submit" name="teachConn" value="Se connecter" class="btn btn-success">
                    </div>
                    <?php if (isset($error)){ echo $error ;}?>
                </form>
                <p> <a href="inscription.php">Creer un compte</a> si vous n'en avez pas encore.</p>
                <p> <a href="index.php" class="btn btn-primary">Retour</a></p>
            </div>
        </div>
    </div>
</body>

</html>