-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 déc. 2024 à 17:11
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
  `created_at` datetime DEFAULT current_timestamp(),
  `categorie` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author_id`, `views`, `likes`, `tags`, `created_at`, `categorie`) VALUES
(2, 'souhail', 'Benefits of a Forex Demo Account\r\nAssuming you address any carefully prepared dealer, their rundown of demo trading account advantages would be unending for brokers who are initially beginning. Here is a rundown of only a couple of the advantages you might need to be aware of.\r\n\r\nHow to trade Forex in the market without Forex risk using a demo trading account?\r\nPossessing a Forex practice demo trading account is like having Forex preparing. That is on the grounds that it empowers the dealer to incorporate their preparation, without gambling any genuine cash, by trading with virtual assets all things considered. All things considered, the best individuals in any field are the people who have learnt and drilled their specialty impressively – and the equivalent goes for Forex merchants.', 22, 358, 15, 'thecnologie', '2024-12-18 18:39:40', 'education'),
(3, 'Morocco the best country', 'We already know a lot about the upcoming big, hefty, and supposedly super-powered GPUs from Nvidia. But there’s another side to Team Green’s success, and that’s in its DLSS upscaling software. The proprietary blend of resolution upscaling, frame generation, and anti-aliasing may be receiving an upgrade in 2025 with DLSS 4. New leaks from some industry sources suggest that Nvidia’s super scaling tech could be getting “neural rendering capabilities” alongside other AI enhancements to make games run better on lower-end hardware.', 13, 13, 6, 'country', '2024-12-18 18:41:16', 'lifestyle'),
(4, 'souhail', 'Why should you try a Forex demo account before you start?\r\nDid you had any idea that worldwide trading volumes the unfamiliar trade market arrived at record highs? On account of unpredictability in worldwide financial aspects, an ever increasing number of individuals are effectively trading the Forex market. Notwithstanding, Forex trading that turns more turns more than more than $5 trillion each and every day can very dismay from the get go. For this reason your most memorable Forex record ought to be a Forex demo account when you are beginning.', 22, 9, 2, 'os', '2024-12-18 23:06:45', 'technology'),
(5, 'souhail', 'Tailwind is an incredible tool. Used well, it can help pin way more pins to Pinterest than you could ever do manually, meaning you gain better traction and get more saves and clicks, and so massively grow your blog traffic from Pinterest.\r\n\r\nNot only that, but Tailwind will also save you a ton of time! With just 10 minutes a week on Tailwind, you can be pinning 30+ pins on Pinterest every day! And, thanks to Tailwind’s Smart Schedule, those pins will be spread out throughout the day and pinned at the best possible time for success.\r\n\r\nBut I’ll admit, Tailwind can be a bit overwhelming at the outset… and, in fact, one of the reasons why it can sometimes seem like it’s not working is because it’s not being used correctly (or at all!)\r\n\r\nIf you want to grow your blog traffic with Tailwind, you need be using it properly… and you need to be consistent. Tailwind won’t help you increase your blog traffic if you only use it sporadically. You need to be adding adding new pins to your queue every week…. and you need to stick at it!', 13, 8, 2, 'thilwind', '2024-12-19 09:19:18', 'education'),
(8, 'mohamed rajol', 'German-language tech site HardwareLuxx (via VideoCardz) spotted pre-CES marketing from GPU OEM INNO3D (pay no attention to the alphabet soup of tech naming conventions). The manufacturer talked up Nvidia’s advanced “deep learning super sampling offering even better image quality and higher frame rates.” The next-gen GPUs should also have “enhanced ray tracing,” “improved AI-driven upscaling,” and “neural rendering capabilities.”', 13, 2, 1, 'rijal', '2024-12-19 12:27:41', 'health');

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
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('author','visitor') NOT NULL DEFAULT 'visitor',
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
(10, 'Christopher Fleming', 'zupidywiba@mailinator.com', '$2y$10$FdfuHHXU5F7HRPouzs5Lw.rWTBrtSzprNzIU3oI0YBNrugXKWimsm', 'visitor', '2024-12-16 09:29:50'),
(11, 'sofyfut', 'garemekup@mailinator.com', '$2y$10$FXqFPKYn3KhZPOz8P8WM4O4uBi8C7i48FtFvHS60CEHwpktM8.f1K', 'visitor', '2024-12-16 09:53:13'),
(12, 'kekutyv', 'dacadu@mailinator.com', '$2y$10$KtM6mHFFwFbsMWDJAlX4Ye3xTQYcsRXWdftSi1W0xNWFB5jT3mvru', 'author', '2024-12-16 14:47:14'),
(13, 'souhail imarraine', 'souhakech111@gmail.com', '$2y$10$jxo8R5gDihp/w3jmOAYXoOBB8DaRKhM85Lognuqn9JXbMMnNUsJ16', 'author', '2024-12-16 16:48:31'),
(14, 'dudeboju', 'cera@mailinator.com', '$2y$10$HrE7B5X0bcFN0x02zj7Hb.r7mBYV9rde5ehrM1kFbKWmBSmPiAkeW', 'author', '2024-12-16 20:52:13'),
(15, 'gujazitu', 'jukyd@mailinator.com', '$2y$10$X5YMnTVUTXTq/EsA6/KbsOU54A17/eDWt/ow7IY/V/r/sJEPUvDOG', 'author', '2024-12-16 20:56:34'),
(16, 'jufuhyvyx', 'xuvygoqibu@mailinator.com', '$2y$10$rkZ.KM4lkZDCTZr9eaDAfu4vjbj7TcKglblNel2YJx/jiSLyRI3V6', 'author', '2024-12-16 21:27:50'),
(17, 'salah', 'salah@gmail.com', '$2y$10$z7Ump0fdZj0eNPWl3VEkxOOTcksi.PHOIxWRqKNKH/I5TBXGkqOpG', 'author', '2024-12-17 20:31:56'),
(18, 'ali', 'ali@gmail.com', '$2y$10$qYpgIJnuI0NVAp06N/dFEOFfimRMot/4WbvkHS8CZzOSXk0NBm6i6', 'author', '2024-12-17 20:33:29'),
(19, 'wigeka', 'sujaca@mailinator.com', NULL, 'visitor', '2024-12-17 22:06:14'),
(20, 'popat', 'fyfaqus@mailinator.com', NULL, 'visitor', '2024-12-17 22:12:12'),
(21, 'qefoso', 'hebogikabe@mailinator.com', NULL, 'visitor', '2024-12-17 22:41:08'),
(22, 'Solico', 'nuleaaaaaa@gmail.com', '$2y$10$pUQnH8pPw.sbxeHccMHHxuJ7Qn8e6Owt2ChYB3JMASRkt772Yl9ui', 'author', '2024-12-18 11:01:33'),
(23, 'nobykadu', 'jywawinoci@mailinator.com', '$2y$10$.THwKzSnPfCyeH59zuQKVuQxe5UtTLWieb79IW.ewNKcYukkH4FZ2', 'author', '2024-12-18 22:53:43'),
(24, 'salah', 'Salahimarraine@gmail.com', '$2y$10$lTZ2kga9ZEocl/fxQIzybedhIEioXGgXIRC0vu0H0NYGApRJTqFpC', 'author', '2024-12-19 19:07:04'),
(25, 'firiwerysy', 'jetixut@mailinator.com', '$2y$10$O0tcWHSeO1Ui.v2p82JUqe9F.ejidVoDUOZSRAxevls1M0Yr38GnG', 'author', '2024-12-19 19:23:49');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
  
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
