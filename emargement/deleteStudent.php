<?php
session_start();
require_once('model/database.php');
if (!empty($_GET['id'])){
    $ref = htmlspecialchars($_GET['id']);
    }
if (isset($_POST['yes'])) {         
    $suprim=$bdd->prepare('DELETE FROM apprenant WHERE id_apprenant =?');
    $suprim->execute(array($ref));
    header('Location: views/apprenant.php');
}else if(isset($_POST['no'])){
    header('Location: views/apprenant.php');
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
    <title>DeleteStudent</title>
</head>

<body>

    <!-- La barre de navigation  -->

    <div class="container">
        <div class="disp-flex p-3 mt-5 bg-orange rounded-2">
            <h3>Voulez-vous vraiment retirer cet apprenant ?</h3 >
            <form action="" method="POST" class="ml-10">
                <input type="submit" name="yes" value="Oui" class="del-btn">
                <input type="submit" name="no" value="Non" class="del-btn">
            </form>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
</body>

</html>