-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 05:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wecare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `governorate` varchar(255) DEFAULT NULL,
  `clinic_type` varchar(255) DEFAULT NULL,
  `hospital` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `governorate`, `clinic_type`, `hospital`, `doctor`, `appointment_date`, `appointment_time`) VALUES
(11, 'Muscat', 'Cardiology', 'Badder Alsamma hospital', 'Dr. Ali', '2024-06-06', '12:54:00'),
(12, 'Muscat', 'Cardiology', 'Badder Alsamma hospital', 'Dr. Ali', '2024-06-06', '14:14:00'),
(13, 'Muscat', 'Cardiology', 'Badder Alsamma hospital', 'Dr. Ali', '2024-06-06', '02:17:00'),
(19, 'Muscat', 'Cardiology', 'Badder Alsamma hospital', 'Ali12', '2024-06-06', '12:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_requests`
--

CREATE TABLE `emergency_requests` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `house_number` varchar(50) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `building_type` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_requests`
--

INSERT INTO `emergency_requests` (`id`, `location`, `house_number`, `street_name`, `building_type`, `description`) VALUES
(1, 'Seeb', '12', '4432', 'house', 'Hypertension'),
(2, 'Seeb', '11', '4421', 'house', 'A state of fainting'),
(4, 'Seeb', 'a13', '4432', 'apartment', 'Severe bleeding due to a sharp object'),
(5, 'Seeb', 'a1223', '403211', 'house', 'rrr'),
(6, 'Seeb', '334', '3333', 'house', '5555'),
(7, '', '', '', 'house', ''),
(8, 'Seeb', '22', '34567', 'house', 'sdfghjmn'),
(9, 'Seeb', '99', '456789', 'house', 'asdfghjnb'),
(10, 'Seeb', '234', '1234', 'house', 'xcvbnm');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `reserve_number` varchar(20) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `chronic_diseases` text DEFAULT NULL,
  `current_medications` text DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `previous_surgeries` text DEFAULT NULL,
  `vaccinations` text DEFAULT NULL,
  `family_diseases` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_name`, `phone`, `reserve_number`, `nationality`, `dob`, `age`, `gender`, `blood_type`, `chronic_diseases`, `current_medications`, `allergies`, `previous_surgeries`, `vaccinations`, `family_diseases`) VALUES
(3, 'Hamza Salim ', '2345', '2345', 'Omani', '2024-06-05', 24, 'men', 'o+', '*******', '***********', '*******', '******', '**********', '*******************'),
(6, 'Hamza Salim', '99999999', '99998888', 'Omani', '2003-08-01', 20, 'Men', 'O+', '**********************', '**************************', '********************', '*******************************', '*********************', '*************************'),
(10, 'Hamza Salim', '12345678', '2345678', 'Omani', '2024-06-09', 20, 'men', 'o+', 'asdfghj', 'sdfgh', 'wsderftry', 'w3e4r5t', 'qdwefr', '1w2ew4rty'),
(1234, 'muzna salim', '999999', '234', 'omani', '2024-06-06', 1, 'femail ', 'o+', 'qwer', 'asdf', 'asdf', 'asdfb', 'asdf', 'sdfvb'),
(12234, 'Hamza Salim', '99999999', '99998888', 'Omani', '2024-06-16', 21, 'men', 'O+', '***********', '************', '**********', '**********', '*********', '**********');

-- --------------------------------------------------------

--
-- Table structure for table `products1`
--

CREATE TABLE `products1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products1`
--

INSERT INTO `products1` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(2, 'Night Shift (20 Caplets)', 'Formulated to relieve your worst nighttime sinus and nasal congestion symptoms. 4 maximum strength medicines in one dose help clear nasal passages and congestion, relieve your nagging headache or body pain, and control coughing to help you get to sleep.', 8.21, 'uploads/2.jpg', '2024-05-24 15:08:55'),
(5, 'Acne Foaming Wash, 10% Benzoyl Peroxide Maximum Strength, 5.5 oz (156 g)', 'PanOxyl® Acne Foaming Wash contains maximum strength benzoyl peroxide to clear tough breakouts. PanOxyl kills acne-causing bacteria by cleaning and unclogging pores.', 5.62, 'uploads/5.jpg', '2024-06-05 22:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details`
--

CREATE TABLE `shipping_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_details`
--

INSERT INTO `shipping_details` (`id`, `name`, `phone_number`, `address`, `street_name`, `city`, `state`) VALUES
(1, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'hnjmg', 'hgjmkh,'),
(2, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'hgjmkh,'),
(3, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(4, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(5, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(6, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(7, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(8, '', '', '', '', '', ''),
(9, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(10, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(11, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'wedc'),
(12, ' muzna salim ', '12345667', 'asxs', 'sac dxd', 'swdc', 'wsadc'),
(13, 'mm;', 'csd', 'sac', 'sc', 's', 's'),
(14, 'ZX', 'A', 'a', 'X', 'X', 'X'),
(15, ' muzna salim ', 'a', 'x', 'xd', 'd', 'd'),
(16, '', '', '', '', '', ''),
(17, ' muzna salim ', '12345667', 'fgbhng', 'bhnjmk', 'suuuur', 'X'),
(18, 'hj', '234567', 'xdfgh', 'sdfgh', 'fghjk', 'xc');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userss`
--

INSERT INTO `userss` (`user_id`, `full_name`, `username`, `phone_number`, `email`, `user_password`, `role`, `owner_id`) VALUES
(1, 'muzna salim', 'muz22', '99990000', 'imuzna2001@gmail.com', '1234', 'user', 0),
(6, 'vikas rao', 'vikas', '9699202', 'vikasrn@gmail.com', 'M123456', 'user', 0),
(8, 'Ali12', 'Ali12', '99990000', 'drali12@gmail.com', '12345', 'doctor', 0),
(9, 'Husain', 'Husain123', '99991111', 'drhusain123@gmail.com', '12345', 'doctor', 0),
(10, 'Rashid', 'Rashid1234', '99992222', 'drrashid1234@gmail.com', '12345', 'doctor', 0),
(31, 'Muzna Salim', 'Muz222', '999900009', 'imuzna20001@gmail.com', '123456', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `products1`
--
ALTER TABLE `products1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userss`
--
ALTER TABLE `userss`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products1`
--
ALTER TABLE `products1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping_details`
--
ALTER TABLE `shipping_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userss`
--
ALTER TABLE `userss`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
