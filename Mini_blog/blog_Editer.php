
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <?php
    include('Mini.php');

    try {
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT); // Validation de l'ID
            if ($id) {
                $requete = $connexion->prepare("SELECT * FROM articles WHERE id = :id");
                $requete->bindParam(":id", $id, PDO::PARAM_INT);
                $requete->execute();
                $user = $requete->fetch(PDO::FETCH_ASSOC);

                if (!$user) {
                    echo "<p style='color: red;'>Article introuvable.</p>";
                    $user = ["id" => "", "produit" => ""];
                }
            } else {
                echo "<p style='color: red;'>ID invalide.</p>";
                $user = ["id" => "", "produit" => ""];
            }
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    ?>

    <div class="container mt-5">
        <div class="card bg-light text-center">
            <h1>Mon panier</h1>
        </div>
        <form action="blog_update.php" method="POST">
            <div class="mt-5 text-center input-group">
                <div class="row">
                    <div class="col"><img src="Logo-paulineG.png" class="text-center"></div>
                    <div class="col text-center mt-5">
                        <div class="mb-3">
                            <div>
                                <!-- Input caché pour ID -->
                                <input type="hidden" name="id" class="form-control" value="<?php echo isset($user['id']) ? htmlspecialchars($user['id']) : ''; ?>">
                            </div>
                            <label for="" class="form-label">Modifier l'article 
                                <input type="text"  class="form-control" name="arti" value="<?php echo isset($user['produit']) ? htmlspecialchars($user['produit']) : ''; ?>">
                            </label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>




    
</body>
</html>
