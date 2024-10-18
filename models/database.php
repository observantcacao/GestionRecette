<?php

require_once '../config/constantes.php';

/**
 * Retourne une connexion à la base de données
 *
 * @return PDO L'objet
 */
function connexionBdd() : PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . BDD_HOTE . ';dbname=' . BDD_NOM . ';charset=' . BDD_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $pdo = new PDO($dsn, BDD_UTILISATEUR, BDD_MOT_DE_PASSE, $options);
    }

    return $pdo;
}

// récupère les données de la base de données
function recupererDonnees() : array
{
    $contenu = file_get_contents("php://input");


    if ($contenu === false) {
        return [];
    }

    $donnees = json_decode($contenu, true);

    if (!is_array($donnees)) {
        return [];
    }

    return $donnees;
}

function envoyerDonnees(array $donnees, int $statutHttp = STATUT_HTTP_OK) : void
{
    http_response_code($statutHttp);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($donnees);
    die();
}
