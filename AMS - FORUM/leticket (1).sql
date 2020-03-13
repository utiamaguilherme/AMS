-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jun-2018 às 13:59
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leticket`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `answers`
--

CREATE TABLE `answers` (
  `id` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `users_id` varchar(50) NOT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tickets_id` varchar(50) NOT NULL,
  `emailsent` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `answerstosend`
-- (See below for the actual view)
--
CREATE TABLE `answerstosend` (
`id` varchar(50)
,`content` text
,`users_id` varchar(50)
,`datecreate` timestamp
,`title` varchar(400)
,`status` varchar(50)
,`cod` int(11)
,`author` varchar(500)
,`author_name` varchar(400)
,`emails` text
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` varchar(50) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `users_id` varchar(50) NOT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id`, `content`, `users_id`, `datecreate`, `post_id`, `ativo`) VALUES
('201806131300567748', 'fdsfdsfsd', '1', '2018-06-13 11:56:00', '201806131344542621', 1),
('201806131304550695', 'fdsfgdsf', '1', '2018-06-13 11:55:04', '2147483647', 1),
('201806131315553252', 'testtttttttttttt', '1', '2018-06-13 11:55:15', '2147483647', 1),
('201806131331580502', 'test', '1', '2018-06-13 11:58:31', '201806131344542621', 1),
('201806131352549304', 'sasasa', '1', '2018-06-13 11:54:52', '2147483647', 1),
('201806131356544962', 'dsadsafd', '1', '2018-06-13 11:54:56', '2147483647', 1),
('201806131358544821', 'fsgsdfs', '1', '2018-06-13 11:54:58', '2147483647', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `globalvars`
--

CREATE TABLE `globalvars` (
  `id` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `datecreate`, `users_id`, `ativo`) VALUES
('201805231419559513', 'sadasd', 'dsadsa', '2018-05-23 12:55:19', '', 1),
('201805231430506321', 'vai se fude', 'renatinho', '2018-05-23 12:50:30', '', 1),
('201805231445531049', 'test', 'sasdasddsadsad', '2018-05-23 12:53:45', '', 1),
('201805231452554503', 'sadasd', 'dsadsa', '2018-05-23 12:55:52', '1', 1),
('201805231537012054', 'vai se fude', 'Peter', '2018-05-23 13:01:37', '1', 1),
('201806131344542621', 'test', 'tst', '2018-06-13 11:54:44', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticketcategories`
--

CREATE TABLE `ticketcategories` (
  `id` varchar(50) NOT NULL,
  `name` varchar(400) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

CREATE TABLE `tickets` (
  `id` varchar(50) NOT NULL,
  `title` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `datacad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  `ticketcategories_id` varchar(50) NOT NULL,
  `creator_users_id` varchar(50) NOT NULL,
  `cod` int(11) NOT NULL,
  `emailsentto` varchar(400) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `datacad`, `status`, `ticketcategories_id`, `creator_users_id`, `cod`, `emailsentto`) VALUES
('201804092130375642', 'Inserir uma resposta ao mudar o status de um ticket', 'Inserir uma resposta ao mudar o status de um ticket', '2018-04-09 19:37:30', 'ConcluÃ­do', 'Melhoria', '201804092239211966', 18, '201804091351222893'),
('201804092143402954', 'Motor do Daileon com barulho estranho', 'Nunc tortor dui, lobortis ut malesuada eu, posuere vehicula ipsum. Etiam sed rhoncus urna, in euismod ante. Nam tempor facilisis nibh, non pellentesque mi elementum at. Nunc efficitur arcu lacus, congue commodo nunc molestie ut. Integer urna nunc, molestie vel laoreet eu, semper eu tortor. Mauris tempor sed massa vel luctus. Vivamus ultricies, ligula et dignissim facilisis, sem diam semper lacus, et faucibus velit ante nec risus. Sed eget libero iaculis, congue leo vitae, lobortis sapien. Vivamus auctor sagittis tincidunt. Pellentesque ornare nulla massa. In et aliquet urna. Aliquam sit amet erat eu mi varius aliquet. Integer tempus convallis gravida. Pellentesque finibus augue quam, id rutrum velit pellentesque interdum.', '2018-04-09 19:40:43', 'ConcluÃ­do', 'Defeito', '201804091351222893', 19, '201804091351222893');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets_users`
--

CREATE TABLE `tickets_users` (
  `tickets_id` varchar(50) NOT NULL DEFAULT '',
  `users_id` varchar(50) NOT NULL DEFAULT '',
  `id` varchar(50) NOT NULL,
  `emailsent` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(200) NOT NULL,
  `datacad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usersgroups_id` varchar(50) NOT NULL,
  `name` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `datacad`, `usersgroups_id`, `name`) VALUES
('1', 'test3@localhost', 'admin', '2018-04-06 00:11:07', '1', 'CÃ©rebro'),
('201804060259134198', 'test2@localhost', 'test2', '2018-04-06 00:13:59', '2', 'Pink'),
('201804081536493871', 'test5@localhost', 'test5', '2018-04-08 13:49:36', '2', 'Minerva Mink'),
('201804091351222893', 'test1@localhost', 'test1', '2018-04-09 11:22:51', '2', 'Jaspion'),
('201804092239211966', 'test7@localhost', '123', '2018-04-09 20:21:39', '2', 'Kiyomi Tsukada'),
('201804092248202040', 'test6@localhost', '123', '2018-04-09 20:20:48', '2', 'Kakaroto'),
('201804092259230119', 'test8@localhost', '123', '2018-04-09 20:23:59', '2', 'Principe Adam'),
('201804101920198235', 'test4@localhost', '7fde9028', '2018-04-10 17:19:20', '2', 'Princesa Adora');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usersgroups`
--

CREATE TABLE `usersgroups` (
  `id` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `power` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usersgroups`
--

INSERT INTO `usersgroups` (`id`, `name`, `description`, `power`) VALUES
('1', 'admin', 'O Admin', 1000),
('2', 'user', 'O User', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `usersrelatedtoticket`
-- (See below for the actual view)
--
CREATE TABLE `usersrelatedtoticket` (
`cod` int(11)
,`title` varchar(400)
,`tid` varchar(50)
,`username` varchar(500)
,`name` varchar(400)
,`uid` varchar(50)
,`tuid` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `answerstosend`
--
DROP TABLE IF EXISTS `answerstosend`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `answerstosend`  AS  select `a`.`id` AS `id`,`a`.`content` AS `content`,`a`.`users_id` AS `users_id`,`a`.`datecreate` AS `datecreate`,`t`.`title` AS `title`,`t`.`status` AS `status`,`t`.`cod` AS `cod`,`u2`.`username` AS `author`,`u2`.`name` AS `author_name`,group_concat(`u`.`username` separator ',') AS `emails` from ((((`tickets` `t` join `answers` `a`) join `users` `u`) join `users` `u2`) join `tickets_users` `tu`) where ((`a`.`tickets_id` = `t`.`id`) and (((`tu`.`users_id` = `u`.`id`) and (`tu`.`tickets_id` = `t`.`id`)) or ((`t`.`creator_users_id` = `u`.`id`) and (`tu`.`users_id` = '') and (`tu`.`tickets_id` = ''))) and (`a`.`emailsent` = 0) and (`u`.`id` <> `a`.`users_id`) and (`u2`.`id` = `a`.`users_id`)) group by `a`.`content` ;

-- --------------------------------------------------------

--
-- Structure for view `usersrelatedtoticket`
--
DROP TABLE IF EXISTS `usersrelatedtoticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usersrelatedtoticket`  AS  select `t`.`cod` AS `cod`,`t`.`title` AS `title`,`t`.`id` AS `tid`,`u`.`username` AS `username`,`u`.`name` AS `name`,`u`.`id` AS `uid`,`tu`.`id` AS `tuid` from ((`tickets` `t` join `tickets_users` `tu`) join `users` `u`) where ((((`tu`.`users_id` = `u`.`id`) and (`tu`.`tickets_id` = `t`.`id`)) or ((`t`.`creator_users_id` = `u`.`id`) and (`tu`.`users_id` = '') and (`tu`.`tickets_id` = '') and (`t`.`emailsentto` <> `t`.`creator_users_id`))) and (`tu`.`emailsent` = 0)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `tickets_users`
--
ALTER TABLE `tickets_users`
  ADD PRIMARY KEY (`tickets_id`,`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
