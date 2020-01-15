-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 04:57 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `subtitle` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `links` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `description`, `links`) VALUES
(1, 'Welcome To Ibadan Civic Centre', 'A little about us', 'We are passionate about making events memorable. We are situated in a secure environment with large halls and large parking space. We are passionate about making events memorable. We are situated in a secure environment with large halls and large parking ', 'https://icc.com'),
(2, 'Why We Are The Best', 'Top Reasons Why You Should Use Us', 'Networking Sessions. Get the best to work with you. ', 'vendors.php');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_need` varchar(255) NOT NULL,
  `describe_need` varchar(255) NOT NULL,
  `estimate_price` int(11) NOT NULL,
  `amount_spent` int(11) NOT NULL,
  `proposed_income` int(11) NOT NULL,
  `date_budget_was_made` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `username`, `user_need`, `describe_need`, `estimate_price`, `amount_spent`, `proposed_income`, `date_budget_was_made`) VALUES
(2, 'baba@gmail.com', 'c', '', 0, 11, 34, 'Monday 13 Jan 2020'),
(7, 'tester2@gmail.com', 'Ade', 'nhjm', 65555, 66, 8888, 'Tuesday 14 Jan 2020');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `username`, `email`, `firstname`, `lastname`, `password`, `usertype`) VALUES
(1, 'ife', 'ifeoseni@gmail.com', '', '', 'ife', 'admin'),
(3, 'ade', 'ade@gmail.com', '', '', 'ade@gmail.com', 'Event Vendor'),
(4, 'vendoroseni', 'vendoroseni@gmail.com', '', '', 'vendoroseni@gmail.com', 'Event Vendor'),
(6, 'tester2@gma', 'tester2@gmail.com', '', '', 'tester2@gmail.com', 'Event Owner'),
(8, 'owner@gmail', 'owner@gmail.com', '', '', 'owner@gmail.com', 'Event Owner'),
(9, 'Adewami@gma', 'Adewami@gmail.com', 'Adewami', 'Adewami', 'Adewami@gmail.com', 'Event Owner'),
(10, 'bamidele@gm', 'bamidele@gmail.com', 'bamidele@gmail.com', 'bamidele@gmail.com', 'bamidele@gmail.com', 'Event Owner'),
(11, 'bolu@gmail.', 'bolu@gmail.com', 'bolu@gmail.com', 'bolu@gmail.com', 'bolu@gmail.com', 'Event Owner'),
(12, 'bolu2@gmail', 'bolu2@gmail.com', 'bolu2@gmail.com', 'bolu2@gmail.com', 'bolu2@gmail.com', 'Event Owner');

-- --------------------------------------------------------

--
-- Table structure for table `eventowner`
--

CREATE TABLE `eventowner` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `event_date` varchar(20) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `event_space_selected` varchar(80) NOT NULL,
  `payment_in_full` varchar(10) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `vendor_needed` varchar(20) NOT NULL,
  `vendorContacted` varchar(255) NOT NULL,
  `planner_name` varchar(50) NOT NULL,
  `budget_price` int(11) NOT NULL,
  `owner_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventowner`
--

INSERT INTO `eventowner` (`id`, `username`, `owner_name`, `event_date`, `event_type`, `event_space_selected`, `payment_in_full`, `phone_number`, `vendor_needed`, `vendorContacted`, `planner_name`, `budget_price`, `owner_image`) VALUES
(1, 'eventowner@gmail.com', 'eventowner@gmail.com', '2020-01-09', 'Birthday', '', '', 'By Transfer', 'yes', 'vendoroseni@gmail.com', 'Adewale', 0, 'DigitalCamp 2019 20190618_203845.jpg'),
(2, 'owner@gmail.com', 'Babanla', '2020-02-01', 'Naming Ceremony', '185415', 'no', '09422222222', 'yes', 'vendoroseni@gmail.com', 'Babanla', 79999990, 'first1.PNG'),
(3, 'tester2@gmail.com', 'Baboo', '2020-01-30', 'Graduation', 'Eko Hotels', 'yes', '+23498765432', 'yes', 'vendoroseni@gmail.com', 'asdsd', 2147483647, 'myexan2.PNG'),
(4, 'third@gmail.com', 'ose', '2020-01-10', 'Wedding', '', '', 'sdsd', 'yes', 'vendoroseni@gmail.com', 'third@gmail.com', 0, 'IMG_20191214_104052.jpg'),
(5, 'baba@gmail.com', 'Adewale', '2020-01-11', 'Wedding', '', '', 'ttt', 'yes', 'vendoroseni@gmail.com', 'Bolu', 4550, 'alexaIS2.PNG'),
(6, 'bolu2@gmail.com', 'dsd', '2020-01-24', 'Wedding', 'Eko Hotels', 'no', '657894', 'yes', '', '333', 22, 'sdlc.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `eventspace`
--

CREATE TABLE `eventspace` (
  `id` int(11) NOT NULL,
  `spaceid` varchar(50) NOT NULL,
  `spacename` varchar(60) NOT NULL,
  `spacedescription` varchar(255) NOT NULL,
  `spaceprice` int(11) NOT NULL,
  `spacemanager` varchar(60) NOT NULL,
  `spaceseat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventspace`
--

INSERT INTO `eventspace` (`id`, `spaceid`, `spacename`, `spacedescription`, `spaceprice`, `spacemanager`, `spaceseat`) VALUES
(185415, '$2y$10$gadyMfZ6RKn9oLodLNHI6uhP9snw6oZAacoHyRf2ca0', '185415', '185415', 185415, '185415', 185415),
(185416, 'BabaSne', 'Eko Hotels', 'Located At Ajakaye Street', 600, 'Bamidele', 300);

-- --------------------------------------------------------

--
-- Table structure for table `eventtype`
--

CREATE TABLE `eventtype` (
  `id` int(11) NOT NULL,
  `event_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventtype`
--

INSERT INTO `eventtype` (`id`, `event_type`) VALUES
(2, 'Wedding'),
(3, 'Birthday'),
(4, 'Naming Ceremony'),
(5, 'Burial'),
(6, 'Graduation');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `description` varchar(80) NOT NULL,
  `images` varchar(50) NOT NULL,
  `visible` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `designation`, `description`, `images`, `visible`) VALUES
(4, 'n ', 'v  ', ' bv ', 'Nigerian student leader.jpg', 1),
(5, 'g', 'vjh', 'jv', 'Petroyal Apparel Native Attire.jpg', 1),
(6, 'jkj', 'jkhjh', 'jh vjk', 'new man movement founding members.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_made`
--

