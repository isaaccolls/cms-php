-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Nov 20, 2019 at 06:38 PM
-- Server version: 5.7.28
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `introduccion` text NOT NULL,
  `ruta` text NOT NULL,
  `contenido` text NOT NULL,
  `orden` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `introduccion`, `ruta`, `contenido`, `orden`) VALUES
(6, 'You gotta think like a tree', 'Don\'t forget to tell these special people in your life just how special they are to you. Every time you practice, you learn more. Get away from those little Christmas tree things we used to make in school. It\'s a very cold picture...', 'views/images/articulos/articulo429.jpg', 'You gotta think like a tree. Every time you practice, you learn more. Get away from those little Christmas tree things we used to make in school. It\'s a very cold picture, I may have to go get my coat. Itâ€™s about to freeze me to death. You can do anything your heart can imagine. With something so strong, a little bit can go a long way.', 3),
(9, 'Let\'s do that again', 'Just let your mind wander and enjoy. This should make you happy. You create the dream - then you bring it into your world. This is probably the greatest thing to happen i...', 'views/images/articulos/articulo449.jpg', 'Just let your mind wander and enjoy. This should make you happy. You create the dream - then you bring it into your world. This is probably the greatest thing to happen in my life - to be able to share this with you. This is a happy place, little squirrels live here and play. If it\'s not what you want - stop and change it. Don\'t just keep going and expect it will get better.\r\n', 4),
(10, 'You can do it', 'I really believe that if you practice enough you could paint the \'Mona Lisa\' with a two-inch brush. Just let this happen. We just let this flow right out of our minds. It...', 'views/images/articulos/landscape02.jpg', 'I really believe that if you practice enough you could paint the \'Mona Lisa\' with a two-inch brush. Just let this happen. We just let this flow right out of our minds. It\'s cold, but it\'s beautiful. Maybe he has a little friend that lives right over here.', 1),
(11, 'This is gonna be a happy little seascape', 'I really believe that if you practice enough you could paint the \'Mona Lisa\' with a two-inch brush. Let\'s make some happy little clouds in our world. This is where you ta...', 'views/images/articulos/articulo953.jpg', 'I really believe that if you practice enough you could paint the \'Mona Lisa\' with a two-inch brush. Let\'s make some happy little clouds in our world. This is where you take out all your hostilities and frustrations. It\'s better than kicking the puppy dog around and all that so. We need a shadow side and a highlight side.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `ruta` text,
  `orden` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeria`
--

INSERT INTO `galeria` (`id`, `ruta`, `orden`) VALUES
(10, '../../views/images/galeria/galeria954.jpg', 9),
(15, '../../views/images/galeria/galeria304.jpg', 6),
(16, '../../views/images/galeria/galeria371.jpg', 7),
(18, '../../views/images/galeria/galeria441.jpg', 10),
(20, '../../views/images/galeria/galeria890.jpg', 8),
(21, '../../views/images/galeria/galeria642.jpg', 5),
(22, '../../views/images/galeria/galeria197.jpg', 2),
(23, '../../views/images/galeria/galeria193.jpg', 3),
(24, '../../views/images/galeria/galeria129.jpg', 1),
(25, '../../views/images/galeria/galeria432.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` text,
  `email` text,
  `mensaje` text,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `revision` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mensajes`
--

INSERT INTO `mensajes` (`id`, `nombre`, `email`, `mensaje`, `fecha`, `revision`) VALUES
(3, 'prueba uno', 'colls_isaac@hotmail.com', 'Nothing\'s gonna make your husband or wife madder than coming home and having a snow-covered dinner. Maybe there\'s a happy little bush that lives right there. Use what happens naturally, don\'t fight it. We\'ll put a happy little bush here. Every time you practice, you learn more. But we\'re not there yet, so we don\'t need to worry about it.', '2019-11-17 15:02:35', 1),
(5, 'pedro perez', 'colls_isaac@hotmail.com', 'Here we\'re limited by the time we have. Trees cover up a multitude of sins. This is probably the greatest thing to happen in my life - to be able to share this with you. Learn when to stop.\r\n', '2019-11-17 15:02:35', 1),
(33, 'qwe', 'cliente@webmastery420.com', 'Trees live in your fan brush, but you have to scare them out. We\'ll put a happy little bush here. You have to make almighty decisions when you\'re the creator.\r\n', '2019-11-17 15:09:35', 1),
(34, 'prueba uno', 'colls_isaac@hotmail.com', 'Nothing\'s gonna make your husband or wife madder than coming home and having a snow-covered dinner. Maybe there\'s a happy little bush that lives right there. Use what happens naturally, don\'t fight it. We\'ll put a happy little bush here. Every time you practice, you learn more. But we\'re not there yet, so we don\'t need to worry about it.', '2019-11-17 15:02:35', 1),
(35, 'pedro perez', 'colls_isaac@hotmail.com', 'Here we\'re limited by the time we have. Trees cover up a multitude of sins. This is probably the greatest thing to happen in my life - to be able to share this with you. Learn when to stop.\r\n', '2019-11-17 15:02:35', 1),
(36, 'qwe', 'cliente@webmastery420.com', 'Trees live in your fan brush, but you have to scare them out. We\'ll put a happy little bush here. You have to make almighty decisions when you\'re the creator.\r\n', '2019-11-17 15:09:35', 1),
(37, 'qwe', 'cliente@webmastery420.com', 'Trees live in your fan brush, but you have to scare them out. We\'ll put a happy little bush here. You have to make almighty decisions when you\'re the creator.\r\n', '2019-11-17 15:09:35', 1),
(38, 'Marielis Vera', 'mvera.colmenarez@gmail.com', 'testing', '2019-11-18 15:16:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `titulo` text,
  `descripcion` text,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `ruta`, `titulo`, `descripcion`, `orden`) VALUES
(8, '../../views/images/slide/slide01.jpg', 'nuevo titulo5', 'desc 5', 2),
(18, '../../views/images/slide/slide03.jpg', 'test from db', 'testing...', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suscriptores`
--

CREATE TABLE `suscriptores` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `revision` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suscriptores`
--

INSERT INTO `suscriptores` (`id`, `nombre`, `email`, `revision`) VALUES
(1, 'pedro perez', 'colls_isaac@hotmail.com', 1),
(4, 'pedro perez', 'cliente@webmastery420.com', 1),
(5, 'Marielis Vera', 'mvera.colmenarez@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(21) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `photo` text NOT NULL,
  `rol` int(11) NOT NULL,
  `intentos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `email`, `photo`, `rol`, `intentos`) VALUES
(1, 'admin', 'llIgBcedGJeH.', 'admin@correo.edited', 'views/images/perfiles/perfil288.jpg', 0, 0),
(3, 'juanEditadoO', 'llCIh/kmoU6Z6', 'juan@hotmail.con', 'views/images/perfiles/perfil944.jpg', 1, 0),
(26, 'test420', 'llIgBcedGJeH.', 'test@hotmail.com', 'views/images/photo.jpg', 0, 0),
(27, 'editor', 'llIgBcedGJeH.', 'editor@420.com', 'views/images/perfiles/perfil594.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `ruta` text,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `ruta`, `orden`) VALUES
(5, '../../views/videos/video660.mp4', 2),
(12, '../../views/videos/video289.mp4', 1),
(13, '../../views/videos/video157.mp4', 4),
(14, '../../views/videos/video876.mp4', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suscriptores`
--
ALTER TABLE `suscriptores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `suscriptores`
--
ALTER TABLE `suscriptores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
