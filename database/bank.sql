-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2021 at 05:58 PM
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
-- Table structure for table `activity_list`
--

CREATE TABLE `activity_list` (
  `operation_id` int(11) NOT NULL,
  `operation_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_list`
--

INSERT INTO `activity_list` (`operation_id`, `operation_name`) VALUES
(1, 'Case Created'),
(2, 'Case Updated'),
(3, 'New Status'),
(4, 'Status Updated'),
(5, 'Status Deleted'),
(6, 'Added Remark'),
(7, 'Remark Deleted'),
(8, 'Case Approved'),
(9, 'Case Refused'),
(10, 'Set To Progress'),
(11, 'Set as Withdraw'),
(12, 'Set as Completed');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_branch` varchar(200) NOT NULL,
  `bank_state` varchar(100) NOT NULL,
  `bank_city` varchar(200) NOT NULL,
  `bank_address` varchar(300) NOT NULL,
  `bank_contact_person_name` varchar(200) NOT NULL,
  `bank_contact_person_number` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_loan`
--

CREATE TABLE `car_loan` (
  `car_loan_cid` int(11) NOT NULL,
  `case_date` date NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `home_branch` varchar(200) NOT NULL,
  `account_number` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `npa_date` date NOT NULL,
  `outstanding` date NOT NULL,
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
  `payment_received_on` date NOT NULL,
  `payment_received` varchar(200) NOT NULL,
  `type_of_loan` varchar(50) NOT NULL,
  `type_of_security` varchar(200) NOT NULL,
  `last_amount_paid_on` date NOT NULL,
  `disburse_date` date NOT NULL,
  `mature_date` date NOT NULL,
  `seizure_date` date NOT NULL,
  `auction_date` date NOT NULL,
  `auction_amount` double NOT NULL,
  `recovery_date` date NOT NULL,
  `full_amount` double NOT NULL,
  `part_amount` double NOT NULL,
  `regularise_date` date NOT NULL,
  `full_payment_paid_on` date NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `case_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_loan_remarks`
--

CREATE TABLE `car_loan_remarks` (
  `remark_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `remark_date` date NOT NULL,
  `remark` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_loan_status`
--

CREATE TABLE `car_loan_status` (
  `status_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `auction_date` date NOT NULL,
  `auction_amount` int(11) NOT NULL,
  `recovery_date` date NOT NULL,
  `full_amount` int(11) NOT NULL,
  `part_amount` int(11) NOT NULL,
  `bill_raised` int(11) NOT NULL,
  `payment_received_on` date NOT NULL,
  `payment_received` int(11) NOT NULL,
  `regularise_date` date NOT NULL,
  `full_payment_paid_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `e_auction`
--

CREATE TABLE `e_auction` (
  `e_auction_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_address` varchar(200) NOT NULL,
  `borrower_name` varchar(50) NOT NULL,
  `property_address` varchar(200) NOT NULL,
  `sold_price` varchar(50) NOT NULL,
  `bidder_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `home_loan`
--

CREATE TABLE `home_loan` (
  `home_loan_cid` int(11) NOT NULL,
  `case_date` date NOT NULL,
  `npa_case` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `bank_state` varchar(100) NOT NULL,
  `bank_city` varchar(100) NOT NULL,
  `bank_address` varchar(300) NOT NULL,
  `bank_contact_person_name` varchar(200) NOT NULL,
  `bank_contact_person_number` varchar(200) NOT NULL,
  `bank_contact_person_designation` varchar(200) NOT NULL,
  `bank_contact_person_email` varchar(200) NOT NULL,
  `borrower_name` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `outstanding` date NOT NULL,
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
  `advocate_name` varchar(100) NOT NULL,
  `documents_given_to_advocate_on` date NOT NULL,
  `date_of_redirection_by_advocate` date NOT NULL,
  `application_file_dm_cmm_by_advocate_on` date NOT NULL,
  `date_of_hearing` date NOT NULL,
  `order_received_on` date NOT NULL,
  `order_forwarded_to_bank_on` date NOT NULL,
  `lease_on` date NOT NULL,
  `physical_possession_fixed_on` date NOT NULL,
  `mortgage_property_on` date NOT NULL,
  `possession_taken_on` date NOT NULL,
  `possession_postpone_on` date NOT NULL,
  `possession_postpone_reason` varchar(200) NOT NULL,
  `property_on_auction` date NOT NULL,
  `reserve_price` varchar(100) NOT NULL,
  `emd_amount` varchar(100) NOT NULL,
  `property_visit_by_prospective_buyers_on` date NOT NULL,
  `auction_date` date NOT NULL,
  `auction_status` tinyint(4) NOT NULL,
  `emd_deposit` varchar(100) NOT NULL,
  `emd_deposit_on` date NOT NULL,
  `fifteen_percent_possession` varchar(100) NOT NULL,
  `fifteen_percent_possession_on` date NOT NULL,
  `full_deposit` varchar(100) NOT NULL,
  `full_deposit_on` date NOT NULL,
  `over_above` varchar(100) NOT NULL,
  `forfitted` varchar(100) NOT NULL,
  `compromise` tinyint(4) NOT NULL,
  `date_of_compromise` date NOT NULL,
  `amount_of_compromise` varchar(200) NOT NULL,
  `full_compromise_paid_upto` varchar(200) NOT NULL,
  `ots` tinyint(4) NOT NULL,
  `date_of_ots_accepted` date NOT NULL,
  `amount_of_ots` varchar(200) NOT NULL,
  `amount_of_ots_paid_upto` varchar(200) NOT NULL,
  `compromise_ots_failed` tinyint(4) NOT NULL,
  `compromise_ots_failed_date` date NOT NULL,
  `property_sold_on` date NOT NULL,
  `property_sold_for` varchar(200) NOT NULL,
  `full_amount_compromise_received_on` date NOT NULL,
  `full_amount_ots_received_on` date NOT NULL,
  `date_of_ra_bill` date NOT NULL,
  `amount_of_ra_bill` varchar(200) NOT NULL,
  `ra_bill_forward_to_bank_on` date NOT NULL,
  `ra_bill_paid_on` date NOT NULL,
  `ra_bill_paid_amount` varchar(200) NOT NULL,
  `total_amount_of_expenses_incurred` varchar(200) NOT NULL,
  `income_case_wise_profit_loss` varchar(200) NOT NULL,
  `hindi_publication_name` varchar(100) NOT NULL,
  `english_publication_name` varchar(100) NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `case_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `home_loan_remarks`
--

CREATE TABLE `home_loan_remarks` (
  `remark_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `remark_date` date NOT NULL,
  `remark` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `home_loan_status`
--

CREATE TABLE `home_loan_status` (
  `status_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `ra_agreement_expired_on` date NOT NULL,
  `date_of_next_hearing` date NOT NULL,
  `date_of_redirection_by_advocate` date NOT NULL,
  `lease_on` date NOT NULL,
  `physical_possession_fixed_on` date NOT NULL,
  `compromise` int(11) NOT NULL,
  `date_of_compromise` date NOT NULL,
  `amount_of_compromise` varchar(100) NOT NULL,
  `full_compromise_paid_upto` varchar(100) NOT NULL,
  `ots` int(11) NOT NULL,
  `date_of_ots_accepted` date NOT NULL,
  `amount_of_ots` varchar(100) NOT NULL,
  `amount_of_ots_paid_upto` varchar(100) NOT NULL,
  `date_of_ra_bill` date NOT NULL,
  `amount_of_ra_bill` varchar(100) NOT NULL,
  `ra_bill_forward_to_bank_on` date NOT NULL,
  `ra_bill_paid_on` date NOT NULL,
  `ra_bill_paid_amount` varchar(100) NOT NULL,
  `possession_postpone_on` date NOT NULL,
  `possession_postpone_reason` varchar(200) NOT NULL,
  `reserve_price` varchar(100) NOT NULL,
  `emd_amount` varchar(100) NOT NULL,
  `property_visit_by_prospective_buyers_on` date NOT NULL,
  `auction_date` date NOT NULL,
  `compromise_ots_failed_date` date NOT NULL,
  `compromise_ots_failed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `to_do`
--

CREATE TABLE `to_do` (
  `to_do_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to_do_work` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `activity_id` int(11) NOT NULL,
  `loan` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `timestamp` varchar(100) NOT NULL
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
  `user_password_changed` tinyint(4) NOT NULL,
  `user_role` tinyint(4) NOT NULL,
  `user_permitted` tinyint(4) NOT NULL,
  `user_updated_timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `user_full_name`, `user_email`, `user_mobile`, `user_password`, `user_password_changed`, `user_role`, `user_permitted`, `user_updated_timestamp`) VALUES
(45, 'Tushar Parashar', 'dHVzaGFycGFyYXNoYXJAZ21haWwuY29t', 'OTA2OTU5OTcwOA==', 'VHVzaGFyQDEyMw==', 1, 2, 1, '21-02-22 10:18:42pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_list`
--
ALTER TABLE `activity_list`
  ADD PRIMARY KEY (`operation_id`);

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
-- Indexes for table `car_loan_remarks`
--
ALTER TABLE `car_loan_remarks`
  ADD PRIMARY KEY (`remark_id`);

--
-- Indexes for table `car_loan_status`
--
ALTER TABLE `car_loan_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `e_auction`
--
ALTER TABLE `e_auction`
  ADD PRIMARY KEY (`e_auction_id`);

--
-- Indexes for table `home_loan`
--
ALTER TABLE `home_loan`
  ADD PRIMARY KEY (`home_loan_cid`);

--
-- Indexes for table `home_loan_remarks`
--
ALTER TABLE `home_loan_remarks`
  ADD PRIMARY KEY (`remark_id`);

--
-- Indexes for table `home_loan_status`
--
ALTER TABLE `home_loan_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `to_do`
--
ALTER TABLE `to_do`
  ADD PRIMARY KEY (`to_do_id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `operation_id` (`operation_id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_list`
--
ALTER TABLE `activity_list`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_loan`
--
ALTER TABLE `car_loan`
  MODIFY `car_loan_cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_loan_remarks`
--
ALTER TABLE `car_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_loan_status`
--
ALTER TABLE `car_loan_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_auction`
--
ALTER TABLE `e_auction`
  MODIFY `e_auction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_loan`
--
ALTER TABLE `home_loan`
  MODIFY `home_loan_cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_loan_remarks`
--
ALTER TABLE `home_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_loan_status`
--
ALTER TABLE `home_loan_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `to_do_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `operation_id` FOREIGN KEY (`operation_id`) REFERENCES `activity_list` (`operation_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_registration` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
