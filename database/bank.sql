-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 03:09 AM
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

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_name`, `bank_branch`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`) VALUES
(9, 'State Bank of India', 'Vijay Nagar', 'Delhi', ' H-7 Vijay Nagar, Distt. \r<br/>Delhi, Delhi 110 009', 'Ishwar Baisla', 9821671707),
(10, 'IDBI', 'Mukherjee Nagar', 'Delhi', ' 1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', 8447811595),
(11, 'HDFC', 'Mukherjee Nagar', 'Delhi', ' No 1054 A\r\nMukherjee Nagar\r\nNew Delhi-110009', 'Ishwar Baisla', 7573919585),
(12, 'PNB', 'Mukherjee Nagar', 'Delhi', ' Shop No G1, G2, G3, G4 Manushri Ansal Building', 'Ishwar Baisla', 9821671707),
(13, 'Bank of Baroda', 'Mukherjee Nagar', 'Delhi', ' 855, Ground Floor, \r<br/>Banda Bahadur Marg, \r<br/>Mukherjee Nagar, Delhi, 110009', 'Ishwar', 9821671707),
(14, 'Bank of Baroda', 'Vijay Nagar', 'Delhi', ' Wazirabad Village', 'Ishwar Baisla', 9821671707);

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

--
-- Dumping data for table `car_loan`
--

INSERT INTO `car_loan` (`car_loan_cid`, `home_branch`, `account_number`, `customer_name`, `npa_date`, `outstanding`, `arr_co_nd`, `notice13_sent_on`, `principal_outstanding`, `bounce_charges`, `overdue_charges`, `other_charges`, `loan_emi_amount`, `no_of_emi_outstanding`, `reg_no`, `residence_address`, `residence_contact_no`, `office_address`, `office_contact_no`, `make`, `engine_no`, `chassis_no`, `tenure`, `co_applicant_name`, `co_applicant_mobile`, `co_applicant_address`, `employer_name`, `employer_mobile`, `employer_address`, `amount_recovered`, `bill_raised`, `payment_received`) VALUES
(8, 'Vijay Nagar', '12345678958', 'Ishwar Baisla', '2021-01-30', '200000', '7.5', '2020-01-30', '4000', '200', '500', '150', '14000', 20, '1811003030231', 'wazirabad village gali no-6\r<br/>Home F/434 Delhi - 110084', '9868949632', 'Vijay Nagar Delhi\r<br/>H-7 Vijay Nagar, Distt. Delhi, \r<br/>Delhi 110 009', '9868949632', 'Something', 'FAFA1421452', 'DL SP 4907', '25', 'Ishwar Baisla', '9015523501', 'Mukherjee Nagar\r<br/>Delhi\r<br/>Shop No G1, G2, G3, G4\r<br/> Manushri Ansal Building', 'Ishwar Baisla', '9650253586', '855, Ground Floor, Banda Bahadur Marg,\r<br/>Mukherjee Nagar, Delhi, 110009', '3000', '3001', '158000');

-- --------------------------------------------------------

--
-- Table structure for table `home_loan`
--

CREATE TABLE `home_loan` (
  `home_loan_cid` int(11) NOT NULL,
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
  `application_file_dm_cmm_by_advocate_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_loan`
--

INSERT INTO `home_loan` (`home_loan_cid`, `bank_name`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`, `bank_contact_person_designation`, `bank_contact_person_email`, `borrower_name`, `amount`, `outstanding_on`, `ra_agreement_signed_on`, `ra_agreement_expired_on`, `date_of_notice13_2`, `date_of_notice13_3`, `primary_security`, `collateral_security`, `total_security`, `date_of_symbolic_possession`, `publication_hindi_newspaper_on`, `publication_english_newspaper_on`, `requested_bank_for_documents`, `documents_received_on`, `documents_given_to_advocate_on`, `application_file_dm_cmm_by_advocate_on`) VALUES
(1, 'Bank of Baroda', '855, Ground Floor, \r\nBanda Bahadur Marg, \r\nMukherjee Nagar, Delhi, 110009', 'Ishwar', '9821671707', 'Manager', 'ishwar2303@gmail.com', 'Ishwar Baisla', '50000', '2021-01-09', '2021-01-22', '2021-01-10', '2021-01-30', '2021-01-28', 'Some asset', 'some asset', 'some asset', '2021-01-20', '2021-01-30', '2021-01-26', '2021-01-28', '2021-02-06', '2021-01-21', '2021-01-27'),
(2, 'IDBI', '1048, Ground Floor, Banda \r\nBahadur Marg, \r\nMukherjee Nagar, \r\nNew Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', 'Manager', 'ishwar2303@gmail.com', 'Ishwar Baisla', '50000', '2021-01-29', '2021-01-29', '2021-01-15', '2021-01-27', '2021-01-22', '', '', '', '2021-01-01', '2021-01-27', '2021-01-14', '2021-01-15', '2021-01-09', '2021-01-16', '2021-01-29');

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
(4, 'Ishwar Baisla', 'aXNod2FyMjMwM0BnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 2, '21-01-23 01:56:56pm'),
(8, 'Ishwar Baisla', 'aXNod2FyMjMwMzVAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 1, '21-01-23 03:02:31pm');

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
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `car_loan`
--
ALTER TABLE `car_loan`
  MODIFY `car_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `home_loan`
--
ALTER TABLE `home_loan`
  MODIFY `home_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
