
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include('Mini.php');

    try {
        if (isset($_GET['del'])) {
            $id = filter_var($_GET['del'], FILTER_VALIDATE_INT);
            if ($id) {
                $requete = $connexion->prepare("DELETE FROM articles WHERE id = :id");
                $requete->bindParam(':id', $id);
                 ($requete->execute()) ;
        
    }}} catch (Exception $e) {
        echo "<p style='color: red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }

    // Restez sur la même page après suppression
    header("Location: article.php");
    exit;
    ?>
</body>

</html>
