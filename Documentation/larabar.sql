-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2018 at 03:47 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larabar`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `FIRSTNAME` varchar(255) DEFAULT NULL,
  `LASTNAME` varchar(255) DEFAULT NULL,
  `ADMIN` varchar(255) DEFAULT NULL,
  `AVATAR` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `EMAIL`, `PASSWORD`, `FIRSTNAME`, `LASTNAME`, `ADMIN`, `AVATAR`) VALUES
(1, 'Donec@velitjustonec.edu', '1690', 'Lacey', 'Espinoza', '1', 'Accumsan Neque Incorporated'),
(2, 'Pellentesque@scelerisquemollis.edu', '3530', 'Kennedy', 'Battle', '1', 'Tristique Pellentesque Corp.'),
(3, 'viverra@temporestac.net', '1121', 'Justin', 'Carpenter', '1', 'Eget Tincidunt Dui Limited'),
(4, 'ipsum@mauris.co.uk', '7562', 'Jael', 'Blevins', '1', 'Dolor Corp.'),
(5, 'commodo.ipsum.Suspendisse@egestasadui.org', '2079', 'Kirestin', 'Knight', '0', 'Semper Industries'),
(6, 'inceptos@necdiam.edu', '8212', 'Steven', 'Johns', '1', 'Lorem Sit Consulting'),
(7, 'aliquet@AeneanmassaInteger.org', '1660', 'Wing', 'Kline', '1', 'Mollis Phasellus Libero LLP'),
(8, 'nulla@augueutlacus.org', '3860', 'Oliver', 'Murray', '1', 'A Magna Lorem Ltd'),
(9, 'neque.Nullam.nisl@Nullam.ca', '1211', 'Castor', 'Contreras', '1', 'Pede Ultrices Inc.'),
(10, 'a@nec.ca', '5585', 'Owen', 'Valdez', '1', 'Donec LLC'),
(11, 'nulla.Integer.vulputate@ridiculusmus.com', '6032', 'Connor', 'Lyons', '1', 'Tristique Corporation'),
(12, 'cursus@sociisnatoquepenatibus.org', '9189', 'Devin', 'Cochran', '0', 'Congue Turpis Ltd'),
(13, 'Cras.dictum.ultricies@fringilla.org', '5985', 'Talon', 'Stout', '0', 'Sociis Natoque Penatibus Ltd'),
(14, 'fringilla.cursus@Integervulputaterisus.co.uk', '3078', 'Ariana', 'Monroe', '0', 'Lacus Cras Foundation'),
(15, 'magna@loremvehicula.org', '6101', 'Hasad', 'Alston', '1', 'Leo Morbi Foundation'),
(16, 'tellus@ornareFusce.co.uk', '5749', 'Maggie', 'Craig', '1', 'Lobortis Nisi Nibh Inc.'),
(17, 'mi.Aliquam@semper.co.uk', '8538', 'Kibo', 'Ewing', '1', 'Tincidunt Dui Augue Limited'),
(18, 'adipiscing@lectus.net', '1850', 'Keaton', 'Stewart', '1', 'Risus Donec Inc.'),
(19, 'Sed.molestie@sitamet.co.uk', '3092', 'Petra', 'Frye', '1', 'Scelerisque Mollis Phasellus Institute'),
(20, 'enim.nisl.elementum@neccursusa.edu', '8901', 'Xerxes', 'Mendoza', '0', 'Vestibulum Ante Ipsum Industries'),
(21, 'Praesent.interdum.ligula@dictumauguemalesuada.edu', '4612', 'Rahim', 'Mcfadden', '0', 'Sapien Incorporated'),
(22, 'risus.In@inlobortis.ca', '2378', 'Chase', 'Reed', '1', 'Diam Industries'),
(23, 'Nam.interdum@lacus.net', '3882', 'Price', 'Murphy', '1', 'Nonummy Inc.'),
(24, 'ultrices@urna.edu', '6533', 'Morgan', 'Nelson', '1', 'Natoque Penatibus Et Corporation'),
(25, 'eu.dui.Cum@pretiumetrutrum.com', '8706', 'Felix', 'Leblanc', '1', 'Commodo Ipsum Suspendisse Corporation'),
(26, 'adipiscing.Mauris@urna.edu', '2447', 'Maggy', 'Stanley', '0', 'Blandit Foundation'),
(27, 'tellus.imperdiet.non@Mauris.co.uk', '5285', 'Brent', 'Golden', '0', 'Ornare Lectus Company'),
(28, 'orci@elementumlorem.ca', '1164', 'Joel', 'Hickman', '0', 'Mattis LLP'),
(29, 'in.felis@liberoProin.co.uk', '1632', 'Hollee', 'Meadows', '0', 'Viverra Ltd'),
(30, 'lectus.sit@ascelerisque.edu', '6106', 'Garth', 'Moody', '0', 'Nulla Donec Non Industries'),
(31, 'Phasellus.ornare@Aliquam.net', '2682', 'Arsenio', 'Frye', '1', 'Cubilia Curae; Limited'),
(32, 'Praesent.eu.nulla@volutpat.edu', '1567', 'Nehru', 'Burnett', '1', 'Est Tempor Bibendum LLP'),
(33, 'Cras.sed.leo@blanditNamnulla.ca', '6122', 'Xantha', 'Stone', '0', 'Vel LLC'),
(34, 'nibh@ametdapibusid.co.uk', '3869', 'Rogan', 'Huber', '1', 'Dolor Dolor Incorporated'),
(35, 'ornare@tempusscelerisque.org', '3176', 'Juliet', 'Fleming', '0', 'Cursus Company'),
(36, 'fringilla.cursus@tinciduntneque.co.uk', '8658', 'Cullen', 'Kaufman', '0', 'Vitae Velit Ltd'),
(37, 'Vivamus@Phasellusfermentumconvallis.ca', '3700', 'Sybill', 'Pacheco', '1', 'Ornare In Limited'),
(38, 'sagittis.augue.eu@nonlaciniaat.edu', '5459', 'Kibo', 'Duran', '0', 'Consectetuer Industries'),
(39, 'tincidunt@nuncnullavulputate.co.uk', '4798', 'Brenda', 'Coleman', '0', 'Elementum Incorporated'),
(40, 'interdum.ligula.eu@arcuMorbisit.ca', '7373', 'Selma', 'Steele', '1', 'Phasellus Fermentum Corp.'),
(41, 'orci.Ut@urna.org', '5083', 'Yoshio', 'Gomez', '0', 'Mattis Ltd'),
(42, 'Nulla.facilisis.Suspendisse@metusAeneansed.ca', '6753', 'Felix', 'Shaw', '1', 'Amet Massa Quisque Limited'),
(43, 'aptent.taciti@tinciduntadipiscingMauris.net', '5011', 'Luke', 'Day', '0', 'Ut Odio Vel LLC'),
(44, 'nostra.per.inceptos@elementumsemvitae.co.uk', '6849', 'Hop', 'Callahan', '0', 'Nulla Tincidunt Industries'),
(45, 'arcu.vel@lorem.ca', '3959', 'Hillary', 'Gilliam', '0', 'Nullam Nisl Maecenas Associates'),
(46, 'dictum.placerat@nuncInat.net', '9326', 'Damian', 'Banks', '0', 'Suspendisse Institute'),
(47, 'aliquam.iaculis@acturpisegestas.ca', '7472', 'Carl', 'Maxwell', '0', 'Dictum Cursus Nunc Limited'),
(48, 'Proin.nisl@placerat.ca', '1732', 'Paki', 'Barnes', '1', 'Augue Eu Tempor PC'),
(49, 'massa.Vestibulum.accumsan@morbi.ca', '6130', 'Cruz', 'Noble', '1', 'Adipiscing LLC'),
(50, 'in@Cumsociis.org', '1684', 'Eric', 'Gilbert', '1', 'Dictum Corporation'),
(51, 'tristique@placeratCras.ca', '7441', 'Piper', 'Rodgers', '0', 'Est Corp.'),
(52, 'malesuada@nullaIntegerurna.co.uk', '2987', 'Murphy', 'Colon', '1', 'Sit Amet Lorem LLC'),
(53, 'nibh.enim.gravida@liberoIntegerin.ca', '3918', 'Clinton', 'Hutchinson', '0', 'Magna Ut Tincidunt Consulting'),
(54, 'convallis@ornare.org', '9501', 'Nayda', 'Carter', '1', 'Et Limited'),
(55, 'nisl.arcu.iaculis@vestibulumMauris.com', '9281', 'Evan', 'Fry', '0', 'Facilisis Ltd'),
(56, 'magna@natoque.ca', '5797', 'Vivien', 'Brady', '0', 'Iaculis Enim Sit Foundation'),
(57, 'orci.sem.eget@urnaconvallis.edu', '9863', 'Germaine', 'Pena', '0', 'Dui PC'),
(58, 'enim.nisl@Nullam.org', '3495', 'Byron', 'Norman', '1', 'Neque Et Nunc Foundation'),
(59, 'facilisis.Suspendisse@eros.org', '7467', 'Adam', 'Knapp', '0', 'Nunc Sit Corporation'),
(60, 'cursus.in@utdolordapibus.net', '8499', 'Kelly', 'Pate', '0', 'Donec Dignissim Magna Consulting'),
(61, 'et.eros@egetmollislectus.edu', '2796', 'Zachary', 'Woodward', '1', 'Commodo Ipsum PC'),
(62, 'lobortis.mauris.Suspendisse@erateget.edu', '2321', 'Charity', 'Mcmahon', '0', 'Etiam PC'),
(63, 'orci@arcuiaculisenim.edu', '1916', 'Carol', 'Conley', '0', 'Augue Sed Inc.'),
(64, 'a@lacusNullatincidunt.net', '8041', 'Lucius', 'Ewing', '1', 'Nunc Mauris Sapien Foundation'),
(65, 'odio.a@musDonecdignissim.edu', '9990', 'Clarke', 'Boyer', '0', 'Nec Urna Et Consulting'),
(66, 'Proin.vel.nisl@Quisque.net', '2762', 'Mona', 'Cooley', '1', 'Dignissim Lacus Corporation'),
(67, 'nulla.Integer@Nullamvelit.net', '5697', 'Candace', 'Hernandez', '0', 'Lacus Cras Interdum PC'),
(68, 'placerat.augue@imperdietornare.co.uk', '2837', 'Regina', 'Reyes', '1', 'Risus Nunc Incorporated'),
(69, 'vitae.erat.Vivamus@magna.ca', '3436', 'Griffin', 'Sherman', '1', 'Lorem Auctor Quis Ltd'),
(70, 'turpis@orciquislectus.ca', '4890', 'Gretchen', 'Ward', '0', 'Fringilla Cursus Purus Industries'),
(71, 'auctor.quis.tristique@velitSedmalesuada.net', '4240', 'Ruby', 'Buckner', '1', 'Lorem Incorporated'),
(72, 'neque@Phasellus.net', '2001', 'Paki', 'Harrington', '0', 'Sed Neque Sed Industries'),
(73, 'dapibus@luctusfelis.ca', '9740', 'Mary', 'Jacobson', '0', 'Odio Sagittis Semper Incorporated'),
(74, 'mauris.Integer.sem@luctusaliquet.com', '9822', 'Wyatt', 'Reese', '1', 'Magna LLC'),
(75, 'interdum@orciinconsequat.edu', '2044', 'Kasimir', 'Bradshaw', '1', 'Porttitor Foundation'),
(76, 'pretium@nisisemsemper.com', '7759', 'Melinda', 'Mathews', '0', 'Adipiscing Associates'),
(77, 'gravida.Aliquam@porttitor.net', '4290', 'Mannix', 'Garner', '1', 'A Auctor Non Institute'),
(78, 'ipsum.sodales@etrisusQuisque.edu', '2310', 'Nerea', 'Donovan', '1', 'Pellentesque Habitant Limited'),
(79, 'egestas.ligula@CraspellentesqueSed.org', '8095', 'Shaeleigh', 'Copeland', '0', 'Magnis Industries'),
(80, 'nulla@elitAliquam.co.uk', '3228', 'Brennan', 'Brown', '0', 'Orci Sem Institute'),
(81, 'nisl.Quisque@arcuCurabiturut.co.uk', '7909', 'Maia', 'Herman', '1', 'Magna Malesuada Vel Associates'),
(82, 'vestibulum.nec@elit.net', '1274', 'Walker', 'Gilbert', '1', 'Sapien LLP'),
(83, 'amet@at.net', '6529', 'Hammett', 'Newman', '0', 'Pede Ltd'),
(84, 'enim.mi.tempor@Aliquamrutrumlorem.co.uk', '7106', 'Dexter', 'David', '0', 'Mauris Erat Eget Corp.'),
(85, 'non@turpisvitaepurus.ca', '2749', 'Briar', 'Mcdonald', '0', 'Et Corporation'),
(86, 'Sed.eu.eros@dignissim.org', '4527', 'Tara', 'Justice', '1', 'Nibh Lacinia Orci Consulting'),
(87, 'pharetra.felis.eget@Cras.co.uk', '1162', 'Judith', 'Odonnell', '0', 'A Facilisis Corp.'),
(88, 'a@fermentum.com', '5169', 'Brody', 'Soto', '1', 'At Company'),
(89, 'malesuada.fames.ac@sem.com', '9015', 'Stuart', 'Walters', '0', 'Mauris LLP'),
(90, 'nunc.In@vestibulumMaurismagna.org', '7995', 'Solomon', 'Merrill', '1', 'Nunc Industries'),
(91, 'Donec.non@iaculis.org', '6714', 'Henry', 'Roth', '1', 'Netus Et Company'),
(92, 'vitae.semper@molestie.net', '6617', 'Rajah', 'Conner', '0', 'Nullam Vitae Diam Ltd'),
(93, 'eu@etrutrumeu.org', '6801', 'Kai', 'Mcintyre', '1', 'Adipiscing Lobortis PC'),
(94, 'ante@fermentumrisus.com', '9102', 'Bevis', 'Livingston', '0', 'Lorem Inc.'),
(95, 'elit.elit.fermentum@sodalespurusin.net', '2021', 'Madeline', 'Hubbard', '0', 'Quis LLC'),
(96, 'pulvinar.arcu@vitaeerat.com', '2341', 'Jayme', 'Holmes', '1', 'Quis Ltd'),
(97, 'Suspendisse.ac.metus@diamluctus.net', '4860', 'Colin', 'Fisher', '1', 'Ipsum Leo Inc.'),
(98, 'elit.Aliquam.auctor@Phasellusvitae.com', '3807', 'Samuel', 'Allen', '0', 'Leo Morbi Neque Associates'),
(99, 'ullamcorper@anteVivamusnon.ca', '6086', 'Joy', 'Rosales', '1', 'Gravida Sit Institute'),
(100, 'nec@Loremipsumdolor.edu', '5635', 'Calvin', 'Miranda', '1', 'Tellus LLC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
