-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 12:30 PM
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
-- Database: `afr`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_registration` (IN `id` INT, IN `plan_name` VARCHAR(255), IN `created_as` DATE, IN `expiry` DATE, IN `amount` INT, IN `fname` VARCHAR(255), IN `lname` VARCHAR(255), IN `email` VARCHAR(255), IN `status` INT)   BEGIN
  IF status = 0 THEN
    SELECT
      CASE 
        WHEN plan_name = 'Basic' THEN 10000 
        WHEN plan_name = 'Gold' THEN 23000 
        WHEN plan_name = 'Platinum' THEN 35000 
      END INTO amount
    FROM plans
    WHERE plans.plan_name = plan_name;

    INSERT INTO invoices (id, plan_name, start_date, end_date, amount, fname, lname, email, paid)
    VALUES (id, plan_name, created_as, expiry, amount, fname, lname, email, status);
  END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `check_in_time` time DEFAULT NULL,
  `check_out_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `id`, `date`, `check_in_time`, `check_out_time`) VALUES
(4, 1, '2022-05-01', '09:00:00', '17:00:00'),
(22, 49, '2022-05-01', '09:00:00', '17:00:00'),
(23, 50, '2022-05-01', '08:30:00', '16:30:00'),
(24, 51, '2022-05-01', '10:00:00', '18:00:00'),
(25, 52, '2022-05-01', '09:30:00', '17:30:00'),
(26, 53, '2022-05-02', '09:00:00', '17:00:00'),
(27, 54, '2022-05-02', '08:30:00', '16:30:00'),
(28, 55, '2022-05-02', '10:00:00', '18:00:00'),
(29, 56, '2022-05-02', '09:30:00', '17:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `booked_classes`
--

CREATE TABLE `booked_classes` (
  `class_booking_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booked_classes`
--

INSERT INTO `booked_classes` (`class_booking_id`, `fname`, `lname`, `id`, `class_name`, `date`, `time`, `location`) VALUES
(2, 'Joshua', 'Wakomo', 4, 'UFC Gym: Fight Fit', '2023-03-15', '08:00:00', 'Upperhill'),
(4, 'Mark', 'Masai', 9, 'Boxing', '2023-03-21', '08:00:00', 'Westlands'),
(5, 'Joshua', 'Wakomo', 4, 'CorePower Yoga: Yoga Sculpt', '2023-03-28', '12:00:00', 'Kitisuru'),
(6, 'Roseline', 'Njoroge', 8, 'Yoga', '2023-03-21', '10:00:00', 'Lang\'ata'),
(19, 'samuel', 'mwangi', 3, 'Indoor Cycling', '2023-04-01', '10:00:00', 'Kitisuru'),
(20, 'Wakili', 'James', 45, 'Indoor Cycling', '2023-04-17', '02:00:00', 'Kilimani'),
(21, 'Mike', 'Ross', 64, 'Zumba Fitness', '2023-04-20', '12:00:00', 'Lang\'ata'),
(22, 'Mark', 'Maasai', 39, 'CorePower Yoga: Yoga Sculpt', '2023-04-20', '06:00:00', 'Upperhill'),
(23, 'Mark', 'Maasai', 39, 'HIIT', '2023-04-19', '08:00:00', 'Upperhill'),
(24, 'Mark', 'Maasai', 39, 'Zumba Fitness', '2023-04-22', '12:00:00', 'Upperhill'),
(25, 'Joshua', 'Manaseh', 1, 'Boxing', '2023-04-20', '08:00:00', 'Upperhill'),
(26, 'Roselyne', 'Njoroge', 7, 'Yoga', '2023-04-27', '10:00:00', 'Kitisuru');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `instructor_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `description`, `instructor_name`) VALUES
(1, 'Yoga', 'Stretch your body and mind with this ancient practice that combines physical poses, breathing techniques and meditation.', 'Macy Karie'),
(2, 'HIIT', 'Boost your metabolism and burn fat with this class that alternates between short bursts of intense exercise followed by brief periods of rest or low-intensity exercise .', 'Macy Wangari'),
(3, 'Pilates', 'Strengthen your core and improve your posture with this low-impact exercise that focuses on alignment, balance and flexibility.', 'Amber Kirui');

-- --------------------------------------------------------

--
-- Table structure for table `classes_schedule`
--

CREATE TABLE `classes_schedule` (
  `id` int(11) NOT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  `instructor_name` varchar(50) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `day_of_week` varchar(10) DEFAULT NULL,
  `room_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes_schedule`
--

INSERT INTO `classes_schedule` (`id`, `class_name`, `instructor_name`, `start_time`, `end_time`, `day_of_week`, `room_number`) VALUES
(1, 'Yoga', 'Macy Karie', '07:00:00', '07:45:00', 'Monday', 0),
(2, 'HIIT', 'Macy Wangari', '13:30:00', '14:15:00', 'Tuesday', 1),
(3, 'Pilates', 'Amber Kirui', '08:00:00', '09:00:00', 'Friday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `equipment_name` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `equipment_name`, `brand`, `model`, `purchase_date`, `purchase_price`, `state`, `available`) VALUES
(1, 'Equipment 1', 'Brand 1', 'Model 1', '2022-04-18', '1000.00', 'Good', 1),
(2, 'Equipment 2', 'Brand 2', 'Model 2', '2022-04-17', '2000.00', 'Fair', 1),
(3, 'Equipment 3', 'Brand 3', 'Model 3', '2022-04-16', '3000.00', 'Excellent', 0),
(4, 'Equipment 4', 'Brand 4', 'Model 4', '2022-04-15', '4000.00', 'Poor', 1),
(5, 'Equipment 5', 'Brand 5', 'Model 5', '2022-04-14', '5000.00', 'Good', 0),
(6, 'Equipment 6', 'Brand 6', 'Model 6', '2022-04-13', '6000.00', 'Fair', 1),
(7, 'Equipment 7', 'Brand 7', 'Model 7', '2022-04-12', '7000.00', 'Excellent', 1),
(8, 'Equipment 8', 'Brand 8', 'Model 8', '2022-04-11', '8000.00', 'Poor', 0),
(9, 'Equipment 9', 'Brand 9', 'Model 9', '2022-04-10', '9000.00', 'Good', 1),
(10, 'Equipment 10', 'Brand 10', 'Model 10', '2022-04-09', '10000.00', 'Fair', 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_maintenance`
--

CREATE TABLE `equipment_maintenance` (
  `id` int(11) NOT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `maintenance_date` date DEFAULT NULL,
  `maintenance_cost` decimal(10,2) DEFAULT NULL,
  `maintenance_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_maintenance`
--

INSERT INTO `equipment_maintenance` (`id`, `equipment_id`, `maintenance_date`, `maintenance_cost`, `maintenance_description`) VALUES
(1, 1, '2023-04-19', '100.00', 'Maintenance for equipment 1'),
(2, 2, '2023-04-18', '200.00', 'Maintenance for equipment 2'),
(3, 3, '2023-04-17', '300.00', 'Maintenance for equipment 3'),
(4, 4, '2023-04-16', '400.00', 'Maintenance for equipment 4'),
(5, 5, '2023-04-15', '500.00', 'Maintenance for equipment 5'),
(6, 6, '2023-04-14', '600.00', 'Maintenance for equipment 6'),
(7, 7, '2023-04-13', '700.00', 'Maintenance for equipment 7'),
(8, 8, '2023-04-12', '800.00', 'Maintenance for equipment 8'),
(9, 9, '2023-04-11', '900.00', 'Maintenance for equipment 9'),
(10, 10, '2023-04-10', '1000.00', 'Maintenance for equipment 10');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `class` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `first_name`, `last_name`, `phone_number`, `email`, `class`) VALUES
(1, 'John', 'Doe', '734567891', 'john.doe@email.com', 'Bodybuilding'),
(2, 'Jane', 'Smith', '787654321', 'jane.smith@email.com', 'Zumba Fitness'),
(3, 'Bob', 'Johnson', '5555555555', 'bob.johnson@email.com', 'HIIT'),
(4, 'Alice', 'Williams', '1111111111', 'alice.williams@email.com', 'Yoga'),
(6, 'Emma', 'Davis', '3333333333', 'emma.davis@email.com', 'HIIT'),
(7, 'Michael', 'Miller', '4444444444', 'michael.miller@email.com', 'Pilates'),
(8, 'Sophia', 'Wilson', '6666666666', 'sophia.wilson@email.com', 'Indoor Cycling'),
(9, 'Spencer', 'Ochieng', '735272810', 'spencerochieng@gmail.com', 'Indoor Cycling');

-- --------------------------------------------------------

--
-- Stand-in structure for view `invoices`
-- (See below for the actual view)
--
CREATE TABLE `invoices` (
`fname` varchar(50)
,`lname` varchar(50)
,`id` int(11)
,`email` varchar(50)
,`plan_name` varchar(255)
,`start_date` datetime
,`end_date` datetime
,`paid` tinyint(1)
,`amount` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_table`
--

CREATE TABLE `invoices_table` (
  `invoice_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `paid` tinyint(1) NOT NULL,
  `amount` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices_table`
--

INSERT INTO `invoices_table` (`invoice_id`, `fname`, `lname`, `id`, `email`, `plan_name`, `start_date`, `end_date`, `paid`, `amount`) VALUES
(1, 'Joshua', 'Manaseh', 1, 'joshmanaseh@gmail.com', 'Platinum', '2023-04-16 10:02:53', '2023-04-27 09:08:00', 1, 35000),
(2, 'samuel', 'mwangi', 3, 'skmwas2222@gmail.com', 'Gold', '2023-03-16 10:02:53', '2023-04-27 10:09:12', 0, 23000),
(3, 'chrispus', 'njumwa', 4, 'chrisnjumwa@gmail.com', 'Platinum', '2023-04-01 10:02:53', '2023-04-27 10:09:28', 1, 35000),
(4, 'Roselyne', 'Njoroge', 7, 'rnjoroge@gmail.com', 'Platinum', '2023-03-26 10:02:53', '2023-04-27 10:09:43', 1, 35000),
(5, 'samuel', 'Gathara', 32, 'samgathara@gmail.com', 'Gold', '2023-03-30 10:02:53', '2023-04-27 10:09:59', 0, 23000),
(6, 'Calton', 'Mulwa', 34, 'caltonmulwa@gmail.com', 'Gold', '2023-03-31 10:02:53', '2023-04-27 10:10:11', 1, 23000),
(7, 'lucky', 'wamae', 35, 'luckywamae@outlook.com', 'Basic', '2023-04-02 10:02:53', '2023-04-27 10:10:26', 1, 10000),
(8, 'sam', 'Munyua', 36, 'sammunyua@gmail.com', 'Basic', '2023-04-10 10:02:53', '2023-04-27 10:10:57', 0, 10000),
(9, 'Malcolm', 'Wainaina', 37, 'malcolmx2@gmail.com', 'Gold', '2023-03-13 10:02:53', '2023-04-27 10:11:14', 0, 23000),
(10, 'Victor', 'Wainaina', 38, 'victorthegreat@gmail.com', 'Platinum', '2023-04-03 10:02:53', '2023-04-27 10:11:38', 1, 35000),
(11, 'Mark', 'Maasai', 39, 'markmasai@gmail.com', 'Platinum', '2023-03-15 10:02:53', '2023-04-27 10:03:37', 0, 35000),
(12, 'Angela', 'Bassett', 40, 'angelabassett@gmail.com', 'Platinum', '2023-04-16 10:02:53', '2023-04-27 07:46:04', 1, 35000),
(13, 'Alvin', 'Mwakesi', 41, 'alvinmwakesi@gmail.com', 'Gold', '2023-04-16 10:02:53', '2023-04-27 07:54:47', 1, 23000),
(14, 'Cate', 'Hilt', 42, 'catehilt@gmail.com', 'Basic', '2023-04-16 10:02:53', '2023-04-27 08:19:22', 1, 10000),
(15, 'Dominic', 'Wesonga', 43, 'dominicweso@gmail.com', 'Gold', '2023-04-16 10:02:53', '2023-04-27 09:10:14', 1, 23000),
(16, 'Christine', 'Githinji', 44, 'tinagithinji7@gmail.com', 'Gold', '2023-04-16 10:02:53', '2023-04-28 05:38:17', 0, 23000),
(17, 'Wakili', 'James', 45, 'jameswakili@gmail.com', 'Platinum', '2023-04-16 10:02:53', '2023-05-16 17:29:57', 1, 35000),
(18, 'Rodgers', 'Ndichu', 46, 'rodgerslamar@gmail.com', 'Platinum', '2023-04-16 10:02:53', '2023-05-16 17:59:13', 0, 35000),
(19, 'amber', 'riley', 47, 'amberriley@gmail.com', 'Gold', '2023-04-16 10:02:53', '2023-05-17 07:47:34', 1, 23000),
(20, 'Musa', 'Selelo', 48, 'selelomusa@gmail.com', 'Basic', '2023-04-16 10:02:53', '2023-05-17 07:50:26', 1, 10000),
(21, 'John', 'Doe', 49, 'john.doe@example.com', 'Basic', '2023-04-16 10:02:53', '2023-05-17 08:53:05', 1, 10000),
(23, 'Mike', 'Johnson', 51, 'mike.johnson@example.com', 'Basic', '2023-04-16 10:02:53', '2023-05-17 08:53:05', 1, 10000),
(27, 'Alex', 'Nguyen', 55, 'alex.nguyen@example.com', 'Basic', '2023-04-16 10:02:53', '2023-05-17 08:53:05', 1, 10000),
(29, 'Mike', 'Ross', 64, 'mikeross@gmail.com', 'Basic', '2023-04-16 10:57:54', NULL, 1, 10000),
(30, 'Debby', 'Gathoni', 66, 'debbyg@gmail.com', 'Platinum', '2023-04-16 11:10:15', '2023-05-17 11:10:15', 1, 35000),
(31, 'Vera', 'Moko', 67, 'veramoko@gmail.com', 'Basic', '2023-04-16 11:43:18', '2023-05-17 11:43:18', 0, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `member_name` text NOT NULL,
  `id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `mode` enum('cash','mpesa','cheque') NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `invoice_id`, `member_name`, `id`, `amount_paid`, `mode`, `payment_date`) VALUES
(14, 1, 'Samuel Mwangi', 0, '23000.00', 'cash', '2023-04-17 00:56:02'),
(15, 120, 'Jackson Maina', 0, '45000.00', 'cash', '2023-04-17 00:56:36');

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `update_status` AFTER INSERT ON `payments` FOR EACH ROW BEGIN
    IF EXISTS (SELECT * FROM registration WHERE id = NEW.id AND status = 0) THEN
        UPDATE registration SET status = 1 WHERE id = NEW.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `plan_name`, `amount`) VALUES
(1, 'Basic', '10000.00'),
(2, 'Gold', '23000.00'),
(3, 'Platinum', '35000.00');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('m','f','o') NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_as` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_type` varchar(50) NOT NULL DEFAULT 'Member',
  `expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fname`, `lname`, `email`, `gender`, `password`, `phone`, `plan_name`, `status`, `created_as`, `account_type`, `expiry`) VALUES
