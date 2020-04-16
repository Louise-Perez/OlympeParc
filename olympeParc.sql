-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 16 avr. 2020 à 22:21
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `olympeParc`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id_activite` int(11) NOT NULL,
  `nom_activite` varchar(255) NOT NULL,
  `type_activite` varchar(255) NOT NULL,
  `taille_minimum` int(3) NOT NULL,
  `interet_activite` varchar(255) NOT NULL,
  `contenu_activite` text NOT NULL,
  `image_activite` int(11) NOT NULL,
  `notation_activite` int(11) NOT NULL,
  `id_ref_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id_activite`, `nom_activite`, `type_activite`, `taille_minimum`, `interet_activite`, `contenu_activite`, `image_activite`, `notation_activite`, `id_ref_admin`) VALUES
(1, 'Le labyrinthe du Minotaure', 'Attraction', 0, 'Toute la famille', 'Perdez vous dans le labyrinthe du Minotaure, un monstre fabuleux mi-homme mi-taureau. Suivez le fil d’Ariane,  peut être croiserez vous Thésée ou simplement quelque chèvres qui servent de repas au Minotaure. ', 1, 0, 2),
(2, 'Le palais des Glaces de Méduse', 'Attraction', 0, 'Toute la famille', 'Déambuler dans le palais des glaces, mais attention vous risquez d’y croiser le regard perçant de Meduse, cette jeune femme transformée en Gorgone pour avoir été l’amante de Poseidon. Phobique des serpents, on vous aura prévenue !', 2, 0, 2),
(3, 'Le looping de l\'hydre', 'Attraction', 120, 'Amateur de sensation', 'Sur le thème de l’Hydre de Lerne, un manège articulé à l’image des cents têtes de l’Hydre, défiera toute lois de gravité en tournoyant autour de son corps. ', 3, 0, 2),
(4, 'Le train fantôme aquatique', 'Attraction', 120, 'Amateur de sensation', 'Sur le thème des sirènes, ces fabuleuses créatures fantastiques marines, laissez vous envouter par leur chants et l’océan.  Dans la mythologie grec, il est dit que les sirènes étaient mi-femme mi-oiseaux alors guetter également le ciel. Dans les profondeurs de l\'océan vous croiserez diverses créature mystiques mais aussi quelques marins perdus', 4, 0, 2),
(7, 'Midas et ses doigts d\'or', 'Spectacle', 0, 'Toute la famille', 'Soyez spectateur de la vie du Roi Midas qui suite au sauvetage de Silène reçoit un don merveilleux, celui de transformer tout ce qu’il touche en or. Mais avoir un tel pouvoir est-il si merveilleux ? ', 6, 0, 2),
(8, 'Le musée grecs', 'Activité', 0, 'Culture', 'Un musée ludique pour rendre accessible la mythologie grecs aux enfants ( les parties le plus perturbantes ayant été enjolivée pour ne pas choquer les plus petits) ', 9, 0, 2),
(9, 'Séance photo', 'Activité', 0, 'Toute la famille', 'Dans tout le parcs à différentes heures , vous pourrez prendre une photo en compagnie des héros et dieux grecs les plus connus. Succomber au charme d’Aphrodite et méfiez vous du trident de Poseidon', 7, 0, 2),
(10, 'Course de chars', 'Spectacle', 0, 'Toute la famille ', 'Assistez aux traditionnelles courses de chars de la grèves antique. S’affronteront dans l’arène Diomède, Eumélos, Antilope, Mélénas et Mérion pour les plus connus ! ', 8, 0, 2),
(11, 'Guerre de Troie ', 'Spectacle', 0, 'Culture', 'Revivez la légendaire Guerre de Troie et son Cheval ! A l’initiative d’Ulysse, des guerrières grecs réussissent à pénétrer dans Troie, assiégée en vain depuis 10 ans, en se cachant dans un cheval de bois, harnaché d’or, offert aux troyens ', 5, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `admin_espace`
--

CREATE TABLE `admin_espace` (
  `id_admin` int(11) NOT NULL,
  `pseudo_admin` varchar(255) NOT NULL,
  `mail_admin` varchar(255) NOT NULL,
  `mdp_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin_espace`
--

INSERT INTO `admin_espace` (`id_admin`, `pseudo_admin`, `mail_admin`, `mdp_admin`) VALUES
(2, 'loulou', 'loulou@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `nom_membre` varchar(255) NOT NULL,
  `prenom_membre` varchar(255) NOT NULL,
  `naissance_membre` date NOT NULL,
  `mail_membre` varchar(255) NOT NULL,
  `mdp_membre` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `compte_actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom_membre`, `prenom_membre`, `naissance_membre`, `mail_membre`, `mdp_membre`, `date_inscription`, `compte_actif`) VALUES
(1, 'Perez', 'Louise', '1995-10-29', 'louise@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-04-02 12:06:53', 1),
(3, 'Raz', 'Bob', '1965-03-18', 'bob@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-04-17 00:03:31', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

CREATE TABLE `notation` (
  `id_note` int(11) NOT NULL,
  `notation` int(11) NOT NULL,
  `ip_notation` varchar(255) NOT NULL,
  `id_ref_activite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notation`
--

INSERT INTO `notation` (`id_note`, `notation`, `ip_notation`, `id_ref_activite`) VALUES
(1, 5, '::1', 1),
(3, 4, '::1', 11);

-- --------------------------------------------------------

--
-- Structure de la table `pre_reservation`
--

CREATE TABLE `pre_reservation` (
  `id_reservation` int(11) NOT NULL,
  `date_arrivee` date NOT NULL,
  `date_depart` date NOT NULL,
  `nbr_adulte` int(11) NOT NULL,
  `nbr_enfant` int(11) NOT NULL,
  `date_reservation` date NOT NULL,
  `id_ref_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pre_reservation`
--

INSERT INTO `pre_reservation` (`id_reservation`, `date_arrivee`, `date_depart`, `nbr_adulte`, `nbr_enfant`, `date_reservation`, `id_ref_membre`) VALUES
(2, '2020-05-06', '2020-05-15', 5, 3, '2020-04-03', 1),
(3, '2020-04-25', '2020-04-27', 3, 1, '2020-04-17', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id_activite`),
  ADD KEY `id_ref_admin` (`id_ref_admin`);

--
-- Index pour la table `admin_espace`
--
ALTER TABLE `admin_espace`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `notation`
--
ALTER TABLE `notation`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `notation_ibfk_1` (`id_ref_activite`);

--
-- Index pour la table `pre_reservation`
--
ALTER TABLE `pre_reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_membre` (`id_ref_membre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `admin_espace`
--
ALTER TABLE `admin_espace`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `notation`
--
ALTER TABLE `notation`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `pre_reservation`
--
ALTER TABLE `pre_reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `activites_ibfk_1` FOREIGN KEY (`id_ref_admin`) REFERENCES `admin_espace` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `notation_ibfk_1` FOREIGN KEY (`id_ref_activite`) REFERENCES `activites` (`id_activite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pre_reservation`
--
ALTER TABLE `pre_reservation`
  ADD CONSTRAINT `pre_reservation_ibfk_1` FOREIGN KEY (`id_ref_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