CREATE TABLE `payment_made` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `spacename` varchar(29) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `is_transaction_complete` varchar(7) NOT NULL,
  `payment_date` varchar(20) NOT NULL,
  `payment_reference` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(18) NOT NULL,
  `staff_name` varchar(70) NOT NULL,
  `staff_phone` varchar(20) NOT NULL,
  `staff_email` varchar(50) NOT NULL,
  `staff_position` varchar(30) NOT NULL,
  `staff_image` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `staff_name`, `staff_phone`, `staff_email`, `staff_position`, `staff_image`) VALUES
(2, '', 'dssd', 'sdsd233', 'sdsd@gmail.com', 'dsD', 'statisticstryjambcbt.PNG'),
(3, 'zxdxc ', 'master hilary', '093333333', '3243E@gmail.com', 'Post', 'Screenshot_20190902-204752.png');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `vendor_name` varchar(80) NOT NULL,
  `vendor_service` varchar(255) NOT NULL,
  `vendor_category` varchar(30) NOT NULL,
  `vendor_phone` varchar(15) NOT NULL,
  `vendor_email` varchar(30) NOT NULL,
  `vendor_rating` double(3,2) NOT NULL,
  `rated_by` int(11) NOT NULL,
  `vendor_image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `username`, `vendor_name`, `vendor_service`, `vendor_category`, `vendor_phone`, `vendor_email`, `vendor_rating`, `rated_by`, `vendor_image`) VALUES
(1, 'vendoroseni@gmail.com', 'vendoroseni@gmail.com', 'Music, Decoration', 'DJ', '08175461196', 'vendoroseni@gmail.com', 5.76, 12, '0 (4).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `vendorcategory`
--

CREATE TABLE `vendorcategory` (
  `id` int(11) NOT NULL,
  `vendor_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendorcategory`
--

INSERT INTO `vendorcategory` (`id`, `vendor_category`) VALUES
(5, 'Usher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `eventowner`
--
ALTER TABLE `eventowner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventspace`
--
ALTER TABLE `eventspace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventtype`
--
ALTER TABLE `eventtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_made`
--
ALTER TABLE `payment_made`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendorcategory`
--
ALTER TABLE `vendorcategory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eventowner`
--
ALTER TABLE `eventowner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eventspace`
--
ALTER TABLE `eventspace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185417;

--
-- AUTO_INCREMENT for table `eventtype`
--
ALTER TABLE `eventtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_made`
--
ALTER TABLE `payment_made`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendorcategory`
--
ALTER TABLE `vendorcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