(1, 'Joshua', 'Manaseh', 'joshmanaseh@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$bk9PdTZHaUN0TTB2SlZuSA$OTiMrDBQtF8Jb/YQ0qmqaMeKg3pwQMDVDeAvn2twax8', 721334565, 'Platinum', 1, '2023-04-24 11:29:29', 'Admin', '2023-05-24 10:32:42'),
(3, 'samuel', 'mwangi', 'skmwas2222@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$NW5HZExMVUpwQUJGd2FzYQ$1iyHc7arJHxt4Xj54pJO8FqzuVBtYZibdQX7IChjGgs', 727654312, 'Gold', 0, '2023-04-24 11:29:29', 'Member', '2023-05-24 09:40:10'),
(4, 'chrispus', 'njumwa', 'chrisnjumwa@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$bkM5V2tGUnRLOGRScWdXRw$uhCLf1YBOVs5rmnzIuMtue1WY9ZvvzqdH1jJrzi1dAU', 711234567, 'Platinum', 1, '2023-04-24 11:29:29', 'Member', '2023-04-22 11:04:52'),
(7, 'Roselyne', 'Njoroge', 'rnjoroge@gmail.com', 'f', '$argon2id$v=19$m=65536,t=4,p=1$R05LT00uenBZTXNsd2F3Vw$eNIZWZEXGJSUDpPXOp4dgtDE3s2ey90dhUd9l7Ey8Sc', 757143244, 'Platinum', 1, '2023-04-24 11:29:29', 'Member', '2023-04-29 04:09:59'),
(32, 'samuel', 'Gathara', 'samgathara@gmail.com', 'm', '$2y$10$zeEMndfw3nQDA6cgDahf6.0Ky/6GR1Igy1Rm0QhewYNoHd8sz1v8C', 789654321, 'Gold', 0, '2023-04-24 11:29:29', 'Member', '2023-04-30 04:09:59'),
(34, 'Calton', 'Mulwa', 'caltonmulwa@gmail.com', 'm', '$argon2id$v=19$m=65536,t=4,p=1$U01lYlB6ck91MWV4V0czUA$PUMSi7ZO1ghJY6fSOZevQm+6RMrt3Cb9gT4Ghy8V+3E', 757126259, 'Gold', 1, '2023-04-24 11:29:29', 'Member', '2023-04-07 04:09:59'),
(35, 'lucky', 'wamae', 'luckywamae@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$dFdIZE1LVFlmNFl0MkJESg$EiaR4WicIscnDNhA41ZNWU7ClURJkXRnz/nFnw+fYw0', 734562715, 'Basic', 1, '2023-04-24 11:29:29', 'Admin', '2023-05-24 07:14:17'),
(36, 'sam', 'Munyua', 'sammunyua@gmail.com', 'm', '$argon2id$v=19$m=65536,t=4,p=1$SDJIdkFnVWx2NUZyWWk3aQ$8O5UMj4D0WlnxftDnz/mRfFiP1XnXQh3OIuLC/QHdR0', 789356142, 'Basic', 0, '2023-04-24 11:29:29', 'Member', '2023-05-01 04:09:59'),
(37, 'Malcolm', 'Wainaina', 'malcolmx2@gmail.com', 'm', '$2y$10$o5A0FIh9tF2d/TOvXMyw3Onu3EKDsIY2Py9mMEhCscLJCgh93FRrG', 754238190, 'Gold', 0, '2023-04-24 11:29:29', 'Member', '2023-05-02 04:09:59'),
(38, 'Victor', 'Wainaina', 'victorthegreat@gmail.com', 'm', '$argon2id$v=19$m=65536,t=4,p=1$UHdYa1FTZGRWQXoxUWp1bA$zKqk+8H8Aa/k5yEUF5qsvr0+OX5EAD/f+ObkxNcMls0', 763591236, 'Platinum', 1, '2023-04-24 11:29:29', 'Member', '2023-05-03 04:09:59'),
(39, 'Mark', 'Maasai', 'markmasai@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$aGdkaHh5T1ZzTlZYbEpBYg$hx3l1zUynklz9xfmWVq0CYFPmBpXw6lEW2w4PtlGtAc', 735196386, 'Basic', 1, '2023-04-24 11:29:29', 'Member', '2023-05-23 10:41:02'),
(40, 'Angela', 'Bassett', 'angelabassett@gmail.com', 'f', '$argon2i$v=19$m=65536,t=4,p=1$dURVd01sSzBHZi5LbzVodQ$goitRXWAn8J/9pqUMqhz97WfPIbe3/QPHZoh+hYyxO4', 735173936, 'Platinum', 1, '2023-04-24 11:29:29', 'Receptionist', '2023-05-05 04:09:59'),
(41, 'Alvin', 'Mwakesi', 'alvinmwakesi@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$anRxMFpQYy8vRjNaOTNQbw$tD/EwFDcZCYn9xMCq44ov5EwIm2gZTPYKLlwNHxK4DE', 789251742, 'Gold', 1, '2023-04-24 11:29:29', 'Admin', '2023-04-21 04:09:59'),
(42, 'Cate', 'Hilt', 'catehilt@gmail.com', 'o', '$argon2i$v=19$m=65536,t=4,p=1$UzU1MkNYVTFtdXBZUkRUbw$AUmO+XzXmRdB5EM/3wNVeqNOPmNwudILw9Fb8DDypd4', 735186308, 'Basic', 1, '2023-04-24 11:29:29', 'Receptionist', '2023-04-25 04:09:59'),
(44, 'Christine', 'Githinji', 'tinagithinji7@gmail.com', 'f', '$argon2i$v=19$m=65536,t=4,p=1$UGJFSTczMEJLclI1eG4zbg$EMyeP4ZbimwgBPnOjk+jPJEf6w8nIEebiRb5hUfaVBY', 789153728, 'Gold', 0, '2023-04-24 11:29:29', 'Member', '2023-04-18 04:09:59'),
(45, 'Wakili', 'James', 'jameswakili@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$QkJILnVnNzF6YWswVzRwTQ$0KX4wjs/mCx73c6m4gDrBL9dt+gGjclbs84oRaRT70A', 734193729, 'Platinum', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(46, 'Rodgers', 'Ndichu', 'rodgerslamar@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$Wjk3eHpnM09LdmFBTjQyMA$jo5GSs25a13k8IziG4aQ+VmYWInDD3Fwv2EdnEfbDp0', 736286430, 'Platinum', 0, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(48, 'Musa', 'Selelo', 'selelomusa@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$aHJDZzRjNUhWYUVsYVpCMA$NCTDdL48gWEmNIV43+FXLoLuT9KDbe4qXHGYLzBGqVs', 749725930, 'Basic', 1, '2023-04-24 11:29:29', 'Admin', '2023-05-19 04:09:59'),
(49, 'John', 'Doe', 'john.doe@example.com', 'm', 'password123', 555, 'Basic', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(50, 'Jane', 'Smith', 'jane.smith@example.com', 'f', 'password456', 555, 'Premium', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(51, 'Mike', 'Johnson', 'mike.johnson@example.com', 'm', 'password789', 555, 'Basic', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(52, 'Sara', 'Gonzalez', 'sara.gonzalez@example.com', 'f', 'password123', 555, 'Premium', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(53, 'David', 'Lee', 'david.lee@example.com', 'm', 'password456', 555, 'Basic', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(54, 'Emily', 'Wang', 'emily.wang@example.com', 'f', 'password789', 555, 'Premium', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(55, 'Alex', 'Nguyen', 'alex.nguyen@example.com', 'm', 'password123', 555, 'Basic', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(56, 'Jessica', 'Kim', 'jessica.kim@example.com', 'f', 'password456', 555, 'Premium', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(64, 'Mike', 'Ross', 'mikeross@gmail.com', 'o', '$argon2i$v=19$m=65536,t=4,p=1$N0ZlQnNPaHFmRy83L1I5eQ$lxlkbg7QaMxn5/45zpuwK2Z4UNyIfNDIHVC6S3EdlwQ', 738361048, 'Basic', 1, '2023-04-24 11:29:29', 'Admin', '2023-05-19 04:09:59'),
(66, 'Debby', 'Gathoni', 'debbyg@gmail.com', 'f', '$argon2i$v=19$m=65536,t=4,p=1$V09kc3JHYXg4SnV2T3VRcw$je5DwCHizstMhtySzpJdCPEI9dUQV7sN0+hRd4MLIZQ', 791634083, 'Platinum', 1, '2023-04-24 11:29:29', 'Admin', '2023-05-16 11:10:15'),
(67, 'Vera', 'Moko', 'veramoko@gmail.com', 'o', '$argon2i$v=19$m=65536,t=4,p=1$SERCVDhxSUgvaGdzV3o5Rw$pvpTlpnD4iuLViOgWlDpzmWUa2gL3kTLPLmIiy5yjLo', 736295518, 'Basic', 0, '2023-04-24 11:29:29', 'Member', '2023-05-16 11:43:18'),
(76, 'Ricky', 'Dawn', 'rickyd123@gmail.com', 'o', '$argon2i$v=19$m=65536,t=4,p=1$ZjZKdjljcldJUzdQVWVwSA$UQhjHXVGbJoGwSrZl6p3fmTqS4rbtpAKWASYoiUgTUM', 725140936, 'Platinum', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 04:09:59'),
(84, 'Alvin', 'Mwakesi', 'alvinmwakesi2@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$b01pZGVGUWk0RXFHVWZ2MA$8cvghB9ctPWYLfGXSOQrUcZ4lkUpo+rFjLre0pENQQs', 789251742, 'Basic', 1, '2023-04-24 11:29:29', 'Member', '2023-05-19 11:11:32'),
(93, 'Miriam', 'Wangari', 'miriamwangari@gmail.com', 'f', '$argon2i$v=19$m=65536,t=4,p=1$ZXdTZzBoanplaHMzc1NKcg$p+F5nWMKXGkiilkij6tlKi0Ng4VgP4LhA+MyRf99M+s', 735281093, 'Gold', 0, '2023-04-24 11:29:29', 'Member', '2023-05-24 06:06:01'),
(95, 'Leroy', 'Odhiambo', 'leroyodhis@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$RHB2dG5LL2tuVG1tdUJ3bg$ojlc31aQy2NwsnSm9iw8wZKexCEVjzF8OUNdJkuYRF8', 789850194, 'Platinum', 0, '2023-04-24 11:29:29', 'Member', '2023-05-24 07:38:52'),
(96, 'Kamau', 'Njoroge', 'kamaunj@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$ZFZPSFB3MkZJdlBkYUxtRQ$m1+ZVyfK6xBqT2zfKxDpdn8ZAW908HnNcLGNCjJTDYU', 739261730, 'Gold', 1, '2023-04-24 11:29:29', 'Member', '2023-05-24 09:41:27'),
(97, 'Joshua', 'Wakomo', 'joshmanaseh124@gmail.com', 'm', '$argon2i$v=19$m=65536,t=4,p=1$VWxEQm1jaHcvVXJvLmZmeA$BRkryqquFYi+ufSBGiOggyk9mG/Le4MKRk4Ob6oKtzg', 2147483647, 'Gold', 0, '2023-04-24 11:29:29', 'Member', '2023-05-24 11:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `spa_schedule`
--

CREATE TABLE `spa_schedule` (
  `id` int(11) NOT NULL,
  `session_name` text NOT NULL,
  `therapist_name` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day_of_week` text NOT NULL,
  `room_number` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spa_schedule`
--

INSERT INTO `spa_schedule` (`id`, `session_name`, `therapist_name`, `start_time`, `end_time`, `day_of_week`, `room_number`) VALUES
(2, 'Massage Therapy', 'Janet Ambiyo', '10:30:00', '11:15:00', 'Tuesday', '1B');

-- --------------------------------------------------------

--
-- Table structure for table `spa_session_bookings`
--

CREATE TABLE `spa_session_bookings` (
  `booking_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `session_date` date NOT NULL,
  `session_time` time NOT NULL,
  `therapist_name` varchar(50) NOT NULL,
  `session_type` varchar(50) NOT NULL,
  `session_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spa_session_bookings`
--

INSERT INTO `spa_session_bookings` (`booking_id`, `fname`, `lname`, `id`, `session_date`, `session_time`, `therapist_name`, `session_type`, `session_duration`) VALUES
(1, 'Joshua', 'Wakomo', 1, '2023-03-22', '11:00:00', 'Janet Ambiyo', 'Massage Therapy', 1),
(3, 'Mark', 'Masai', 9, '2023-03-27', '14:00:00', 'Edith Kimani', 'Massage Therapy', 1),
(6, 'Roseline', 'Njoroge', 8, '2023-03-29', '07:00:00', 'Aubrey Plaza', 'Massage Therapy', 1),
(7, 'Christine', 'Githinji', 44, '2023-03-29', '12:00:00', 'Jace White', 'Sub-zero Recovery', 1),
(8, 'Christine', 'Githinji', 44, '2023-03-07', '08:00:00', 'Dotty Atieno', 'Massage Therapy', 1),
(9, 'Joshua', 'Manaseh', 1, '2023-03-30', '06:00:00', 'Janet Ambiyo', 'Massage Therapy', 1),
(10, 'Roselyne', 'Njoroge', 7, '2023-03-31', '10:00:00', 'Aubrey Plaza', 'Physical Therapy', 1),
(11, 'Wakili', 'James', 45, '2023-04-16', '08:00:00', 'Aubrey Plaza', 'Physical Therapy', 1),
(12, 'chrispus', 'njumwa', 4, '2023-04-20', '06:00:00', 'Janet Ambiyo', 'Physical Therapy', 1),
(13, 'Mark', 'Maasai', 39, '2023-04-21', '10:00:00', 'Aubrey Plaza', 'Massage Therapy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_data` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `invoices`
--
DROP TABLE IF EXISTS `invoices`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `invoices`  AS SELECT `registration`.`fname` AS `fname`, `registration`.`lname` AS `lname`, `registration`.`id` AS `id`, `registration`.`email` AS `email`, `registration`.`plan_name` AS `plan_name`, `registration`.`created_as` AS `start_date`, `registration`.`expiry` AS `end_date`, `registration`.`status` AS `paid`, CASE WHEN `registration`.`plan_name` = 'Basic' THEN 10000 WHEN `registration`.`plan_name` = 'Gold' THEN 23000 WHEN `registration`.`plan_name` = 'Platinum' THEN 35000 ELSE NULL END AS `amount` FROM `registration``registration`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `attendance_ibfk_2` (`id`);

--
-- Indexes for table `booked_classes`
--
ALTER TABLE `booked_classes`
  ADD PRIMARY KEY (`class_booking_id`),
  ADD KEY `booked_classes_ibfk_2` (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `classes_schedule`
--
ALTER TABLE `classes_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_maintenance`
--
ALTER TABLE `equipment_maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_maintenance_ibfk_1` (`equipment_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `invoices_table`
--
ALTER TABLE `invoices_table`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spa_schedule`
--
ALTER TABLE `spa_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spa_session_bookings`
--
ALTER TABLE `spa_session_bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `booked_classes`
--
ALTER TABLE `booked_classes`
  MODIFY `class_booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes_schedule`
--
ALTER TABLE `classes_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `equipment_maintenance`
--
ALTER TABLE `equipment_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoices_table`
--
ALTER TABLE `invoices_table`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `spa_schedule`
--
ALTER TABLE `spa_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spa_session_bookings`
--
ALTER TABLE `spa_session_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);

--
-- Constraints for table `booked_classes`
--
ALTER TABLE `booked_classes`
  ADD CONSTRAINT `booked_classes_ibfk_2` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);

--
-- Constraints for table `equipment_maintenance`
--
ALTER TABLE `equipment_maintenance`
  ADD CONSTRAINT `equipment_maintenance_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
