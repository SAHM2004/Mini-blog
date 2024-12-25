<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container mt-5 ">
        <div class="card bg-light text-center">
            <h1>Mon pannier</h1>
        </div>
        <form action="article.php" method="POST">
            <div class="mt-5 text-center input-group">
                <div class="row">
                    <div class="col-8"><img src="Logo-paulineG.png" class="text-center"></div>
                    <div class="col text-center mt-5">
                        <div class="mb-3">
                            <label for="" class="form-label-lg">Entrer votre commande
                                <input type="text" name="arti"  class="form-control">
                            </label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Ajouter</button>
                        </div class="text-center mt-5">
                        <div class="">Laisser un commentaire <br>
                            <textarea name="" id=""></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <?php
    include('Mini.php');

    // Ajouter un article
    if (isset($_POST['arti']) && !empty($_POST['arti'])) {
        $articl = $_POST['arti'];
        $requete = $connexion->prepare("INSERT INTO articles (produit) VALUES(:art)");
        $requete->bindParam(":art", $articl);
        $requete->execute();
    }

    // Récupérer tous les articles
    $requete = $connexion->prepare("SELECT * FROM articles");
    if ($requete->execute()) {
        $users = $requete->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $users = [];
    }
    ?>

    <div class="container text-center">
        <table class="table table-dark table-hover">
            <tr class="table-secondary">
                <td>Articles</td>
                <td>Edition</td>
                <td>Suppression</td>
            </tr>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $use): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($use['produit']); ?></td>
                        <td><a href="blog_Editer.php?id=<?php echo (int)$use['id']; ?>" class="text-primary">Modifier</a></td>
                        <td><a href="blog_Supprimer.php?del=<?php echo (int)$use['id']; ?>" class="text-danger">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Aucun article disponible.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>

