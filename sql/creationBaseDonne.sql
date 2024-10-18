-- 18.10.24 -- loukian.P -- base de données pour l'exercice gesionnaire de recette
CREATE DATABASE IF NOT EXISTS `gestionRecette`;
use `gestionRecette`;

CREATE TABLE IF NOT EXISTS `recette`(
    `id` int PRIMARY KEY auto_increment,
    `titre` varchar(75) NOT NULL,
    `tempsCuisson` int NOT NULL,
    `cheminPhotos` varchar(100)
);

CREATE TABLE IF NOT EXISTS `categories`(
    `id` int PRIMARY KEY auto_increment,
    `nom` varchar(35) NOT NULL
);

CREATE TABLE IF NOT EXISTS `ingredient`(
    `id` int PRIMARY KEY auto_increment,
    `nom` varchar(35) NOT NULL
);

CREATE TABLE IF NOT EXISTS `recetteCategorie`(
    `idRecette` int,
    `idCategorie` int,

    FOREIGN KEY (`idRecette`) REFERENCES `recette`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`idCategorie`) REFERENCES `categories`(`id`) ON DELETE CASCADE,
    PRIMARY KEY (`idRecette`, `idCategorie`) -- Clé primaire composite
);

CREATE TABLE IF NOT EXISTS `recetteIngredient`(
    `idRecette` int,
    `idIngredient` int,

    FOREIGN KEY (`idRecette`) REFERENCES `recette`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`idIngredient`) REFERENCES `ingredient`(`id`) ON DELETE CASCADE,
    PRIMARY KEY (`idRecette`, `idIngredient`) -- Clé primaire composite
);

-- Insertion dans la table 'recette'
INSERT INTO `recette` (`titre`, `tempsCuisson`, `cheminPhotos`) 
VALUES 
('Pâtes Carbonara', 15, 'carbonara.jpg'),
('Tarte aux pommes', 40, 'tarte_pommes.jpg'),
('Salade César', 10, 'salade_cesar.jpg');

-- Insertion dans la table 'categories'
INSERT INTO `categories` (`nom`) 
VALUES 
('Italien'),
('Dessert'),
('Salade');

-- Insertion dans la table 'ingredient'
INSERT INTO `ingredient` (`nom`) 
VALUES 
('Pâtes'),
('Oeufs'),
('Crème fraîche'),
('Pommes'),
('Sucre'),
('Poulet'),
('Laitue'),
('Parmesan');

-- Liaison entre recettes et catégories (recetteCategorie)
INSERT INTO `recetteCategorie` (`idRecette`, `idCategorie`) 
VALUES 
(1, 1), -- Pâtes Carbonara est italien
(2, 2), -- Tarte aux pommes est un dessert
(3, 3); -- Salade César est une salade

-- Liaison entre recettes et ingrédients (recetteIngredient)
INSERT INTO `recetteIngredient` (`idRecette`, `idIngredient`) 
VALUES 
(1, 1), -- Pâtes Carbonara contient des pâtes
(1, 2), -- Pâtes Carbonara contient des oeufs
(1, 3), -- Pâtes Carbonara contient de la crème fraîche
(2, 4), -- Tarte aux pommes contient des pommes
(2, 5), -- Tarte aux pommes contient du sucre
(3, 6), -- Salade César contient du poulet
(3, 7), -- Salade César contient de la laitue
(3, 8); -- Salade César contient du parmesan
