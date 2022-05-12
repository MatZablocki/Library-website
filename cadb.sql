-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2022 at 10:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` varchar(15) NOT NULL,
  `BookTitle` varchar(40) DEFAULT NULL,
  `Author` varchar(40) DEFAULT NULL,
  `Edition` int(2) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL,
  `Category` int(4) UNSIGNED DEFAULT NULL,
  `Reserved` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `BookTitle`, `Author`, `Edition`, `Year`, `Category`, `Reserved`) VALUES
('093-403992', 'Computers in Business', 'Alicia Oneill', 3, 1997, 3, 'Y'),
('23472-8729', 'Exploring Peru', 'Stephanie Birchi', 4, 2005, 5, 'N'),
('237-34823', 'Business Strategy', 'Joe Peppard', 2, 2002, 2, 'Y'),
('23u8-923849', 'A guide to nutrition', 'John Thorpe', 2, 1997, 1, 'N'),
('2983-3494', 'Cooking for children', 'Anabelle Sharpe', 1, 2003, 7, 'N'),
('82n8-308', 'Computers for idiots', 'Susan ONeill', 5, 1998, 4, 'Y'),
('9823-23984', 'My life in picture', 'Kevin Graham', 8, 2004, 1, 'N'),
('9823-2403-0', 'DaVinci Code', 'Dan Brown', 1, 2003, 8, 'N'),
('9823-98345', 'How to cook Italian food', 'Jamie Oliver', 2, 2005, 7, 'Y'),
('9823-98487', 'Optimising your business', 'Cleo Blair', 1, 2001, 2, 'Y'),
('98234-029384', 'My ranch in Texas', 'George Bush', 1, 2005, 1, 'Y'),
('988745-234', 'Tara Road', 'Maeve Binchy', 4, 2002, 8, 'N'),
('993-004-00', 'My life in bits', 'John Smith', 1, 2001, 1, 'Y'),
('9987-0039882', 'Shooting History', 'Jon Snow', 1, 2003, 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(4) UNSIGNED NOT NULL,
  `CategoryName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Health'),
(2, 'Business'),
(3, 'Biography'),
(4, 'Technology'),
(5, 'Travel'),
(6, 'Self-Help'),
(7, 'Cookery'),
(8, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE `reserved` (
  `ISBN` varchar(15) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `ResDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`ISBN`, `Username`, `ResDate`) VALUES
('093-403992', 'joecrotty', '2021-12-02'),
('237-34823', 'ewa', '2022-01-13'),
('82n8-308', 'Admin', '2021-12-03'),
('9823-98345', 'tommy100', '2008-10-11'),
('9823-98487', 'ewa', '2021-12-02'),
('98234-029384', 'joecrotty', '2008-10-11'),
('993-004-00', 'Admin', '2021-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(15) NOT NULL,
  `Password` varchar(40) DEFAULT NULL,
  `FName` varchar(20) DEFAULT NULL,
  `SName` varchar(20) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Address2` varchar(50) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `PhoneNO` int(7) DEFAULT NULL,
  `MobileNO` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `FName`, `SName`, `Address`, `Address2`, `City`, `PhoneNO`, `MobileNO`) VALUES
('Admin', 'password1', 'Mat', 'Zablo', '1 Heaven Road', 'Space', 'Heaven', 0, 870000001),
('alanjmckenna', 't1234s', 'Alan', 'McKenna', '38 Cranley Road', 'Fairview', 'Dublin', 9998377, 856625567),
('ewa', 'ewaewa', 'ewa', 'zab', '435', 'fsafdsa', 'dsa', 555555555, 555555555),
('joecrotty', 'kj7899', 'Joseph', 'Crotty', 'Apt 5 Clyde Road', 'Donnybrook', 'Dublin', 8887889, 876654456),
('MatZa', '1234', 'Matt', 'Za', '37 Yo town', 'Hello', 'New York', 871231234, 871231234),
('tommy100', '123456', 'Tom', 'Behan', '14 Hyde Road', 'Dalkey', 'Dublin', 9983747, 876738782),
('vneish', 'ninja', 'Lucy', 'Panda', '45 road', 'street', 'Dublin', 857776666, 825558899);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `cat_catid_fk` (`Category`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`ISBN`,`Username`),
  ADD KEY `Username_fk` (`Username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `cat_catid_fk` FOREIGN KEY (`Category`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `reserved`
--
ALTER TABLE `reserved`
  ADD CONSTRAINT `ISBN_fk` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `Username_fk` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
