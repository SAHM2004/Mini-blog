<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.min.css">
</head>

<body>
    <?php

    function secu($donnee)
    {
        $donnee = trim($donnee);
        $donnee = strip_tags($donnee);
        $donnee = stripslashes($donnee);
        return $donnee;
    }
    include('Mini.php');
    try {
      
        $nom = secu($_POST['Nom']);
        $prenom = secu($_POST['Prenom']);
        $user = secu($_POST['User']);
        $email = secu($_POST['Email']);

        if (
            isset($_POST['Nom'], $_POST['Prenom'], $_POST['User'], $_POST['Email']) &&
            !empty(!empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['User']) && !empty($_POST['Email']))
        ) {
            $requete = $connexion->prepare("INSERT INTO users(Nom, Prenom, Username,Email) VALUES(:nom, :prenom, :user, :email)");
            $requete->bindParam(":nom", $nom);
            $requete->bindParam(":prenom", $prenom);
            $requete->bindParam(":user", $user);
            $requete->bindParam(":email", $email);
            $requete->execute();

        
?>
 <div class="text-center">
 <img src="Logo-paulineG.png" alt="">
<p>Bienvenue chez Pauline beauty</p>
<div>
 <a href="article.php" class="btn btn-secondary">Passer une commande</a>
 </div>
 </div>

  <?php        
        }
    } catch (PDOException $e) {
        echo "erreur" . $e->getMessage();
    }
    ?>
</body>
</html>