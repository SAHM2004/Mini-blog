<?php
include('Mini.php');

// Debugging: afficher les données reçues
echo "<pre>";
var_dump($_POST);
echo "</pre>";

try {
    // Vérification que les données 'arti' et 'id' sont présentes dans POST
    if (isset($_POST['arti'], $_POST['id']) && !empty($_POST['arti']) && !empty($_POST['id'])) {
        $articl = trim($_POST['arti']); // Récupère et nettoie les données
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT); // Validation de l'ID

        if ($id) {
            $requete = $connexion->prepare("UPDATE articles SET produit = :art WHERE id = :id");
            $requete->bindParam(":art", $articl, PDO::PARAM_STR);
            $requete->bindParam(":id", $id, PDO::PARAM_INT);
            $requete->execute();

            // Redirection après succès
            header("Location: article.php");
            exit;
        } else {
            echo "<p style='color: red;'>ID invalide.</p>";
        }
    } else {
        echo "<p style='color: red;'>Données manquantes ou invalides.</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
