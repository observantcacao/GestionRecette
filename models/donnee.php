<?php

require_once "database.php";

$pdo = connexionBdd();
$tmp = ["tmp"];

/// gestion de d'informations avec la base de donnée... ///

// CATEGORIES // ------------------------------------------
function recupCategories() : array {
    try {
        // Préparation de la requête d'insertion
        $query = "SELECT `id`, `nom` FROM gestionRecette.categories;";
        $requete = $pdo->prepare($query);
        $success = $requete->execute();
        
        if (!$success) {
            throw new Exception("Échec de l'exécution de la requête SQL.");
        }
        
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC); 
        return $resultat;
        
    } catch (Exception $e) {
        // En cas d'erreur, on retourne un tableau contenant un message d'erreur détaillé
        return ["erreur" => "Erreur lors de la récupération des catégories : " . $e->getMessage()];
    }
}

function oneCategorie(int $id) : array {
    try {
        // Préparation de la requête d'insertion
        $query = "SELECT `id`, `nom` FROM gestionRecette.categories WHERE id = :id;";
        $requete = $pdo->prepare($query);

        // Lier le paramètre
        $requete->bindParam(':id', $id, PDO::PARAM_INT);

        $success = $requete->execute();
        
        if (!$success) {
            throw new Exception("Échec de l'exécution de la requête SQL.");
        }
        
        $resultat = $requete->fetch(PDO::FETCH_ASSOC); 
        return $resultat;
        
    } catch (Exception $e) {
        // En cas d'erreur, on retourne un tableau contenant un message d'erreur détaillé
        return ["erreur" => "Erreur lors de la récupération des catégories : " . $e->getMessage()];
    }
}

function addCategorie(string $nom) : bool{
    try {
        // Préparation de la requête d'insertion
        $query = "INSERT INTO gestionRecette.categories nom VALUES :nom;";
        $requete = $pdo->prepare($query);
        
        // Lier le paramètre
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        
        $success = $requete->execute();
        
        if (!$success) {
            throw new Exception("Échec de l'exécution de la requête d'insertion.");
        }

        // Retourne true si l'ajout est reussi
        return true;

    } catch (Exception $e) {
        // si il y a une erreur on retourne false
        return false;
    }
}

function editCategorie(int $id, string $nom) : bool{
    try {
        // Préparation de la requête de mise à jour
        $query = "UPDATE gestionRecette.categories SET nom = :nom WHERE id = :id;";
        $requete = $pdo->prepare($query);
        
        // Lier les paramètres
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        
        $success = $requete->execute();
        
        if (!$success) {
            throw new Exception("Échec de l'exécution de la requête de mise à jour.");
        }

        // Retourne true si la modification est reussi
        return true;

    } catch (Exception $e) {
        // si il y a une erreur on retourne false
        return false;
    }
}

function deleteCategorie(int $id) : bool{
    try {
        // Préparation de la requête de mise à jour
        $query = "UPDATE gestionRecette.categories SET nom = :nom WHERE id = :id;";
        $requete = $pdo->prepare($query);
        
        // Lier les paramètres
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        
        $success = $requete->execute();
        
        if (!$success) {
            throw new Exception("Échec de l'exécution de la requête de mise à jour.");
        }

        // Retourne true si la modification est reussi
        return true;

    } catch (Exception $e) {
        // si il y a une erreur on retourne false
        return false;
    }
}


// RECETTES // ------------------------------------------
function recupRecettes() : array {
    try {
        // Préparation de la requête d'insertion
        $query = "SELECT `id`, `titre`, `tempsCuisson`, `cheminPhotos` FROM gestionRecette.recette;";
        $requete = $pdo->prepare($query);
        $success = $requete->execute();
        
        if (!$success) {
            throw new Exception("Échec de l'exécution de la requête SQL.");
        }
        
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
        
    } catch (Exception $e) {
        // En cas d'erreur, on retourne un tableau contenant un message d'erreur détaillé
        return ["erreur" => "Erreur lors de la récupération des catégories : " . $e->getMessage()];
    }
}

function oneRecette(int $id) : array {
    try {
        // Préparation de la requête d'insertion
        $query = "SELECT `id`, `titre`, `tempsCuisson`, `cheminPhotos` FROM gestionRecette.recette WHERE id = :id;";
        $requete = $pdo->prepare($query);

        // Lier le paramètre
        $requete->bindParam(':id', $id, PDO::PARAM_INT);

        $success = $requete->execute();
        
        if (!$success) {
            throw new Exception("Échec de l'exécution de la requête SQL.");
        }
        
        $resultat = $requete->fetch(PDO::FETCH_ASSOC); 
        return $resultat;
        
    } catch (Exception $e) {
        // En cas d'erreur, on retourne un tableau contenant un message d'erreur détaillé
        return ["erreur" => "Erreur lors de la récupération des catégories : " . $e->getMessage()];
    }
}

function addRecette(string $nom) : bool{
    return true;
}

function editRecette(int $id, string $nom) : bool{
    return true;
}

function deleteRecette(int $id) : bool{
    return true;
}


// INGREDIENT // ------------------------------------------
function recupIngredient() : array{
    return $tmp;
}

function addIngredient() : bool{
    return true;
}

function deleteIngredient() : bool{
    return true;
}