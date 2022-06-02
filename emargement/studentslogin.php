<?php
session_start();

//Ceci est une API qui recupère l'adresse Ip d'un utilisateur
$json = file_get_contents('https://ip.seeip.org/jsonip'); //pour recuperer l'adresse ip
//Decode JSON
$json_data = json_decode($json, true); // pour decoder
$ip_user = $json_data["ip"]; //la valeur retournée est un dictionnaire, donc on appelle la clé ip pour recuperer la valeur de l'ip
$ip_user = trim($ip_user); // nettoyage de l'adresse ip (supression d'espace, slash ...)


//Recuperation des éléments de la base de donnée.
try{
    $bdd =new PDO('mysql:host=localhost;dbname=Presence;', 'root','');
    $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die('Erreur: ' .$e->getMessage());
}
if (!empty($_POST['login'])) {
    if (!empty($_POST['stud']) and !empty($_POST['stud_pass'])) {
        $studName = htmlspecialchars($_POST['stud']);
        $studPass = sha1($_POST['stud_pass']);

        $recup = $bdd->prepare('SELECT * FROM apprenant WHERE nom_apprenant=? AND pass_apprenant=?');
        $recup->execute(array($_POST['stud'], $studPass));
        $data = $recup->fetch();

        if ($recup->rowCount() == 0) {
            $error = "Le nom ou le mot de passe est incorrect";
        } else {
            // if($ip_user== '196.32.179.118'){
                header("Location: views/students.php?id=".$data['id_apprenant']);
            // }
            // else{
            //     $error = "Emargement impossible, vous n'êtes pas actuellement présent dans la salle de cours";
            // }
            
        }
    } else {
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
    <title>studentslogin</title>
</head>

<body class="">
    <div class="container">
        <div class="row">
            <div class="disp-flex justify-center border mt-5">
                <h4 class="text-center">Connexion Apprenant</h4>
                <form action="" method="POST" class="col-5">
                    <div class="m-2 form-group">
                        <label for="stud">Votre nom svp :</label>
                        <input type="text" name="stud" id="stud" class="form-control">
                    </div>
                    <div class="m-2 form-group">
                        <label for="mdp">Mot de passe :</label>
                        <input type="password" name="stud_pass" id="mdp" class="form-control">
                    </div>
                    <div class="m-2 form-group">
                        <input type="hidden" name="ip" id="ip" class="form-control" readonly value="<?= $ip ?>">
                    </div>
                    <div class="m-2 form-group">
                        <input type="submit" name="login" value="Se connecter" class="btn btn-success">
                    </div>
                </form>
                <?php if (isset($error)) {
                    echo '<div class="alert text- bg-warning">' . $error . '</div>';
                } ?>
                <p> <a href="inscription.php">Creer un compte</a> si vous n'en avez pas encore.</p>
                <p> <a href="index.php" class="btn btn-primary">Retour</a></p>

            </div>
        </div>
    </div>
</body>

</html>