-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 03:17 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `work_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `m_id`, `project_id`, `first_name`, `last_name`, `email`, `time`) VALUES
(5, 1, 18, 'Love', 'Deep', 'lovedeep@gmail.com', '2019-04-12 12:13:28'),
(6, 1, 19, 'Ashu', 'Singh', 'ashu@gmail.com', '2019-04-12 12:14:54'),
(7, 3, 20, 'Francis', 'Lepcha', '', '2019-04-12 17:02:33'),
(8, 1, 21, 'Ashu', 'Singh', 'ashu@gmail.com', '2019-04-15 12:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `e_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`e_id`, `user_id`, `active`) VALUES
(1, 5, 1),
(2, 9, 1),
(3, 12, 1),
(4, 13, 0),
(5, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_project`
--

CREATE TABLE `tbl_employee_project` (
  `ep_id` int(111) NOT NULL,
  `e_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee_project`
--

INSERT INTO `tbl_employee_project` (`ep_id`, `e_id`, `project_id`) VALUES
(14, 2, 18),
(21, 2, 21),
(24, 3, 18),
(26, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manager`
--

CREATE TABLE `tbl_manager` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_manager`
--

INSERT INTO `tbl_manager` (`m_id`, `user_id`) VALUES
(1, 8),
(2, 10),
(3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `project_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_price` int(20) DEFAULT NULL,
  `project_deadline` date DEFAULT NULL,
  `project_create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`project_id`, `m_id`, `client_id`, `project_name`, `project_price`, `project_deadline`, `project_create_time`) VALUES
(18, 1, 5, 'Work Management Tool', 5000, '2019-04-15', '2019-04-12 12:13:28'),
(19, 1, 6, 'MamaDiario', 10000, '2019-04-15', '2019-04-12 14:44:11'),
(20, 3, 7, 'VoiceOfAsia', 15000, '2019-04-19', '2019-04-12 17:04:17'),
(21, 1, 6, 'Something', 5000, '2019-04-27', '2019-04-15 12:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `e_id` int(11) DEFAULT NULL,
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `task_decription` text NOT NULL,
  `task_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`task_id`, `project_id`, `e_id`, `m_id`, `user_id`, `task_title`, `task_decription`, `task_time`) VALUES
(12, 18, NULL, 1, 8, 'Make \'My Profile\'  Page', ' adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ', '2019-04-14 15:04:51'),
(14, 18, NULL, 1, 8, 'Edit Profile Page', '1. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.\r\n2. architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.', '2019-04-14 15:23:46'),
(15, 18, NULL, 1, 8, 'Add Dashboard ', '1. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et. \\n\r\n2. architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.', '2019-04-14 15:24:55'),
(16, 18, NULL, 1, 8, 'Something ', 'r sit voluptatem accusantium doloremque laudanti', '2019-04-14 15:37:00'),
(17, 19, NULL, 1, 8, 'First Task', 'letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors n', '2019-04-14 22:55:38'),
(18, 18, NULL, 1, 8, 'Something 2 ', 'asdsjdkfbksdjbfkjfn ksdjfgn sdf', '2019-04-14 23:44:21'),
(19, 21, NULL, 1, 8, 'Something1', 'Someth else', '2019-04-15 17:39:20'),
(20, 18, NULL, 1, 8, 'Something 3 ', 'Something else', '2019-04-15 18:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_assign`
--

CREATE TABLE `tbl_task_assign` (
  `ta_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_comment`
--

CREATE TABLE `tbl_task_comment` (
  `tc_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL,
  `e_id` int(11) DEFAULT NULL,
  `task_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_task_comment`
--

INSERT INTO `tbl_task_comment` (`tc_id`, `task_id`, `project_id`, `m_id`, `e_id`, `task_comment`) VALUES
(10, 12, 18, 1, NULL, 'Complete it today'),
(11, 14, 18, 1, NULL, 'Create it with style'),
(12, 17, 19, 1, NULL, 'Something'),
(13, 18, 18, 1, NULL, 'asdasd'),
(14, 19, 21, 1, NULL, 'New '),
(15, 20, 18, 1, NULL, 'New 2 ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_status`
--

CREATE TABLE `tbl_task_status` (
  `ts_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `new` tinyint(4) NOT NULL DEFAULT '1',
  `hold` tinyint(4) NOT NULL DEFAULT '0',
  `completed` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_task_status`
--

INSERT INTO `tbl_task_status` (`ts_id`, `task_id`, `project_id`, `new`, `hold`, `completed`) VALUES
(3, 12, 18, 0, 0, 1),
(5, 14, 18, 0, 0, 1),
(6, 15, 18, 0, 0, 1),
(7, 16, 18, 0, 1, 0),
(8, 17, 19, 1, 0, 0),
(9, 18, 18, 1, 0, 0),
(10, 19, 21, 1, 0, 0),
(11, 20, 18, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_type` tinyint(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(30) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_type`, `first_name`, `last_name`, `email`, `password`, `time`) VALUES
(1, 0, 'Sujit', 'Singh', 'sujit@gmail.com', '00000', '2019-04-15 13:07:29'),
(5, 1, 'Parth', 'Ladda', 'parth@gmail.com', '00000', '2019-04-15 11:51:57'),
(8, 2, 'Ajit', 'Singh', 'ajit@gmail.com', '00000', '2019-04-11 19:33:56'),
(9, 1, 'Jay', 'Singh', 'jay@gmail.com', '00000', '2019-04-11 21:03:25'),
(10, 2, 'Ankit', 'Shree', 'ankit@gmail.com', '00000', '2019-04-11 21:04:37'),
(11, 2, 'Akash', 'Singh', 'akash@gmail.com', '00000', '2019-04-12 16:45:11'),
(12, 1, 'Pooja', 'Somani', 'pooja@gmail.com', '00000', '2019-04-13 11:19:51'),
(13, 1, 'Shubham', 'Shirpurkar', 'shubham@gmail.com', '00000', '2019-04-14 19:38:22'),
(14, 1, 'Ankita', 'Singh', 'ankita@gmail.com', '00000', '2019-04-14 19:40:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tbl_employee_project`
--
ALTER TABLE `tbl_employee_project`
  ADD PRIMARY KEY (`ep_id`);

--
-- Indexes for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_task_assign`
--
ALTER TABLE `tbl_task_assign`
  ADD PRIMARY KEY (`ta_id`);

--
-- Indexes for table `tbl_task_comment`
--
ALTER TABLE `tbl_task_comment`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `tbl_task_status`
--
ALTER TABLE `tbl_task_status`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_employee_project`
--
ALTER TABLE `tbl_employee_project`
  MODIFY `ep_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_task_assign`
--
ALTER TABLE `tbl_task_assign`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_task_comment`
--
ALTER TABLE `tbl_task_comment`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_task_status`
--
ALTER TABLE `tbl_task_status`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
