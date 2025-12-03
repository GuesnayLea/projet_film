-- Base de données pour un catalogue de film

CREATE DATABASE IF NOT EXISTS films_db CHARACTER SET utf8mb4;
USE films_db;

-- On initie la table des utilisateurs

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(180) NOT NULL UNIQUE,
    roles JSON NOT NULL,
    password VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email)
);


-- On initie la table des films

CREATE TABLE IF NOT EXISTS film (
    id  INT AUTO_INCREMENT PRIMARY KEY, 
    titre VARCHAR(255) NOT NULL,
    annee INT NOT NULL,
    duree INT NOT NULL COMMENT 'Durée en minutes',
    synopsis LONGTEXT,
    genre VARCHAR(255),
    realisateur VARCHAR(255),
    prix_location_base DECIMAL(5,2) DEFAULT 3.99,
    image_url VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_titre (titre),
    INDEX idx_annee (annee),
    INDEX idx_genre (genre),
    FOREIGN KEY (created_by_id) REFERENCES user(id) ON DELETE SET NULL

);

-- On initie la table des prix dynamiques

CREATE TABLE IF NOT EXISTS prix_jour (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jour_semaine INT NOT NULL COMMENT '0=Dimanche, 1=Lundi, ..., 6=Samedi',
    multiplicateur DECIMAL(3,2) DEFAULT 1.00,
    description VARCHAR(100),
    UNIQUE KEY unique_jour (jour_semaine)
);

-- On initie la table des favoris

CREATE TABLE IF NOT EXISTS favoris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    film_id INT NOT NULL,
    ajoute_le DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_favori (user_id, film_id),
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (film_id) REFERENCES film(id) ON DELETE CASCADE
);

-- On initie la table des locations 

CREATE TABLE IF NOT EXISTS locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    film_id INT NOT NULL,
    date_location DATETIME DEFAULT CURRENT_TIMESTAMP,
    prix_paye DECIMAL(5,2) NOT NULL,
    jour_semaine INT NOT NULL,
    status VARCHAR(20) DEFAULT 'termine',
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (film_id) REFERENCES film(id) ON DELETE CASCADE,
    INDEX idx_user_date (user_id, date_location)
);

-- On met dans la bdd les données pour la table prix_jour

INSERT INTO prix_jour (jour_semaine, multiplicateur, description) VALUES
(1, 0.80, 'Lundi - Réduction 20%'),
(2, 0.70, 'Mardi - Réduction 30%'),
(3, 1.00, 'Mercredi - Prix normal'),
(4, 1.00, 'Jeudi - Prix normal'),
(5, 1.20, 'Vendredi - Majoration 20%'),
(6, 1.30, 'Samedi - Majoration 30%'),
(0, 1.10, 'Dimanche - Majoration 10%');


