-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 10:42 AM
-- Server version: 10.4.24-MariaDB-log
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelCountry` (IN `id` INT)   BEGIN DELETE FROM countries WHERE country_id = id; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EditCountry` (IN `id` INT, IN `country_name` VARCHAR(255), IN `status` TINYINT)   BEGIN 
    UPDATE countries SET 
                   country_name= country_name,
                   status     = status
                   WHERE country_id=id;
                   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllCountry` ()   BEGIN
   SELECT * FROM countries WHERE status =1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllStdentRecord` ()   BEGIN
    SELECT name, total,per
    FROM student;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCountryById` (IN `id` INT)   BEGIN SELECT * FROM countries WHERE country_id =id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCountryDetail` (IN `country_id` INT(11), IN `country_name` VARCHAR(50), IN `status` TINYINT(1), OUT `LID` INT(11))   BEGIN
     INSERT INTO countries 
                         (
                             country_id, 
                             country_name, 
                             status
                         ) 
                         VALUES 
                         ( 
                             country_id,
                             country_name, 
                             status 
                         ); 
                         SET LID = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertlast_insert` (IN `crm_id` INT(11))   BEGIN 
     INSERT INTO vtiger_crmentity (
                                   crm_id
                                  )
                               VALUES(
                                  crm_id
                               );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_LAST_INSERT_ID` (OUT `LAST_ID` INT(11))   BEGIN
     UPDATE  vtiger_crmentity_seq 
                         
                         SET id = LAST_INSERT_ID(id+1);
                       
                         SET LAST_ID = LAST_INSERT_ID();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acct_num` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acct_num`, `amount`) VALUES
(137, '14.98'),
(141, '1937.50'),
(97, '-100.00'),
(137, '14.98'),
(141, '1937.50'),
(97, '-100.00');

--
-- Triggers `account`
--
DELIMITER $$
CREATE TRIGGER `ins_sum` BEFORE INSERT ON `account` FOR EACH ROW SET @sum = @sum + NEW.amount
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_subscribers`
--

CREATE TABLE `audit_subscribers` (
  `id` int(11) NOT NULL,
  `subscriber_name` varchar(200) NOT NULL,
  `action_performed` varchar(400) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_subscribers`
--

INSERT INTO `audit_subscribers` (`id`, `subscriber_name`, `action_performed`, `date_added`) VALUES
(1, 'sahib', 'Inserted a new subscriber', '2023-01-26 10:51:53'),
(2, 'saleem', 'Inserted a new subscriber', '2023-01-26 10:52:18'),
(3, 'saleem', 'Updated a subscriber', '2023-01-26 10:53:04'),
(4, 'Test', 'Inserted a new subscriber', '2023-01-26 16:48:18'),
(5, 'sahib', 'Inserted a new subscriber', '2023-01-30 14:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `state_id`, `city_name`, `status`) VALUES
(1, 1, 'Peshawar', 1),
(2, 1, 'Kohat', 1),
(3, 1, 'Abatabad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `status`) VALUES
(1, 'Pakistan', 1),
(2, 'India', 1),
(3, 'Afghnistan Test', 1);

--
-- Triggers `countries`
--
DELIMITER $$
CREATE TRIGGER `country_name` BEFORE INSERT ON `countries` FOR EACH ROW SET @country_name = 'Test',@status=1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mytest`
--

CREATE TABLE `mytest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mytest`
--

INSERT INTO `mytest` (`id`, `name`, `fname`) VALUES
(4, 'test', 'test12'),
(5, 'test', 'test122');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `country_id`, `state_name`, `status`) VALUES
(1, 1, 'KPK', 1),
(2, 1, 'Punjab', 1),
(3, 1, 'Sindh', 1),
(4, 1, 'Balochistan', 1),
(5, 2, 'Andhra Pradesh', 1),
(6, 2, 'Assam Pradesh', 1),
(7, 2, 'Chhattisgarh', 1),
(8, 2, 'Gujarat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `tid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `subj1` int(11) DEFAULT NULL,
  `subj2` int(11) DEFAULT NULL,
  `subj3` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `per` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`tid`, `name`, `subj1`, `subj2`, `subj3`, `total`, `per`) VALUES
(1, 'khan', 50, 34, 43, 200, 70),
(2, 'Salman', 50, 34, 43, 200, 60),
(3, 'Sahib', 50, 34, 43, 200, 50);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `fname`, `email`) VALUES
(3, 'sahib', 'm.sahib@globalinklogistics.com'),
(4, 'saleem khan', 'khan@khan.com'),
(5, 'Test', 'test@test.com'),
(6, 'sahib', 'sahibkust@gmail.com');

--
-- Triggers `subscribers`
--
DELIMITER $$
CREATE TRIGGER `after_subscriber_delete` AFTER DELETE ON `subscribers` FOR EACH ROW BEGIN

    INSERT INTO audit_subscribers

    SET action_performed  = 'Deleted a subscriber',

    subscriber_name       =  OLD.fname;


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_subscriber_edit` AFTER UPDATE ON `subscribers` FOR EACH ROW BEGIN

    INSERT INTO audit_subscribers

    SET action_performed  = 'Updated a subscriber',

    subscriber_name       =  OLD.fname;


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_subscriber_insert` BEFORE INSERT ON `subscribers` FOR EACH ROW BEGIN
    INSERT INTO audit_subscribers
    SET action_performed  = 'Inserted a new subscriber',
    subscriber_name       =  new.fname;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `testtbl1`
--

CREATE TABLE `testtbl1` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES
(1, 'sahib', 'sahib khan', '12345'),
(2, 'sona', 'Sonarika Bhadoria', '123456'),
(3, 'vishal', 'Vishal Sahu', '32145'),
(4, 'sunil', 'Sunil singh', '787945'),
(5, 'saleem', 'saleem khan', '147526'),
(6, 'sadiq', 'sadiq khan', '235412'),
(7, 'jiten', 'jitendra singh', '12378');

-- --------------------------------------------------------

--
-- Table structure for table `vtiger_crmentity`
--

CREATE TABLE `vtiger_crmentity` (
  `crm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vtiger_crmentity_seq`
--

CREATE TABLE `vtiger_crmentity_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vtiger_crmentity_seq`
--

INSERT INTO `vtiger_crmentity_seq` (`id`) VALUES
(3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_subscribers`
--
ALTER TABLE `audit_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `mytest`
--
ALTER TABLE `mytest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testtbl1`
--
ALTER TABLE `testtbl1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vtiger_crmentity`
--
ALTER TABLE `vtiger_crmentity`
  ADD PRIMARY KEY (`crm_id`);

--
-- Indexes for table `vtiger_crmentity_seq`
--
ALTER TABLE `vtiger_crmentity_seq`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_subscribers`
--
ALTER TABLE `audit_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mytest`
--
ALTER TABLE `mytest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testtbl1`
--
ALTER TABLE `testtbl1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
