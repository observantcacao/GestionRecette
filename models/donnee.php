<?php


require_once "database.php";

function getOne(string $type, int $id) : array{
    $pdo = connexionBdd();
    $sql = "";
    switch($type){
        case 'professeurs':
            $sql = "SELECT `id`, `nom`, `email`, `telephone` FROM gestionCalendrier.professeur";
            break;
        case 'cours':
            $sql = "SELECT `cours`.`id`, `cours`.`nom`, `cours`.`description`, `professeur`.`nom` as `nomProf`, `horaire`.`heureDebut`, `horaire`.`heureFin`, `salle`.`nom` as `nomSalle`, `horaire`.`jour` FROM gestionCalendrier.cours , gestionCalendrier.professeur , gestionCalendrier.horaire , gestionCalendrier.salle where `cours`.`idHoraire` = `horaire`.`id` AND `cours`.`idProfesseur` = `professeur`.`id` AND `cours`.`idSalle` = `salle`.`id`";
            break;
        case 'horaires':
            $sql = "SELECT `id`,`jour`,`heureDebut`,`heureFin` FROM gestionCalendrier.horaire";
            break;
        case 'salles':
            $sql = "SELECT `id`,`nom` as 'Nom de la salle',`capacite` FROM gestionCalendrier.salle";
            break;
        case '':
            throw new Error("données demander vide? veuillez demander un type");
        default:
            throw new Error("données invalide demande un type valide");
    }
    $sql .= " WHERE id = :id";
    $requete = $pdo->prepare($sql);
    $requete->bindParam(":id", $id, PDO::PARAM_INT);
    $requete->execute();
    if (!$requete) {
        throw new Error("connexion échoué a la base de données");
    }
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;
}

function getAll(string $type, int $page = 0): array|Error
{
    if ($page < 0) {
        $page = 0;
    }
    $limiteParPage = 20; //7;
    $horsPage = $page * $limiteParPage;
    $pdo = connexionBdd();
    $sql = "";
    switch ($type) {
        case 'professeurs':
            $sql = "SELECT `id`, `nom`, `email`, `telephone` FROM gestionCalendrier.professeur";
            break;
        case 'cours':
            $sql = "SELECT `cours`.`id`, `cours`.`nom`, `cours`.`description`, `professeur`.`nom` as `nomProf`, `horaire`.`heureDebut`, `horaire`.`heureFin`, `salle`.`nom` as `nomSalle`, `horaire`.`jour` FROM gestionCalendrier.cours , gestionCalendrier.professeur , gestionCalendrier.horaire , gestionCalendrier.salle where `cours`.`idHoraire` = `horaire`.`id` AND `cours`.`idProfesseur` = `professeur`.`id` AND `cours`.`idSalle` = `salle`.`id`";
            break;
        case 'horaires':
            $sql = "SELECT `id`,`jour`,`heureDebut`,`heureFin` FROM gestionCalendrier.horaire";
            break;
        case 'salles':
            $sql = "SELECT `id`,`nom` as 'Nom de la salle',`capacite` FROM gestionCalendrier.salle";
            break;
        case '':
            throw new Error("données demander vide? veuillez demander un type");
        default:
            throw new Error("données invalide demande un type valide");
    }

    $sql .= " LIMIT :nbIgnorer , :nbAfficher;";
    try {
        $requete = $pdo->prepare($sql);
        $requete->bindParam(":nbIgnorer", $horsPage, PDO::PARAM_INT);
        $requete->bindParam(":nbAfficher", $limiteParPage, PDO::PARAM_INT);
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;

    } catch (Exception $err) {
        throw new Error("Erreur de la requête : " . $err);
    }
}

function affichage(array $donnee, bool $afficherID = false): string
{
    //table-bordered
    $retour = '<table class="table table-dark  table-striped table-hover">';

    if (!empty($donnee)) {

        $retour .= '<thead><tr>';

        foreach (array_keys($donnee[0]) as $nomColonne) {
            if ($nomColonne === 'id' && !$afficherID) {
                continue;
            }

            $retour .= '<th class="text-center">' . $nomColonne . '</th>';

        }
        $retour .= '<th class="text-center">Action</th>';
        $retour .= '</tr></thead><tbody>';

        foreach ($donnee as $ligne) {

            $retour .= '<tr>';
         
            foreach ($ligne as $cle => $valeur) {

                if ($cle === 'id' && !$afficherID) {
                    continue;
                }

                $retour .= '<td class="text-center">' . $valeur . '</td>';
            }
            $retour .= '<td class="text-center"><a href="edit.php?id=' . $ligne['id'] .'"><button type="button" class="btn btn-outline-warning">Modifier</button></a>';
            $retour .= '<a href="delete.php?id=' . $ligne['id'] .'"><button type="button" class="btn btn-outline-danger">supprimer</button></a></td>';
            $retour .= '</tr>';

        }
        $retour .= '</tbody>';
    } else {
        $retour .= '<tr><td colspan="100%" class="text-center">Aucune donnée disponible, et si vous en ajoutiez une?</td></tr>';
    }
    $retour .= '</table>';
    return $retour;
}