-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 12:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timtam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOI_ID` int(11) NOT NULL,
  `Skills_ID` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Job_Reference_Number` varchar(5) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Street_Address` varchar(40) NOT NULL,
  `Suburb/Town` varchar(40) NOT NULL,
  `State` varchar(15) NOT NULL,
  `Postcode` varchar(4) NOT NULL,
  `Email_Address` varchar(50) NOT NULL,
  `Phone_Number` varchar(12) DEFAULT NULL,
  `Other_Skills` varchar(200) DEFAULT NULL,
  `Date_Of_Birth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOI_ID`, `Skills_ID`, `Status`, `Job_Reference_Number`, `First_Name`, `Last_Name`, `Street_Address`, `Suburb/Town`, `State`, `Postcode`, `Email_Address`, `Phone_Number`, `Other_Skills`, `Date_Of_Birth`, `Gender`) VALUES
(4, 3, 'New', '1', 'Steve', 'Smith', '12 Street Rd', 'suburb', '', '2111', 'email@email.com', '044327913', 'text', '2025-05-15', 'male'),
(5, 17, 'New', '2', 'Mason', 'Smith', '11 street st', 'Suburb', '', '2213', 'email2@email.com', '784321586', 'skills here', '2025-05-26', 'male'),
(6, 1, 'New', '1', 'Jimmy', 'Something', '12 something dr', 'suburb', 'stTE', '2211', 'something@email.com', '4682647910', 'more textttttttt', '2025-05-20', 'female'),
(7, 1, 'New', '2', 'nobody', 'else', '4 nothing cr', 'suburb', 'state', '4832', 'emailaddress@mail.com', '4638195662', 'even more textssss', '2025-03-18', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `eoi_skills`
--

CREATE TABLE `eoi_skills` (
  `skills_id` int(11) NOT NULL,
  `j1s1` tinyint(1) DEFAULT 0,
  `j1s2` tinyint(1) DEFAULT 0,
  `j1s3` tinyint(1) DEFAULT 0,
  `j1s4` tinyint(1) DEFAULT 0,
  `j1s5` tinyint(1) DEFAULT 0,
  `j1s6` tinyint(1) DEFAULT 0,
  `j4s1` tinyint(1) DEFAULT 0,
  `j4s2` tinyint(1) DEFAULT 0,
  `j4s3` tinyint(1) DEFAULT 0,
  `j4s4` tinyint(1) DEFAULT 0,
  `j4s5` tinyint(1) DEFAULT 0,
  `j4s6` tinyint(1) DEFAULT 0,
  `j4s7` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `salary_lower` int(11) DEFAULT NULL,
  `salary_upper` int(11) DEFAULT NULL,
  `reports_to` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `title`, `description`, `salary_lower`, `salary_upper`, `reports_to`) VALUES
(1, 'Network Administrator', 'We are seeking a skilled and detail-oriented Network Administrator to join our IT team. \r\nThe ideal candidate will be responsible for maintaining, configuring, and securing our computer networks and related computing environments. \r\nThis includes hardware, systems software, applications software, and all configurations.', 75000, 115000, 'IT Manager'),
(4, 'Software Developer', 'We are looking for a talented and motivated Software Developer to design, build, and maintain efficient, reusable, and reliable code. \r\nYou will collaborate with cross-functional teams to develop innovative software solutions that meet client needs and business goals. \r\nThe ideal candidate is a team player with a passion for problem-solving, clean code, and continuous improvement.', 90000, 130000, 'Lead Software Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibilities`
--

INSERT INTO `responsibilities` (`id`, `job_id`, `description`) VALUES
(1, 1, 'Manage and maintain network infrastructure'),
(2, 1, 'Monitor network performance and troubleshoot issues'),
(3, 1, 'Ensure network security and compliance with policies'),
(4, 1, 'Install and configure network hardware and software'),
(5, 1, 'Provide technical support for network-related issues'),
(6, 4, 'Develop and maintain software applications'),
(7, 4, 'Collaborate with teams'),
(8, 4, 'Write clean and efficient code'),
(9, 4, 'Participate in code reviews'),
(10, 4, 'Debug and troubleshoot software issues');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `essential` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `job_id`, `description`, `essential`) VALUES
(1, 1, 'Bachelor’s degree in Information Technology, Computer Science, or related field', 1),
(2, 1, '3 years of experience in network administration', 1),
(3, 1, 'Proficiency in configuring routers and switches', 1),
(4, 1, 'Strong troubleshooting and problem-solving skills', 1),
(5, 1, 'Certifications such as CCNA', 0),
(6, 1, 'Experience with cloud networking', 0),
(7, 4, 'Bachelor’s degree in Computer Science or related field', 1),
(8, 4, '3+ years of experience in software development', 1),
(9, 4, 'Proficiency in Python, or C++', 1),
(10, 4, 'Strong problem-solving skills', 1),
(11, 4, 'Experience with version control systems such as git.', 1),
(12, 4, 'Experience with cloud technologies', 0),
(13, 4, 'Familiarity with Agile frameworks', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOI_ID`),
  ADD KEY `Skills_ID` (`Skills_ID`);

--
-- Indexes for table `eoi_skills`
--
ALTER TABLE `eoi_skills`
  ADD PRIMARY KEY (`skills_id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `eoi_skills`
--
ALTER TABLE `eoi_skills`
  MODIFY `skills_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
