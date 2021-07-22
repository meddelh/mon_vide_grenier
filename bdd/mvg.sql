-- BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER
-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 02 mai 2020 à 17:28
-- Version du serveur :  8.0.19-0ubuntu5
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvg`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `category` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `user_id`, `description`, `upload_date`, `category`, `name`, `price`) VALUES
('5ead5fcc40123', '5eac6315714fe', 'Nunc finibus sem ac eleifend vestibulum. Vivamus accumsan et lorem sed gravida. Proin commodo quam et euismod sagittis. Vivamus gravida, nibh vel placerat molestie, dui tellus dignissim neque, ut dictum tellus mi eu erat. Nam nec risus sit amet ex laoreet commodo. Suspendisse vel scelerisque dui. Phasellus pulvinar porta risus, nec tincidunt diam eleifend nec. ', '2020-05-02 13:55:56', 'Mobilier', 'Tabouret Orange', 20),
('5ead60cdd2c26', '5eac6315714fe', 'Maecenas condimentum felis ut enim gravida scelerisque. Sed fermentum tortor id urna luctus viverra. Vivamus ut quam aliquam, convallis est nec, dapibus tortor. Praesent non neque ex. Vivamus egestas diam sed dictum viverra. Etiam cursus vitae est vel rhoncus. Praesent suscipit elit vel augue semper dapibus. Cras faucibus faucibus justo eget pulvinar. Praesent in suscipit turpis. Nunc vel risus enim. Phasellus cursus est id arcu posuere, ut lobortis magna blandit. Morbi at turpis et erat mollis imperdiet fringilla ut libero. Cras cursus luctus tempus. Vestibulum vitae varius ligula, sed tempor sem. Aenean non sapien nec ipsum elementum venenatis ut quis est. ', '2020-05-02 14:00:13', 'Mobilier', 'Tabourets', 40),
('5ead6567e5b45', '5ead6540d63cd', 'Etiam non auctor nisi. Sed finibus eros in tortor ultricies, nec faucibus quam dictum. Fusce ac fringilla justo, eu mollis lectus. Phasellus vitae efficitur purus, eget finibus dui. Vestibulum mattis molestie felis eu aliquam. Phasellus vel semper massa. Fusce rutrum rutrum purus, vitae mattis eros dictum quis. Mauris est lorem, ullamcorper vitae tortor facilisis, commodo maximus nunc. ', '2020-05-02 14:19:51', 'Mode', 'Chaussure de sport', 40),
('5ead88af85edd', '5ead8878ec827', 'Aenean ac quam id nisl lacinia fermentum. Praesent ac iaculis nulla. Pellentesque ut lorem et felis tincidunt mollis. Quisque malesuada velit in interdum venenatis. Suspendisse congue ex vitae facilisis mattis. Donec aliquet ullamcorper felis. Phasellus enim leo, semper ut odio non, lacinia laoreet elit.', '2020-05-02 16:50:23', 'Mobilier', 'Kit de tabouret', 80),
('5ead89c97823f', '5ead899254ac4', 'Aenean ac quam id nisl lacinia fermentum. Praesent ac iaculis nulla. Pellentesque ut lorem et felis tincidunt mollis. Quisque malesuada velit in interdum venenatis. Suspendisse congue ex vitae facilisis mattis. Donec aliquet ullamcorper felis. Phasellus enim leo, semper ut odio non, lacinia laoreet elit.', '2020-05-02 16:55:05', 'Multimédia', 'Samsung Galaxy S8', 80),
('5ead8d060d7e9', '5eac6315714fe', 'Aenean ac quam id nisl lacinia fermentum. Praesent ac iaculis nulla. Pellentesque ut lorem et felis tincidunt mollis. Quisque malesuada velit in interdum venenatis. Suspendisse congue ex vitae facilisis mattis. Donec aliquet ullamcorper felis. Phasellus enim leo, semper ut odio non, lacinia laoreet elit.', '2020-05-02 17:08:54', 'Multimédia', 'Samsung', 80),
('5ead8d9a46c4b', '5ead8d7ecdb40', 'Maecenas sit amet odio at ex malesuada pulvinar. Suspendisse lacinia eleifend arcu id commodo. Sed dapibus odio eu lacus varius, quis maximus metus ullamcorper. Aliquam ullamcorper placerat consequat. Quisque ac porttitor sem. Sed ullamcorper blandit erat vitae condimentum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus tristique enim vel dictum auctor. Duis pharetra feugiat metus, quis sagittis nulla.', '2020-05-02 17:11:22', 'Autres', 'Materiel de musculation', 40);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `name` varchar(64) NOT NULL,
  `annonce_id` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`name`, `annonce_id`) VALUES
('5ead5fcc416d41.18062686.jpg', '5ead5fcc40123'),
('5ead60cdd47749.00468143.jpg', '5ead60cdd2c26'),
('5ead60cdd6f587.99517391.jpg', '5ead60cdd2c26'),
('5ead88af878054.77914356.jpg', '5ead88af85edd'),
('5ead88af893002.00049430.jpg', '5ead88af85edd'),
('5ead88af8b3934.97895374.jpg', '5ead88af85edd');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` varchar(16) NOT NULL,
  `login` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `pass` varchar(160) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `email`, `pass`) VALUES
('5eac6315714fe', 'medd', 'meddelh@protonmail.com', '$2y$10$7uAn5/PDrsovzmVKuz3iAODcrX5TrGyrQH8/5k8wF2qAQmBXXFdnG'),
('5eac76b083638', 'aurelien', 'aurelienb@gmail.com', '$2y$10$A5ebJKqJQvVNNATb.z0PkeM2ll5HLS44w0zIlUjeSpA2.6J5A3g22'),
('5ead64e1e7fa8', 'john', 'johndoe@gmail.com', '$2y$10$fFIhilTsLH9bugpOnKA2aOLztcMWmp/m3dB9bHp7ZUr/taNA8y5Pa'),
('5ead6540d63cd', 'jack', 'jack@gmail.com', '$2y$10$eHypXinUjA8mqrPBjeW2a.rH80cXwIBDczXQe5XYmZKjnRASvayae'),
('5ead8686726c3', 'matis', 'matis@gmail.com', '$2y$10$hYaaurBxDkgml2qLqaLMlOqqUpo8fDxoPf5TB7TKUZkvTh7Z2yWR2'),
('5ead8878ec827', 'marc', 'marc@gmail.com', '$2y$10$zTtpujzXFPfxHPpKPQ72ZOO2DyGrWN2amwlmDb226ntEZK0WaQ4fK'),
('5ead899254ac4', 'medd2', 'medd2@protonmail.com', '$2y$10$n9WiipZZPwMkEY87KFz9jOmRCYXUbv0NI3oyBgNocHTc4ts76cMMK'),
('5ead8ba5290a2', 'indentifiant', 'identifiant@gmail.com', '$2y$10$Wk1wupw2ktTiowkVae5c9ux/.w5fAPkflz72yC2KtMwVkyVunWWb2'),
('5ead8d7ecdb40', 'nouveau', 'nouveau@gmail.com', '$2y$10$zIGFTpSr.gZRFh.gDrJVfuhA.kLggSTBZz/nsDd7jbVYTHHDFVxkW');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`name`),
  ADD KEY `fk_annonce_id` (`annonce_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_annonce_id` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`);

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_annonce` ON SCHEDULE EVERY 1 DAY STARTS '2020-05-02 16:40:38' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM annonce
  WHERE `upload_date` < CURRENT_TIMESTAMP - INTERVAL 2 MONTH$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
