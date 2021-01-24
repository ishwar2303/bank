-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 04:58 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_branch` varchar(200) NOT NULL,
  `bank_city` varchar(200) NOT NULL,
  `bank_address` varchar(200) NOT NULL,
  `bank_contact_person_name` varchar(200) NOT NULL,
  `bank_contact_person_number` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_loan`
--

CREATE TABLE `car_loan` (
  `car_loan_cid` int(11) NOT NULL,
  `home_branch` varchar(200) NOT NULL,
  `account_number` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `npa_date` date NOT NULL,
  `outstanding` varchar(200) NOT NULL,
  `arr_co_nd` varchar(200) NOT NULL,
  `notice13_sent_on` date NOT NULL,
  `principal_outstanding` varchar(200) NOT NULL,
  `bounce_charges` varchar(200) NOT NULL,
  `overdue_charges` varchar(200) NOT NULL,
  `other_charges` varchar(200) NOT NULL,
  `loan_emi_amount` varchar(200) NOT NULL,
  `no_of_emi_outstanding` int(11) NOT NULL,
  `reg_no` varchar(200) NOT NULL,
  `residence_address` varchar(200) NOT NULL,
  `residence_contact_no` varchar(200) NOT NULL,
  `office_address` varchar(200) NOT NULL,
  `office_contact_no` varchar(200) NOT NULL,
  `make` varchar(200) NOT NULL,
  `engine_no` varchar(200) NOT NULL,
  `chassis_no` varchar(200) NOT NULL,
  `tenure` varchar(200) NOT NULL,
  `co_applicant_name` varchar(200) NOT NULL,
  `co_applicant_mobile` varchar(200) NOT NULL,
  `co_applicant_address` varchar(200) NOT NULL,
  `employer_name` varchar(200) NOT NULL,
  `employer_mobile` varchar(200) NOT NULL,
  `employer_address` varchar(200) NOT NULL,
  `amount_recovered` varchar(200) NOT NULL,
  `bill_raised` varchar(200) NOT NULL,
  `payment_received` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `home_loan`
--

CREATE TABLE `home_loan` (
  `home_loan_cid` int(11) NOT NULL,
  `npa_case` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_address` varchar(200) NOT NULL,
  `bank_contact_person_name` varchar(200) NOT NULL,
  `bank_contact_person_number` varchar(200) NOT NULL,
  `bank_contact_person_designation` varchar(200) NOT NULL,
  `bank_contact_person_email` varchar(200) NOT NULL,
  `borrower_name` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `outstanding_on` date NOT NULL,
  `ra_agreement_signed_on` date NOT NULL,
  `ra_agreement_expired_on` date NOT NULL,
  `date_of_notice13_2` date NOT NULL,
  `date_of_notice13_3` date NOT NULL,
  `primary_security` varchar(200) NOT NULL,
  `collateral_security` varchar(200) NOT NULL,
  `total_security` varchar(200) NOT NULL,
  `date_of_symbolic_possession` date NOT NULL,
  `publication_hindi_newspaper_on` date NOT NULL,
  `publication_english_newspaper_on` date NOT NULL,
  `requested_bank_for_documents` date NOT NULL,
  `documents_received_on` date NOT NULL,
  `documents_given_to_advocate_on` date NOT NULL,
  `application_file_dm_cmm_by_advocate_on` date NOT NULL,
  `date_of_hearing` date NOT NULL,
  `compromise` tinyint(4) NOT NULL,
  `date_of_compromise` date NOT NULL,
  `amount_of_compromise` varchar(200) NOT NULL,
  `full_compromise_paid_upto` varchar(200) NOT NULL,
  `ots` tinyint(4) NOT NULL,
  `date_of_ots_accepted` date NOT NULL,
  `amount_of_ots_paid_upto` varchar(200) NOT NULL,
  `compromise_ots_failed` tinyint(4) NOT NULL,
  `property_sold_on` date NOT NULL,
  `property_sold_for` varchar(200) NOT NULL,
  `full_amount_compromise_received_on` date NOT NULL,
  `full_amount_ots_received_on` date NOT NULL,
  `date_of_ra_bill` date NOT NULL,
  `amount_of_ra_bill` varchar(200) NOT NULL,
  `ra_bill_forward_to_bank_on` date NOT NULL,
  `ra_bill_paid_on` varchar(200) NOT NULL,
  `ra_bill_paid_amount` varchar(200) NOT NULL,
  `total_amount_of_expenses_incurred` varchar(200) NOT NULL,
  `income_case_wise_profit_loss` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_mobile` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_role` tinyint(4) NOT NULL,
  `user_updated_timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `user_full_name`, `user_email`, `user_mobile`, `user_password`, `user_role`, `user_updated_timestamp`) VALUES
(4, 'Ishwar Baisla', 'aXNod2FyMjMwM0BnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 2, '21-01-23 01:56:56pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `car_loan`
--
ALTER TABLE `car_loan`
  ADD PRIMARY KEY (`car_loan_cid`);

--
-- Indexes for table `home_loan`
--
ALTER TABLE `home_loan`
  ADD PRIMARY KEY (`home_loan_cid`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `car_loan`
--
ALTER TABLE `car_loan`
  MODIFY `car_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `home_loan`
--
ALTER TABLE `home_loan`
  MODIFY `home_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
