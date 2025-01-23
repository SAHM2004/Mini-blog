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
        $password=secu($_POST['password']);

        $requete=$connexion->prepare("SELECT * FROM users where Username= :use");
        $requete->bindParam(':use',$user);
        $requete->execute();  
        if($requete->rowCount()>0){
            echo "<div>  Vous vous etes deja inscrit. Veuillez vous connectez </div>";
            echo "<div class=\"container text-danger text-decoration-none\"> <a href=\"connexion.html\"> Se connecter</a></div>";

        }
        else{

        if (
            isset($_POST['Nom'], $_POST['Prenom'], $_POST['User'], $_POST['Email'],$_POST['password'],) &&
            !empty(!empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['User']) && !empty($_POST['Email'])&& !empty($_POST['password']))
        ) {
           $pass= password_hash($password,PASSWORD_DEFAULT);
            $requete = $connexion->prepare("INSERT INTO users(Nom, Prenom, Username,Email,password) VALUES(:nom, :prenom, :user, :email,:motpasse)");
            $requete->bindParam(":nom", $nom);
            $requete->bindParam(":prenom", $prenom);
            $requete->bindParam(":user", $user);
            $requete->bindParam(":email", $email);
            $requete->bindParam(":motpasse",$pass);
            $requete->execute();
        }
        
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