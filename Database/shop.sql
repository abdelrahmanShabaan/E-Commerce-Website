-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 04:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `visibility` tinyint(4) DEFAULT 0,
  `allow_comment` tinyint(4) NOT NULL DEFAULT 0,
  `allow_ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `name`, `description`, `ordering`, `visibility`, `allow_comment`, `allow_ads`) VALUES
(10, 'family', 'family products', 0, 1, 1, 1),
(17, 'tablet', 'migrations tablets pro', 1, 0, 0, 0),
(18, 'mobiles', 'new mobile category', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(4, 'thanks for development', 1, '2022-12-14', 28, 21);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `add_Date` date NOT NULL,
  `country_made` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `name`, `description`, `price`, `add_Date`, `country_made`, `image`, `status`, `rating`, `Approve`, `Cat_ID`, `Member_ID`) VALUES
(27, 'playstation 4s', 'playstation gaming', '2500', '2022-12-12', 'middle east', '', '2', 3, 0, 9, 21),
(28, 'mobile', 'new mobile devices', '800', '2022-12-12', 'middle east', '', '3', 5, 0, 10, 22),
(29, 'laptob', 'new laptob types', '588', '2022-12-12', 'middle east', '', '2', 2, 0, 10, 24),
(31, 'Proessional item', ' img-responsive  img-responsive  img-responsive', '2500', '2022-12-12', 'egypt', '', '5', 4, 0, 10, 22),
(32, 'cahirs', 'new chairs new chairs new chairs', '589', '2022-12-12', 'middle east', '', '4', 2, 0, 9, 26),
(35, 'samsung tab', 'samsung galaxy tab', '555', '2022-12-13', 'egypt', '', '2', 0, 0, 10, NULL),
(37, 'playstation tab', 'categories playstation', '555', '2022-12-13', 'egypt', '', '2', 0, 0, 10, NULL),
(38, 'choses', 'choses branding product', '500', '2022-12-14', 'egypt', '', '3', 0, 0, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL COMMENT 'To Identify User',
  `username` varchar(255) NOT NULL COMMENT 'Username To Login',
  `password` varchar(255) NOT NULL COMMENT 'Password To Login',
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL DEFAULT 0 COMMENT 'Identify User Group',
  `truststatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Seller Rank',
  `regstatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Pending Approval',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `fullname`, `groupID`, `truststatus`, `regstatus`, `date`) VALUES
(21, 'ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahmed@gmail.com', 'ahmed ahmed', 0, 0, 1, '2022-12-12'),
(22, 'karem ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'karem@gmail.com', 'karem ahmed', 1, 1, 1, '2022-12-12'),
(23, 'mohamed ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mohamed@gmail.com', 'mohamed ali', 0, 0, 1, '2022-12-12'),
(24, 'memo', '123', 'memo@gmail.com', 'memo ahmed', 0, 0, 0, '2022-12-20'),
(25, 'omar', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'omar@gmail.com', 'omar ahmed', 0, 0, 1, '2022-12-12'),
(26, 'sherif', '123', 'sheriz@gmail.com', 'sherif azmy', 0, 0, 0, '2022-12-08'),
(27, 'memos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'memos@gmail.com', 'memos ahmed', 0, 0, 1, '2022-12-13'),
(28, 'mariem', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mariem@yahoo.com', '', 0, 0, 0, '2022-12-13'),
(30, 'koko', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'koko@yahoo.com', '', 0, 0, 0, '2022-12-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To Identify User', AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
