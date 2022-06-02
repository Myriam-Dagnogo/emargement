<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=Presence;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$recup = $bdd->prepare('SELECT * FROM apprenant WHERE id_apprenant=?');
$recup->execute(array($id));
$data = $recup->fetch();

$day = date("d-m-Y");
$verif = $bdd->prepare('SELECT * FROM liste_emargement WHERE id_apprenant=? AND date_connexion =?');
$verif->execute(array($id, $day));
$donnees = $verif->fetch();
$connected = $verif->rowCount();

if (isset($_POST['morning'])) {
    if ($connected == 0) {
        $arrivee = gmdate('H:i:s');
        $matin = $bdd->prepare("INSERT INTO liste_emargement(nom,prenom,mail,date_connexion,arrivee,id_apprenant) VALUES(?,?,?,?,?,?)");
        $matin->execute(array($data["nom_apprenant"], $data["prenom_apprenant"], $data['email_apprenant'], $day, $arrivee, $id));
    } else {
        $error = 'Vous ne pouvez pas émarger deux fois de suite pour la matinée';
    }
}
if (isset($_POST['evening'])) {
        $depart = gmdate('H:i:s');
        $soir = $bdd->prepare('UPDATE liste_emargement SET depart = ? WHERE id_apprenant = ? AND date_connexion= ? ');
        $soir->execute(array($depart, $id, $day));
}
//105.235.111.211
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecté(e)</title>
</head>

<body onload='init()'>

    <div class="container">
        <div class="row">
            <div id="map" style="height:400px; width:200px" class='mt-5 col-6 border'>

            </div>
            <div class="col-6 mt-5">
                <h1>Veuillez emarger svp !!</h1>
                <form method="POST">
                    <input type="submit" value="Arrivée" name="morning">
                    <input type="submit" value="depart" name="evening">
                </form>
                <p> <a href="../index.php" class="btn btn-primary">Retour</a></p>
                <p>
                    <?php if(isset($error)){
                        echo $error ;}?>
                </p>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="../index.js"></script>
</body>

</html>