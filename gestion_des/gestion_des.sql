-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 fév. 2023 à 14:46
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_des`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id_annonce` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `superficie` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `type_annonce` varchar(50) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `date_publication` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `id_client`, `titre`, `description`, `adresse`, `ville`, `superficie`, `categorie`, `type_annonce`, `prix`, `date_publication`) VALUES
(2, 1, 'Appartement meublée', 'Appartement meublée situé en plein centre ville', 'Tanger Castilla', 'Tanger ', 150, 'appartement\n', 'location', '5000.00', '2023-02-16'),
(3, 2, 'Villa semi finie', 'Magnifique villa vue sur mer', 'Tanger achakkar', 'Tanger', 400, 'Villa', 'Vente', '200000.00', '2023-02-16'),
(4, 3, 'Appartement duplex', 'Appartement située dans un quartier calme et proche de toutes les accommodations', 'Tanger bransse', 'Tanger ', 200, 'appartement', 'vente', '150000.00', '2023-02-16'),
(5, 4, 'villa', 'Magnifique villa vue sur mer', 'Tanger achakar', 'Tanger ', 400, 'villa', 'vente', '400000.00', '0000-00-00'),
(6, 2, 'appartement', 'Appartement 3éme etage située dans quartier calame', 'tanger rmilate', 'tanger', 300, 'appartement', 'location', '300000.00', '0000-00-00'),
(8, 3, 'villa', 'belle vila avec piscine', 'tanger achakar', 'tanger', 220, 'villa', 'Location', '5000.00', '2023-02-16'),
(11, 3, 'villa', 'fgdgfjkoizaghj', 'Tanger', 'Tanger', 300, 'Appartement', 'Location', '123456.00', '2023-02-23');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse_email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Numero_tele` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `adresse_email`, `password`, `Numero_tele`) VALUES
(1, 'mottaki', 'hicham', 'hicham20@gmail.com', 'Hicham123456', '0610336662'),
(2, 'Bakali', 'jihan', 'jihan.bakali@gmail.com', 'jihan1234', '0615554330'),
(3, 'khanosse', 'ikram', 'ikram-200@gmail.com', 'ikram2000', '0607043123'),
(4, 'wahabi', 'jawad', 'jawad.wahabi99@gmail.com', 'jawadwahabi1999', '0612345678'),
(8, 'hanae', 'fraihii', 'elfraihi.solicode@gmail.com', 'HAN1234', '0656439801'),
(9, 'wazani', 'mohamed', 'wazani.mohamed@gmail.com', 'hanae123', '0612345631'),
(10, 'karimi', 'bachir', 'elfraihi.35@ofppt.ma', 'Soulaimane-75', '0689012654');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL,
  `url_image` varchar(350) NOT NULL,
  `principal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_image`, `id_annonce`, `url_image`, `principal`) VALUES
(2, 2, 'apparte(1).jpg', 'true'),
(3, 2, 'apparte(2).jpg', 'false'),
(4, 3, 'apparte(3).jpg', 'true'),
(5, 3, 'apparte(4).jpg', 'false'),
(6, 4, 'apparte(5).jpg', 'true'),
(7, 4, 'apparte(6).jpg', 'false'),
(8, 5, 'apparte(7).jpg', 'true'),
(10, 5, 'apparte(8).jpg', 'false'),
(11, 6, 'apparte(9).jpg', 'true'),
(12, 6, 'apparte(10).jpg', 'false'),
(13, 8, 'apparte(11).jpg', 'true'),
(14, 8, 'apparte(12).jpg', 'false'),
(15, 11, 'apparte(13).jpg', 'true'),
(16, 11, 'apparte(14).jpg', 'false');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `idx_id_bien` (`id_annonce`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `idx_id_prop` (`id_client`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_annonce` (`id_annonce`),
  ADD KEY `idx_id_bien` (`id_image`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `annonce` (`id_annonce`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
