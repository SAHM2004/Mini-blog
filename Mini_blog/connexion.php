<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <title>Document</title>
</head>

<body>

</body>

</html>


<?php
include('Mini.php');
$utilisateur = ($_POST['User']);
$password = ($_POST['password']);

$requete = $connexion->prepare("SELECT * FROM users WHERE Username=:use");
$requete->bindParam(":use", $utilisateur);
$requete->execute();

if ($requete->rowCount() > 0) {
    $user = $requete->fetch();
    if (password_verify($password, $user['password'])) { ?>

        <div class="text-center">
            <img src="Logo-paulineG.png" alt="">
            <p>Bienvenue chez Pauline beauty</p>
            <div>
                <a href="article.php" class="btn btn-secondary">Passer une commande</a>
            </div>
        </div>
<?php
    } else {
        echo "Mot de passe incorrecte";
    }
} else {
    echo  "<div> Vous devez vous S'inscire </div>";
}
?>