-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 03 avr. 2018 à 12:01
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `my_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `civilite` varchar(255) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `civilite`, `comment_date`) VALUES
(1, 1, 'sabri', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum congue ligula sed euismod porttitor. Proin vestibulum feugiat eleifend. Vivamus non arcu ac purus lobortis vehicula. Nam porttitor lacus velit, id tincidunt felis luctus ut. Sed viverra elit eget suscipit pretium. Fusce sagittis pretium mauris, sed tincidunt sapien gravida id. Cras luctus justo elit, quis feugiat ipsum tincidunt eget. Etiam gravida ex nunc, quis interdum nisl eleifend a. Ut vitae orci tincidunt, gravida lorem vel, vulputate nulla. Vivamus in sem tempus orci pellentesque eleifend. Curabitur facilisis at justo vel placerat. Etiam pharetra elit ut est facilisis, id sollicitudin massa fringilla. Praesent et rutrum nulla.', 'man', '2018-03-31 10:59:38'),
(2, 2, 'michel', 'ex nunc, quis interdum nisl eleifend a. Ut vitae orci tincidunt, gravida lorem vel, vulputate nulla. Vivamus in sem tempus orci pellentesque eleifend. Curabitur facilisis at justo vel placerat. Etiam pharetra elit ut est facilisis, id sollicitudin massa fringilla. Praesent et rutrum nulla.', 'woman', '2018-03-31 10:59:53'),
(3, 1, 'diolene', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum congue ligula sed euismod porttitor. Proin vestibulum feugiat eleifend. Vivamus non arcu ac purus lobortis vehicula. Nam porttitor lacus velit, id tincidunt felis ', 'woman', '2018-03-31 11:00:07'),
(4, 1, 'beyouna', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum congue ligula sed euismod porttitor. Proin orci pellentesque eleifend. Curabitur facilisis at justo vel placerat. Etiam pharetra elit ut est facilisis, id sollicitudin massa fringilla. Praesent et rutrum nulla.', 'woman', '2018-03-31 11:00:28'),
(6, 1, 'kevin', 'trop cool ton blog', 'man', '2018-03-13 13:20:48'),
(7, 1, 'bernadette', 'vraiment de la merde ton blog', 'woman', '2018-03-13 13:44:55'),
(8, 1, 'sandrine', 'c de la merde', 'woman', '2018-03-13 14:01:23'),
(9, 1, 'pierre', 'salut tres jolie glog', 'man', '2018-03-13 14:11:39'),
(10, 1, 'julie', 'c nul', 'woman', '2018-03-13 14:14:04'),
(11, 1, 'bernard', 'vraiment a chier ton blog\r\n', 'woman', '2018-03-13 14:17:16'),
(12, 1, 'leon', 'super blog\r\n', 'man', '2018-03-13 15:01:54'),
(13, 4, 'brunon', 'ooooooh des moutons', 'man', '2018-03-13 15:02:42'),
(14, 1, 'nordine', 'super genial ton blog vient on fortnite, as tu besoin d\'un directeur marketing stp?', 'man', '2018-03-13 15:53:05'),
(15, 1, 'lionel', 'je pense que tu fait trop de tests...', 'man', '2018-03-13 16:51:21'),
(16, 2, 'test', 'test', 'man', '2018-03-13 17:03:36'),
(17, 2, 'celine', 'top ton blog\r\n', 'woman', '2018-03-13 21:12:59'),
(18, 2, 'julien', 'salut', 'man', '2018-03-22 00:29:53'),
(19, 3, 'daniel', 'Suspendisse pellentesque libero mauris, vitae dignissim ante tincidunt id. Maecenas quis magna aliquet, porttitor purus sit amet, facilisis magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla sagittis elit nec nulla vehicula pharetra. Morbi sagittis turpis sollicitudin accumsan pellentesque. Pellentesque eu lacus finibus, congue velit sed, maximus lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 'man', '2018-03-31 14:01:59');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(2555) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 'L\'alimentation des animaux et insectes', 'Les animaux et insectes ont une alimentation propre à leur espèce et au groupe dont ils font partie. Les carnivores mangent des proies et digèrent les tissus animaux pour s\'alimenter. Les herbivores mangent des tissus végétaux, donc des plantes, herbes... Un animal omnivore mange de tout, des proies et des végétaux.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMlGN9chNy9gwCK5pUAOWaP5YXNm8yjvEOhWLfUYs_RF_amoao', '2018-03-26 23:02:31', '2018-04-01 14:16:29'),
(2, 'Ils ne sont pas nécessairement dangereux', 'Un animal sauvage donne l\'impression qu\'il est dangereux comme le lion d\'Afrique, mais ce n\'est pas tout les animaux sauvages qui sont dangereux. En fait tous les animaux sont sauvages, les chats, chiens, chevaux étaient tous sauvages avant d\'être domestiqués par l\'homme. Il reste encore des chevaux sauvages et ils ne sont pas dangereux pour l\'homme.', 'http://www.cdtl.fr/wp-content/uploads/2014/01/Animaux-sauvages-3.jpeg', '2018-03-13 15:39:10', '2018-04-01 14:16:29'),
(3, 'Animal et insecte volant', 'Un animal volant est naturellement un animal qui peut voler. Ce n\'est pas nécessairement un oiseau car certains sont des mammifères comme la chauve souris. Les ailes servent à voler et sont souvent recouverte de plumes, mais ce n\'est pas la règle, encore la chauve souris n\'a pas de plumes et la majorité des insectes n\'en ont pas.', 'http://img.over-blog-kiwi.com/610x405-ct/1/28/35/22/obpiceEOHKC.jpeg', '2018-03-06 23:00:00', '2018-04-01 14:16:29'),
(4, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(5, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(6, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(7, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(8, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(9, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(10, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(11, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(12, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(13, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(14, 'Les animaux domestiques de la ferme', 'Un animal de la ferme est un animal sauvage qui a été domestiqué pour son travail comme le cheval ou pour sa viande comme le cochon. Ils ont donc soit une utilité alimentaire ou servent à certaines taches. A moins d\'en tirer un certain profit, l\'homme ne garde pas d\'animal qui ne lui est pas vraiment utile.', 'http://www.crdp-strasbourg.fr/main2/albums/animaux_ferme/img_hr/image22.jpg', '2018-03-07 19:04:25', '2018-04-01 14:16:29'),
(23, 'chalet', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sapien nisi. Mauris posuere lorem et porta faucibus. Aenean odio lacus, venenatis eu gravida commodo, pulvinar at nisl. Cras vitae est pulvinar, porta lorem vitae, sagittis quam. Pellentesque sed consectetur sapien. Ut pretium convallis nisi, ut viverra arcu ornare suscipit. Phasellus egestas aliquam tincidunt. Cras eget commodo massa.</p>\r\n<p>Duis tincidunt ultricies enim, et dictum ligula condimentum id. Mauris in rhoncus nunc. In scelerisque augue eros, ut vulputate ante vestibulum maximus. Pellentesque elementum purus id est congue, porta condimentum enim congue. Cras eu varius arcu. Nam nec vulputate lacus. Nulla facilisi. Vivamus id quam mauris. Mauris ipsum mi, suscipit ac est vulputate, ullamcorper efficitur augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam interdum fringilla lectus vitae maximus. Fusce auctor auctor nunc, quis fringilla diam aliquam sit amet. Curabitur gravida mattis vestibulum.</p>', 'public/assets/images/uploads/chalet-a-vendre.jpg', '2018-04-02 11:11:07', '2018-04-02 11:11:07'),
(24, 'test', '<p>hgdh fhgwej gfjhdsg f</p>', 'public%2Fassets%2Fimages%2Fuploads%2FCapture+d%E2%80%99e%CC%81cran+2018-02-03+a%CC%80+17.44.36.png', '2018-04-02 11:45:41', '2018-04-02 11:45:41'),
(25, 'frigo', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sapien nisi. Mauris posuere lorem et porta faucibus. Aenean odio lacus, venenatis eu gravida commodo, pulvinar at nisl. Cras vitae est pulvinar, porta lorem vitae, sagittis quam. Pellentesque sed consectetur sapien. Ut pretium convallis nisi, ut viverra arcu ornare suscipit. Phasellus egestas aliquam tincidunt. Cras eget commodo massa.</p>\r\n<p>Duis tincidunt ultricies enim, et dictum ligula condimentum id. Mauris in rhoncus nunc. In scelerisque augue eros, ut vulputate ante vestibulum maximus. Pellentesque elementum purus id est congue, porta condimentum enim congue. Cras eu varius arcu. Nam nec vulputate lacus. Nulla facilisi. Vivamus id quam mauris. Mauris ipsum mi, suscipit ac est vulputate, ullamcorper efficitur augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam interdum fringilla lectus vitae maximus. Fusce auctor auctor nunc, quis fringilla diam aliquam sit amet. Curabitur gravida mattis vestibulum.</p>\r\n<p>Vivamus lectus neque, consectetur sed purus eget, vehicula accumsan ex. Curabitur sagittis efficitur pulvinar. Praesent pellentesque ante sed nisl malesuada, eget tempor lacus consectetur. Phasellus vestibulum elementum neque eu fermentum. Proin vitae eleifend diam. Praesent semper ultrices elit, quis porta dolor mattis quis. Nunc elit quam, facilisis sit amet auctor ac, ultrices non augue. Integer sit amet imperdiet magna. Donec placerat, justo vitae laoreet elementum, lacus arcu tristique ante, quis bibendum ex nisl at enim. Proin in diam at erat lobortis lacinia. Nunc sagittis in nibh vulputate eleifend. Nulla facilisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>', 'public%2Fassets%2Fimages%2Fuploads%2FCapture+d%E2%80%99e%CC%81cran+2018-02-19+a%CC%80+15.11.19.png', '2018-04-02 12:36:12', '2018-04-02 12:36:12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `civilite` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `role`, `prenom`, `password`, `email`, `civilite`, `register_date`, `updated_date`) VALUES
(78, 'admin', 'admin', '$2y$10$solnSqPJhZCy1SGtoJv9lOgkmhdGWWh.SQgUmavzPz1y8sexVFopm', 'admin@admin.com', 'man', '2018-03-27 21:39:22', '2018-03-27 21:38:39'),
(79, 'visitor', 'visitor', '$2y$10$fdMttIoyeO6FyzoEixNSEetXhbgzBeQopY8qPnu.egzemDowZ0L4K', 'visitor@visitor.com', 'woman', '2018-03-27 21:40:12', '2018-03-27 21:40:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
