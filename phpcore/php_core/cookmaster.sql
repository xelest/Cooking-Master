-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 11:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cookmaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `username`, `password`, `fname`, `lname`, `status`) VALUES
(1, 'testuser', 'testuser', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients_steps`
--

CREATE TABLE `ingredients_steps` (
  `steps_id` int(11) NOT NULL,
  `ingredient` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `measurement` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients_steps`
--

INSERT INTO `ingredients_steps` (`steps_id`, `ingredient`, `amount`, `measurement`) VALUES
(1, 'dadsd', 2, 'pinch'),
(1, 'adsad', 3, 'pinch'),
(4, 'Salt', 2, 'pinch'),
(0, 'Salt', 2, 'pinch'),
(5, 'Sili', 5, 'pinch'),
(5, 'Salt', 5, 'pinch'),
(6, 'Soy Sauce', 30, 'ml'),
(6, 'Salt', 1, 'Tbsp'),
(7, 'Toyo', 50, 'ml'),
(7, 'Salt', 3, 'pinch'),
(7, 'Vinegar', 2, 'Tbsp'),
(13, 'asdasd', 2, 'pinch'),
(12, '1', 1, 'pinch'),
(9, 'Salt', 2, 'Tbsp'),
(9, 'Chili Sauce', 1, 'cup'),
(9, 'Flour', 1, 'cup'),
(9, 'Cooking Oil', 2, 'cup'),
(9, 'Egg', 100, 'g'),
(11, '2', 2, 'pinch'),
(11, '1', 1, 'pinch'),
(13, 'sadas', 3, 'pinch');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_stocks`
--

CREATE TABLE `ingredient_stocks` (
  `stock_id` int(11) NOT NULL,
  `stock_name` varchar(30) NOT NULL,
  `amount` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `measurement` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredient_stocks`
--

INSERT INTO `ingredient_stocks` (`stock_id`, `stock_name`, `amount`, `user_id`, `measurement`) VALUES
(3, 'Chicken Full', 8, 1, 'kg'),
(4, 'Fish', 1.1, 1, 'kg'),
(5, 'Corn', 0.1, 1, 'kg'),
(6, 'Salt', 0.0860494, 1, 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `procedure_steps`
--

CREATE TABLE `procedure_steps` (
  `steps_id` int(11) NOT NULL,
  `step_num` int(3) NOT NULL,
  `instruction` text NOT NULL,
  `caption` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procedure_steps`
--

INSERT INTO `procedure_steps` (`steps_id`, `step_num`, `instruction`, `caption`) VALUES
(1, 1, 'stepIns[0]', 'stepCap[0]'),
(1, 2, 'stepIns[1]', 'stepCap[1]'),
(0, 2, '', ''),
(0, 1, 'asdsad\nasd', 'Cut'),
(4, 1, 'sadas\nsadadsa', 'Cut'),
(4, 2, '', ''),
(5, 1, 'saasd\nasda', 'Cut'),
(5, 2, 'Add flour', 'Add'),
(6, 1, 'Cut into pieces', 'Cut'),
(6, 2, 'Soy Sauce', 'Add '),
(7, 1, 'Marinate Chicken with Toyo', 'Marinate'),
(7, 2, 'Add vinegar', 'Add'),
(7, 3, 'Heat dish with wok', 'Heat'),
(9, 1, 'Put wings in flour', 'Add Flour'),
(9, 2, 'Boil oil for 10 minutes', 'Boil Oil'),
(9, 3, 'Put wings inside pot for 20 minutes', 'Put Wings'),
(9, 4, 'Take out wings and add salt', 'Season'),
(9, 5, 'Put sause and some chili pepper', 'Put sause'),
(13, 1, 'asdasd', 'sadasd'),
(12, 1, '1', '1'),
(11, 1, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(30) NOT NULL,
  `main_ingr` varchar(30) NOT NULL,
  `type_ingr` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `image` varchar(200) NOT NULL,
  `kilogram` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `recipe_name`, `main_ingr`, `type_ingr`, `user_id`, `rating`, `image`, `kilogram`) VALUES
(1, 'Baboy', 'Pork', 'Shoulder', 1, 0, '', 1),
(5, 'Corned Beef', 'Beef', 'Brisket', 1, 0, '', 1),
(6, 'Corned Beef', 'Beef', 'Brisket', 1, 0, '', 1),
(7, 'Tinola', 'Chicken', 'Full', 1, 0, '', 1),
(8, 'Tinola', 'Chicken', 'Full', 1, 0, '', 1),
(9, 'Spicy Chicken', 'Chicken', 'Leg', 1, 0, '', 1),
(10, 'Spicy Chicken', 'Chicken', 'Leg', 1, 0, '', 1),
(11, 'Adobo', 'Chicken', 'Full', 1, 0, '', 1),
(12, 'Chicken Adobo', 'Chicken', 'Full', 1, 0, 'Filipino-Chicken-Adobo.jpg', 1),
(13, 'Chili Chicken Wings', 'Chicken', 'Wings', 1, 0, 'Filipino-Chicken-Adobo.jpg', 1),
(14, 'sample chicken', 'Chicken', 'Full', 1, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_steps`
--

CREATE TABLE `recipe_steps` (
  `steps_id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_steps`
--

INSERT INTO `recipe_steps` (`steps_id`, `rec_id`, `date_created`) VALUES
(1, 1, '2020-09-15'),
(3, 5, '2020-09-15'),
(4, 7, '2020-09-15'),
(5, 9, '2020-09-15'),
(6, 11, '2020-09-15'),
(7, 12, '2020-09-16'),
(9, 13, '2020-10-08'),
(13, 14, '2020-10-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ingredient_stocks`
--
ALTER TABLE `ingredient_stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD PRIMARY KEY (`steps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ingredient_stocks`
--
ALTER TABLE `ingredient_stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  MODIFY `steps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
