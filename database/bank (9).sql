-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 08:33 PM
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
  `payment_received` varchar(200) NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `case_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_loan`
--

INSERT INTO `car_loan` (`car_loan_cid`, `case_date`, `bank_name`, `home_branch`, `account_number`, `customer_name`, `npa_date`, `outstanding`, `arr_co_nd`, `notice13_sent_on`, `principal_outstanding`, `bounce_charges`, `overdue_charges`, `other_charges`, `loan_emi_amount`, `no_of_emi_outstanding`, `reg_no`, `residence_address`, `residence_contact_no`, `office_address`, `office_contact_no`, `make`, `engine_no`, `chassis_no`, `tenure`, `co_applicant_name`, `co_applicant_mobile`, `co_applicant_address`, `employer_name`, `employer_mobile`, `employer_address`, `amount_recovered`, `bill_raised`, `payment_received`, `approved`, `case_status`) VALUES
(12, '2021-02-01', 'HDFC', 'Mukherjee Nagar', '1811003030232', 'Ishwar Baisla', '2021-02-10', '2021-02-19', '', '0000-00-00', '', '', '', '', '', 0, '', 'Wazirabad Village', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0);

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
(9, '2021-02-03', '1', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', '', '', 'Samarth Tandon', '1000000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '500000', '', '4500000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', 1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '-', '-', 0, '0000-00-00', '-', '-', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '15000.420', '', '', 1, 0),
(10, '2021-02-01', '2', 'IDBI', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', 'Manager', 'ishwar2303@gmail.com', 'Jatin Kumar', '2000000', '2021-02-02', '2021-02-03', '2021-02-04', '2021-02-05', '2021-02-06', '500000', 'asset 1\r<br/>asset 2', '700000', '2021-02-07', '2021-02-08', '2021-02-09', '2021-02-10', '2021-02-11', 'Tapas Baranwal', '2021-02-12', '2021-02-13', '2021-02-14', '2021-02-15', '2021-02-16', '0000-00-00', '2021-02-18', '2021-02-19', '2021-02-20', '2021-02-21', '2021-02-22', 'Postpone reason here...', '0000-00-00', '200000', '50000', '2021-02-23', '2021-02-24', 1, '450000', '2021-02-25', '150000', '2021-02-26', '850000', '2021-02-27', '1500000', '250000', 1, '2021-02-28', '650000', '350000', 1, '2021-03-01', '250000', '150000', 0, '2021-03-02', '2021-03-03', '1800000', '2021-03-04', '2021-03-05', '2021-03-06', '750000', '2021-03-07', '2021-03-08', '9500000', '4530000', '1000000.500', 'Dainik Jagaran', 'Times of India', 0, 0),
(11, '2021-02-05', '2', 'IDBI', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Tapas Baranwal', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '850000', '', '2500000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(12, '2021-02-05', '1', 'SBI', 'Vijay Nagar', 'Uttar Pradesh', 'Mirzapur', 'H-7 Vijay Nagar, Distt. \r<br/>Delhi, Delhi 110 009', 'Samarth Tandon', '', '', '', 'Shubham Maurya', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '500000', '', '1500000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0);

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

--
-- Dumping data for table `home_loan_status`
--

INSERT INTO `home_loan_status` (`status_id`, `case_id`, `ra_agreement_expired_on`, `date_of_next_hearing`, `date_of_redirection_by_advocate`, `lease_on`, `physical_possession_fixed_on`, `compromise`, `date_of_compromise`, `amount_of_compromise`, `full_compromise_paid_upto`, `ots`, `date_of_ots_accepted`, `amount_of_ots`, `amount_of_ots_paid_upto`, `date_of_ra_bill`, `amount_of_ra_bill`, `ra_bill_forward_to_bank_on`, `ra_bill_paid_on`, `ra_bill_paid_amount`, `possession_postpone_on`, `possession_postpone_reason`, `reserve_price`, `emd_amount`, `property_visit_by_prospective_buyers_on`, `auction_date`, `compromise_ots_failed_date`, `compromise_ots_failed`) VALUES
(13, 9, '2021-02-05', '0000-00-00', '0000-00-00', '0000-00-00', '2021-02-06', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '2021-02-19', '0000-00-00', '562000.2563', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 1),
(15, 10, '2021-02-05', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 1, '0000-00-00', '8500.000', '', 1, '0000-00-00', '458000.00', '', '0000-00-00', '458000.2560', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 1),
(16, 9, '2021-02-19', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 0),
(18, 9, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(20, 9, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(21, 9, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(24, 9, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(25, 9, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1);

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
(124, 21, 'View user search', 1),
(126, 21, 'Coursera registration', 0);

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
(9, 1, 9, 21, 12, '21-02-03 12:42:13pm'),
(10, 1, 9, 21, 10, '21-02-03 12:54:39pm'),
(11, 1, 9, 21, 3, '21-02-03 12:55:04pm'),
(12, 1, 9, 21, 2, '21-02-03 12:56:04pm'),
(13, 1, 9, 21, 8, '21-02-03 01:09:27pm'),
(14, 1, 9, 21, 6, '21-02-03 01:18:21pm'),
(15, 1, 9, 21, 7, '21-02-03 01:18:51pm'),
(16, 1, 9, 21, 4, '21-02-03 01:20:18pm'),
(17, 1, 9, 21, 3, '21-02-03 01:22:31pm'),
(18, 1, 9, 21, 5, '21-02-03 01:22:51pm'),
(19, 1, 9, 21, 6, '21-02-03 01:27:43pm'),
(20, 1, 9, 21, 6, '21-02-03 01:27:47pm'),
(21, 1, 9, 21, 7, '21-02-03 01:27:51pm'),
(22, 1, 9, 21, 7, '21-02-03 01:27:54pm'),
(23, 1, 9, 21, 7, '21-02-03 01:27:54pm'),
(24, 1, 9, 21, 6, '21-02-03 06:55:31pm'),
(25, 1, 9, 21, 7, '21-02-03 06:57:06pm'),
(26, 1, 9, 21, 6, '21-02-03 06:58:19pm'),
(27, 1, 9, 21, 7, '21-02-03 06:58:24pm'),
(28, 1, 9, 21, 7, '21-02-03 06:58:24pm'),
(29, 1, 9, 21, 12, '21-02-03 06:58:32pm'),
(30, 1, 9, 21, 11, '21-02-03 07:09:28pm'),
(31, 1, 9, 21, 10, '21-02-03 07:09:44pm'),
(32, 1, 10, 21, 1, '21-02-03 07:26:57pm'),
(33, 1, 10, 24, 2, '21-02-03 10:15:54pm'),
(34, 1, 10, 24, 3, '21-02-03 10:16:44pm'),
(35, 1, 9, 21, 2, '21-02-04 12:11:19am'),
(36, 1, 9, 21, 2, '21-02-04 12:13:55am'),
(37, 1, 9, 21, 2, '21-02-04 12:14:24am'),
(38, 1, 9, 21, 2, '21-02-04 12:15:36am'),
(39, 1, 9, 21, 3, '21-02-04 03:54:21pm'),
(40, 1, 9, 21, 3, '21-02-04 03:54:26pm'),
(41, 1, 9, 21, 3, '21-02-04 03:54:32pm'),
(42, 1, 9, 21, 3, '21-02-04 03:54:38pm'),
(43, 1, 9, 21, 3, '21-02-04 03:54:38pm'),
(44, 1, 9, 21, 3, '21-02-04 03:55:37pm'),
(45, 1, 9, 21, 3, '21-02-04 03:55:49pm'),
(46, 1, 9, 21, 3, '21-02-04 03:55:59pm'),
(47, 1, 9, 21, 3, '21-02-04 03:56:08pm'),
(48, 1, 9, 21, 3, '21-02-04 03:56:13pm'),
(49, 1, 9, 21, 3, '21-02-04 03:56:19pm'),
(50, 1, 9, 21, 5, '21-02-04 04:05:58pm'),
(51, 1, 9, 21, 5, '21-02-04 04:06:25pm'),
(52, 1, 9, 21, 5, '21-02-04 04:11:54pm'),
(53, 1, 9, 21, 4, '21-02-04 04:12:15pm'),
(54, 1, 9, 21, 5, '21-02-04 04:12:32pm'),
(55, 1, 9, 21, 5, '21-02-04 04:15:26pm'),
(56, 1, 9, 21, 4, '21-02-04 04:15:50pm'),
(57, 1, 9, 21, 6, '21-02-04 04:20:31pm'),
(58, 1, 9, 21, 7, '21-02-04 04:21:01pm'),
(59, 1, 9, 21, 12, '21-02-04 04:25:11pm'),
(60, 1, 9, 21, 10, '21-02-04 04:28:23pm'),
(61, 1, 9, 21, 9, '21-02-05 12:30:11pm'),
(62, 1, 10, 21, 2, '21-02-05 06:42:39pm'),
(63, 1, 9, 21, 8, '21-02-05 06:44:15pm'),
(64, 1, 9, 21, 2, '21-02-05 07:07:49pm'),
(65, 1, 9, 21, 2, '21-02-05 07:18:32pm'),
(66, 1, 9, 21, 2, '21-02-05 07:19:01pm'),
(67, 1, 9, 21, 2, '21-02-05 07:19:54pm'),
(68, 1, 9, 21, 2, '21-02-05 07:21:12pm'),
(69, 1, 9, 21, 6, '21-02-05 07:34:28pm'),
(70, 1, 9, 21, 7, '21-02-05 07:36:35pm'),
(71, 2, 12, 21, 2, '21-02-05 07:37:34pm'),
(72, 1, 11, 21, 1, '21-02-05 11:59:57pm'),
(73, 1, 12, 21, 1, '21-02-06 12:01:15am'),
(74, 1, 9, 21, 6, '21-02-06 12:03:55am'),
(75, 1, 9, 21, 7, '21-02-06 12:05:16am'),
(76, 1, 11, 21, 6, '21-02-06 12:12:09am'),
(77, 1, 11, 21, 7, '21-02-06 12:12:26am');

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
(21, 'Ishwar Baisla', 'aXNod2FyMjMwM0BnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 1, 2, 1, '21-01-29 07:07:19pm'),
(23, 'Tushar', 'dHVzaGFyQGdtYWlsLmNvbQ==', 'OTA2OTU5OTcwOA==', 'VHVzaGFyQDEyMzQ=', 0, 2, 1, '21-01-30 01:22:50pm'),
(24, 'Tapas Baranwal', 'dGFwYXNAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-01-30 04:34:11pm'),
(25, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'ODQ0NzgxMTU5NQ==', 'SXNod2FyMjMwM0A=', 0, 1, 0, '21-01-30 11:51:26pm'),
(29, 'Jatin Kumar', 'amF0aW5AZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 1, 0, '21-02-03 11:21:11pm'),
(33, 'Tapas Baranwal', 'dGFwYXNAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-06 01:00:08am');

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
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `home_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `home_loan_remarks`
--
ALTER TABLE `home_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `home_loan_status`
--
ALTER TABLE `home_loan_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `to_do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
