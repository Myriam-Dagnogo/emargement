<?php

//Ceci est une API qui recupère l'adresse Ip d'un utilisateur
$json = file_get_contents('https://ip.seeip.org/jsonip'); //pour recuperer l'adresse ip
//Decode JSON
$json_data = json_decode($json,true); // pour decoder
$ip= $json_data["ip"]; //la valeur retournée est un dictionnaire, donc on appelle la clé ip pour recuperer la valeur de l'ip

$ip = trim($ip); // nettoyage de l'adresse ip (supression d'espace, slash ...)

//Recuperation des éléments de la base de donnée.
require_once('../model/database.php');

if (!empty($_POST['login'])) {
    if (!empty($_POST['stud']) and !empty($_POST['stud_pass'])) {
        $studName = htmlspecialchars($_POST['stud']);
        $studPass = ($_POST['stud_pass']);
        
        $recup = $bdd->prepare('SELECT * FROM Apprenants WHERE nom=? AND pass=?');
        $recup->execute(array($studName, $studPass));
        $data = $recup->fetch();

        $existe = $recup->rowCount();
        if ($existe == 0) {
            $error = "Le nom ou le mot de passe est incorrect";
        } else {
            //on vérifie s'il est à MTN ACADEMY en comparant son adresse ip a celui du routeur de la salle. 
            if($_POST['ip'] == '105.235.111.211'){

                header('Location: ../views/students.php');
            }else{
                $error = 'Emargement impossible, vous n\'êtes pas actuellement présent en salle de cours';
            }
        }
    } else {
        $error = 'Veuillez remplir tous les champs';
    }
}
