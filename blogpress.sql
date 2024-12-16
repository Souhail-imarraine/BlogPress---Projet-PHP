-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 16 déc. 2024 à 09:43
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blogpress`
--

-- --------------------------------------------------------
--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `likes` int(11) DEFAULT 0,
  `tags` varchar(255) DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `likes` int(11) DEFAULT 0,
  `comments_count` int(11) DEFAULT 0,
  `date_recorded` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('author','visitor') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'SOUHAIL', 'imarrainesouhail202@gmail.com', '$2y$10$I7RzzcZ6x0IM5ybxH9i3leZ0DUoTxeCNM22yDxGTrYktIPQm9sf/y', 'visitor', '2024-12-14 23:57:33'),
(2, 'salah imarraine', 'souhakech1@gmail.com', '$2y$10$sYuM4VcSgNiDFgn6I5S2Yu0xAASM.kzh2AXcwSGIwX9qbHC5xj8yW', 'author', '2024-12-14 23:58:57'),
(3, 'yasser', 'yasser@gmail.com', '$2y$10$j1ZZqP2E1zKAhjMqX0q9EueILklCEd0ExEoBks9Gkb4jMt54BJXNG', 'author', '2024-12-14 23:59:49'),
(4, 'Kimberley Anthony', 'zecoqixyfi@mailinator.com', '$2y$10$q7VDKSsOLvY3tIduU4bbHOmPhUNt0RhI52388KjUjcxJrReuHbHUC', 'visitor', '2024-12-15 00:03:48'),
(5, 'Risa Huff', 'tycuqow@mailinator.com', '$2y$10$jSER8uPA0KbO4kSA.UuKOui9dOWTbugfcfuyRB6Hp0cIzGi8tx9Uu', 'author', '2024-12-15 00:03:59'),
(6, 'Lee Green', 'zusi@mailinator.com', '$2y$10$AC56SMjQJzx31D48HvOlXOu3Azo7xkvoEZj2HU6KtTLqFMNeajJ0q', 'visitor', '2024-12-15 00:23:39'),
(7, 'Noble Levy', 'difulydug@mailinator.com', '$2y$10$up1lcptVELfQQ/csP74vdupsAXpPR4mbd1jEql/yp2nvs9kZln.g.', 'author', '2024-12-15 00:23:55'),
(8, 'Freya Gilbert', 'pegemiv@mailinator.com', '$2y$10$RvElEaxfimowmg3C1oNpiOaiIvkgI/cY1p/vq1ZAYNkKpaUdMDon2', 'author', '2024-12-15 17:50:50'),
(9, 'Allegra Espinoza', 'xorutase@mailinator.com', '$2y$10$VshGL6n21WQbORZ9rEgnQujOkGQgc1oyuuxqLkWYOW43SHXnHq7Ca', 'visitor', '2024-12-16 00:07:18'),
(10, 'Christopher Fleming', 'zupidywiba@mailinator.com', '$2y$10$FdfuHHXU5F7HRPouzs5Lw.rWTBrtSzprNzIU3oI0YBNrugXKWimsm', 'visitor', '2024-12-16 09:29:50');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
