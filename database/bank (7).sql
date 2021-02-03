-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2021 at 08:12 AM
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

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_name`, `bank_branch`, `bank_state`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`) VALUES
(9, 'SBI', 'Vijay Nagar', 'Uttar Pradesh', 'Mirzapur', ' H-7 Vijay Nagar, Distt. \r<br/>Delhi, Delhi 110 009', 'Samarth Tandon', 0),
(10, 'IDBI', 'Mukherjee Nagar', 'New Delhi', 'Delhi', ' 1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', 8447811595),
(11, 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', ' No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', 7573919585),
(12, 'PNB', 'Mukherjee Nagar', 'Chandigarh', 'Delhi', ' Shop No G1, G2, G3, G4 Manushri Ansal Building', 'Ishwar Baisla', 9821671707),
(16, 'BANK OF BARODA', 'Vijay Nagar', 'Gujarat', 'Delhi', ' Wazirabad Village\r<br/>delhi 110084', 'Ishwar Baisla', 9821671707);

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
  `payment_received` varchar(200) NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `case_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_loan`
--

INSERT INTO `car_loan` (`car_loan_cid`, `case_date`, `bank_name`, `home_branch`, `account_number`, `customer_name`, `npa_date`, `outstanding`, `arr_co_nd`, `notice13_sent_on`, `principal_outstanding`, `bounce_charges`, `overdue_charges`, `other_charges`, `loan_emi_amount`, `no_of_emi_outstanding`, `reg_no`, `residence_address`, `residence_contact_no`, `office_address`, `office_contact_no`, `make`, `engine_no`, `chassis_no`, `tenure`, `co_applicant_name`, `co_applicant_mobile`, `co_applicant_address`, `employer_name`, `employer_mobile`, `employer_address`, `amount_recovered`, `bill_raised`, `payment_received`, `approved`, `case_status`) VALUES
(12, '2021-02-01', 'HDFC', 'Mukherjee Nagar', '1811003030232', 'Ishwar Baisla', '2021-02-10', '', '', '0000-00-00', '', '', '', '', '', 0, '', 'Wazirabad Village', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0);

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

--
-- Dumping data for table `car_loan_remarks`
--

INSERT INTO `car_loan_remarks` (`remark_id`, `case_id`, `remark_date`, `remark`) VALUES
(61, 18, '2021-01-29', 'Perfect');

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

--
-- Dumping data for table `home_loan`
--

INSERT INTO `home_loan` (`home_loan_cid`, `case_date`, `npa_case`, `bank_name`, `bank_branch`, `bank_state`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`, `bank_contact_person_designation`, `bank_contact_person_email`, `borrower_name`, `amount`, `outstanding`, `ra_agreement_signed_on`, `ra_agreement_expired_on`, `date_of_notice13_2`, `date_of_notice13_3`, `primary_security`, `collateral_security`, `total_security`, `date_of_symbolic_possession`, `publication_hindi_newspaper_on`, `publication_english_newspaper_on`, `requested_bank_for_documents`, `documents_received_on`, `advocate_name`, `documents_given_to_advocate_on`, `date_of_redirection_by_advocate`, `application_file_dm_cmm_by_advocate_on`, `date_of_hearing`, `order_received_on`, `order_forwarded_to_bank_on`, `lease_on`, `physical_possession_fixed_on`, `mortgage_property_on`, `possession_taken_on`, `possession_postpone_on`, `possession_postpone_reason`, `property_on_auction`, `reserve_price`, `emd_amount`, `property_visit_by_prospective_buyers_on`, `auction_date`, `auction_status`, `emd_deposit`, `emd_deposit_on`, `fifteen_percent_possession`, `fifteen_percent_possession_on`, `full_deposit`, `full_deposit_on`, `over_above`, `forfitted`, `compromise`, `date_of_compromise`, `amount_of_compromise`, `full_compromise_paid_upto`, `ots`, `date_of_ots_accepted`, `amount_of_ots`, `amount_of_ots_paid_upto`, `compromise_ots_failed`, `compromise_ots_failed_date`, `property_sold_on`, `property_sold_for`, `full_amount_compromise_received_on`, `full_amount_ots_received_on`, `date_of_ra_bill`, `amount_of_ra_bill`, `ra_bill_forward_to_bank_on`, `ra_bill_paid_on`, `ra_bill_paid_amount`, `total_amount_of_expenses_incurred`, `income_case_wise_profit_loss`, `hindi_publication_name`, `english_publication_name`, `approved`, `case_status`) VALUES
(9, '2021-02-03', '1', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', '', '', 'Jatin Kumar', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '500000', '', '4500000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 1);

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

--
-- Dumping data for table `to_do`
--

INSERT INTO `to_do` (`to_do_id`, `user_id`, `to_do_work`, `status`) VALUES
(114, 21, 'Add Home Loan', 1),
(115, 21, 'Add Status to Home Loan', 1),
(116, 21, 'Edit Home Loan', 1),
(117, 21, 'Edit Status to Home Loan', 1),
(118, 21, 'View Home Loan', 1),
(119, 21, 'View Home Loan Status', 1),
(120, 21, 'Custom Dropdown menu for action on case', 1);

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

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`activity_id`, `loan`, `case_id`, `user_id`, `operation_id`, `timestamp`) VALUES
(7, 2, 12, 21, 1, '21-02-02 11:30:36am'),
(8, 1, 9, 21, 1, '21-02-02 11:31:02am'),
(9, 1, 9, 21, 12, '21-02-03 12:42:13pm');

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
  `user_updated_timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `user_full_name`, `user_email`, `user_mobile`, `user_password`, `user_password_changed`, `user_role`, `user_updated_timestamp`) VALUES
(21, 'Ishwar Baisla', 'aXNod2FyMjMwM0BnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 1, 2, '21-01-29 07:07:19pm'),
(23, 'Tushar', 'dHVzaGFyQGdtYWlsLmNvbQ==', 'OTA2OTU5OTcwOA==', 'VHVzaGFyQDEyMzQ=', 0, 2, '21-01-30 01:22:50pm'),
(24, 'Tapas Baranwal', 'dGFwYXNAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, '21-01-30 04:34:11pm'),
(25, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'ODQ0NzgxMTU5NQ==', 'SXNod2FyMjMwM0A=', 0, 1, '21-01-30 11:51:26pm');

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
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `car_loan`
--
ALTER TABLE `car_loan`
  MODIFY `car_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `car_loan_remarks`
--
ALTER TABLE `car_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `home_loan`
--
ALTER TABLE `home_loan`
  MODIFY `home_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `home_loan_remarks`
--
ALTER TABLE `home_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `home_loan_status`
--
ALTER TABLE `home_loan_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `to_do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
