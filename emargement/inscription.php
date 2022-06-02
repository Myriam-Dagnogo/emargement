<?php
    try{
        $bdd =new PDO('mysql:host=localhost;dbname=Presence;', 'root','');
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        die('Erreur: ' .$e->getMessage());
    }

if (isset($_POST['registred'])) {
    if (!empty($_POST['nom']) and !empty($_POST['prenoms']) and !empty($_POST['mail']) and !empty($_POST['pass']) AND !empty($_POST['pass_confirm'])) {
       if($_POST['pass']== $_POST['pass_confirm']){
        $nom = htmlspecialchars($_POST['nom']);
        $prenoms = htmlspecialchars($_POST['prenoms']);
        $mail = $_POST['mail'];
        $pass = sha1($_POST['pass']);
        $tel = htmlspecialchars($_POST['tel']);

        $add = $bdd->prepare('INSERT INTO apprenant(nom_apprenant,prenom_apprenant,email_apprenant,pass_apprenant,contact_apprenant) VALUES(?, ?, ?, ?,?)');
        $add->execute(array($nom,$prenoms,$mail,$pass,$tel));

        header('Location: studentslogin.php');
       }else{
           $error = "Les mots de passe ne correspondent pas";
       }

    } else {
        $error = 'Veuillez remplir tous les champs.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/styleLinks.php') ?>
    <title>Inscription</title>
</head>

<body>
    <div class="container">
        <div class="row col-6">
            <form action="" method="POST">
                <div class="m-2 form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <label for="prenom">Prenoms :</label>
                    <input type="text" name="prenoms" id="prenom" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <label for="mail">Adresse e-mail :</label>
                    <input type="email" name="mail" id="mail" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <label for="tel">Numero de telephone :</label>
                    <input type="tel" name="tel" id="tel" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" name="pass" id="pass" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <label for="pass_confirm">Confirmer le mot de passe :</label>
                    <input type="password" name="pass_confirm" id="pass_confirm" class="form-control">
                </div>
                <div class="m-2 form-group">
                    <input type="submit" name="registred" value="S'inscrire" class="btn btn-success">
                </div>
                <?php if (isset($error)) {
                    echo '<div class="alert text- bg-warning">' . $error . '</div>';
                } ?>
            </form>
        </div>
    </div>
</body>

</html>