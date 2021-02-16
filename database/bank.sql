-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 11:22 PM
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
(10, 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', ' 1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', 8447811595),
(11, 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', ' No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', 7573919585),
(12, 'PNB', 'Mukherjee Nagar', 'Chandigarh', 'Delhi', ' Shop No G1, G2, G3, G4 Manushri Ansal Building', 'Ishwar Baisla', 9821671707),
(16, 'BANK OF BARODA', 'Vijay Nagar', 'Gujarat', 'Delhi', ' Wazirabad Village\r<br/>delhi 110084', 'Ishwar Baisla', 9821671707),
(21, 'SBI', 'Mukherjee Nagar', 'Haryana', 'Delhi', 'Wazirabad Village', 'Ishwar Baisla', 0);

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

--
-- Dumping data for table `car_loan`
--

INSERT INTO `car_loan` (`car_loan_cid`, `case_date`, `bank_name`, `home_branch`, `account_number`, `customer_name`, `npa_date`, `outstanding`, `arr_co_nd`, `notice13_sent_on`, `principal_outstanding`, `bounce_charges`, `overdue_charges`, `other_charges`, `loan_emi_amount`, `no_of_emi_outstanding`, `reg_no`, `residence_address`, `residence_contact_no`, `office_address`, `office_contact_no`, `make`, `engine_no`, `chassis_no`, `tenure`, `co_applicant_name`, `co_applicant_mobile`, `co_applicant_address`, `employer_name`, `employer_mobile`, `employer_address`, `amount_recovered`, `bill_raised`, `payment_received_on`, `payment_received`, `type_of_loan`, `type_of_security`, `last_amount_paid_on`, `disburse_date`, `mature_date`, `seizure_date`, `auction_date`, `auction_amount`, `recovery_date`, `full_amount`, `part_amount`, `regularise_date`, `full_payment_paid_on`, `approved`, `case_status`) VALUES
(13, '2021-02-11', 'SBI', 'Mukherjee Nagar', '1811003030232', 'Ishwar Baisla', '2021-02-13', '2021-02-13', '2021-02-20', '0000-00-00', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00', '0000-00-00', 0, 0),
(14, '2021-02-01', 'SBI', 'Mukherjee Nagar', '18110030303232', 'Ishwar Baisla', '2021-02-02', '2021-02-03', '2021-02-07', '2021-02-08', '1000', '2000', '3000', '4000', '5000', 20, '1811003030232', 'wazirabad village', '9015523501', 'mukkherjee nagar', '9821671707', '', 'FAFA1421452', 'DL SP 4907', '56', 'Tapas Baranwal', '9071523566', 'Timarpur', 'Abhishek', '9868949631', 'Gautham city', '20000', '30000', '0000-00-00', '10000', '1', 'security type here...', '2021-02-04', '2021-02-05', '2021-02-06', '2021-02-09', '2021-02-10', 850000, '2021-02-11', 959999.999907, 9000, '2021-02-12', '2021-02-13', 0, 0);

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
(61, 18, '2021-01-29', 'Perfect'),
(64, 13, '2021-02-11', 'SBI Car loan remark'),
(65, 13, '2021-02-11', 'Another remark'),
(66, 14, '2021-02-15', 'Remark added');

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

--
-- Dumping data for table `car_loan_status`
--

INSERT INTO `car_loan_status` (`status_id`, `case_id`, `auction_date`, `auction_amount`, `recovery_date`, `full_amount`, `part_amount`, `bill_raised`, `payment_received_on`, `payment_received`, `regularise_date`, `full_payment_paid_on`) VALUES
(1, 13, '0000-00-00', 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, '0000-00-00', '0000-00-00'),
(2, 13, '2021-02-01', 1000, '2021-02-02', 2000, 3000, 5000, '2021-02-03', 6000, '2021-02-04', '2021-02-05'),
(3, 14, '2021-02-15', 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, '0000-00-00', '0000-00-00');

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

--
-- Dumping data for table `e_auction`
--

INSERT INTO `e_auction` (`e_auction_id`, `bank_name`, `branch_address`, `borrower_name`, `property_address`, `sold_price`, `bidder_name`) VALUES
(1, 'STATE BANK OF INDIA', 'Vijay Nagar\r<br/>Delhi - 110084', 'Jatin Kumar', 'Mukherjee Nagar,\r<br/>Near Aggarwal sweets,\r<br/>Delhi - 110084', '50000000', 'Ishwar Baisla'),
(3, 'INDUSTRIAL DEVELOPMENT BANK OF INDIA', 'Vijay Nagar,\r<br/>Near Baraat Ghar\r<br/>Delhi - 110084', 'Ishwar Baisla', 'Mukherjee Nagar,\r<br/>Near Aggarwal sweets,\r<br/>Delhi - 110084', '50000000', 'Tapas Baranwal'),
(4, 'BANK OF BARODA', 'Vijay Nagar\r<br/>Delhi - 110084', 'Ishwar Baisla', 'Mukherjee Nagar,\r<br/>Near Aggarwal sweets,\r<br/>Delhi - 110084', '1000000', 'Samarth Tandon');

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
(9, '2021-02-03', '1', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', '', '', 'Samarth Tandon', '1000000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '500000', '', '4500000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '2021-02-05', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', 1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '-', '-', 0, '0000-00-00', '-', '-', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '15000.420', '', '', 1, 0),
(10, '2021-02-01', '2', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', 'Manager', 'ishwar2303@gmail.com', 'Jatin Kumar', '2000000', '2021-02-02', '2021-02-03', '2021-02-04', '2021-02-05', '2021-02-06', '500000', 'asset 1\r<br/>asset 2', '700000', '2021-02-07', '2021-02-08', '2021-02-09', '2021-02-10', '2021-02-11', 'Tapas Baranwal', '2021-02-12', '2021-02-13', '2021-02-14', '2021-02-15', '2021-02-16', '0000-00-00', '2021-02-18', '2021-02-19', '2021-02-20', '2021-02-21', '2021-02-22', 'Postpone reason here...', '0000-00-00', '200000', '50000', '2021-02-23', '2021-02-24', 1, '450000', '2021-02-25', '150000', '2021-02-26', '850000', '2021-02-27', '1500000', '250000', 1, '2021-02-28', '650000', '350000', 1, '2021-03-01', '250000', '150000', 0, '2021-03-02', '2021-03-03', '1800000', '2021-03-04', '2021-03-05', '2021-03-06', '750000', '2021-03-07', '2021-03-08', '9500000', '4530000', '1000000.500', 'Dainik Jagaran', 'Times of India', 1, 0),
(11, '2021-02-05', '2', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Tapas Baranwal', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '850000', '', '2500000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(13, '2021-02-05', '2', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Tushar', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '500000', '', '800000', '0000-00-00', '2021-02-07', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '-', '-', 0, '0000-00-00', '-', '-', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', 'Dainik Jagaran', '', 0, 1),
(14, '2021-02-10', '2', 'BANK OF BARODA', 'Vijay Nagar', 'Gujarat', 'Delhi', 'Wazirabad Village\r<br/>delhi 110084', 'Ishwar Baisla', '9821671707', '', '', 'Jay', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '58000', '', '680000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '-', '-', 0, '0000-00-00', '-', '-', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(15, '2021-02-04', '3', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Jatin Kumar', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '580000', '', '566000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(16, '2021-02-20', '2', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Ishwar Baisla', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '520000', '', '690000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 2),
(17, '2021-02-20', '3', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Jatin Kumar', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '960000', '', '5820000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(18, '2021-02-04', '2', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Samarth Tandon', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '5622000', '892000', '5895200', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(19, '2021-02-11', '2', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Ishwar Baisla', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '250000', '', '8520000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', -1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(20, '2021-02-12', '3', 'Industrial Development Bank of India', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Ishwar Baisla', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '850000', '', '950000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '0000-00-00', 1, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 1);

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

--
-- Dumping data for table `home_loan_remarks`
--

INSERT INTO `home_loan_remarks` (`remark_id`, `case_id`, `remark_date`, `remark`) VALUES
(66, 13, '2021-02-07', 'This is multiline remark<br/>This is how it works'),
(70, 9, '2021-02-08', 'HDFC Another remark'),
(74, 14, '2021-02-09', 'Bank of Baroda'),
(76, 10, '2021-02-11', 'New multiline remark<br/>Another Line'),
(78, 11, '2021-02-13', 'remark'),
(79, 9, '2021-02-14', 'Remark');

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
(25, 9, '2021-02-04', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 1),
(27, 13, '2021-02-12', '0000-00-00', '0000-00-00', '0000-00-00', '2021-02-27', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(28, 19, '0000-00-00', '2021-02-05', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(29, 9, '0000-00-00', '2021-02-11', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(30, 9, '0000-00-00', '2021-02-04', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(31, 9, '0000-00-00', '2021-02-05', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1),
(32, 9, '0000-00-00', '2021-02-05', '0000-00-00', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', -1);

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
(149, 21, 'Car Loan Update New Details', 0),
(150, 21, 'Print Feature', 0),
(151, 21, 'Open E-Auction Add/Update/Delete', 1),
(156, 21, 'Case Activity Search box glitch', 0),
(157, 21, 'Custom Dropdown reconfigure', 0),
(158, 21, 'Home BRI', 0),
(159, 21, 'Car loan status Type Of Security dropdown menu', 0);

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
(72, 1, 11, 21, 1, '21-02-05 11:59:57pm'),
(74, 1, 9, 21, 6, '21-02-06 12:03:55am'),
(75, 1, 9, 21, 7, '21-02-06 12:05:16am'),
(76, 1, 11, 21, 6, '21-02-06 12:12:09am'),
(77, 1, 11, 21, 7, '21-02-06 12:12:26am'),
(78, 1, 13, 21, 1, '21-02-07 02:05:52pm'),
(79, 1, 13, 35, 2, '21-02-07 02:11:55pm'),
(80, 1, 13, 35, 6, '21-02-07 02:13:10pm'),
(81, 1, 13, 21, 3, '21-02-07 02:20:29pm'),
(82, 1, 13, 21, 11, '21-02-07 02:22:36pm'),
(83, 1, 13, 21, 10, '21-02-07 02:23:15pm'),
(84, 1, 13, 21, 12, '21-02-07 02:23:27pm'),
(85, 1, 10, 21, 8, '21-02-07 02:24:43pm'),
(86, 1, 14, 21, 1, '21-02-07 09:07:29pm'),
(87, 1, 15, 21, 1, '21-02-07 09:11:07pm'),
(88, 1, 16, 21, 1, '21-02-07 09:30:30pm'),
(89, 1, 17, 21, 1, '21-02-07 09:30:53pm'),
(90, 1, 18, 21, 1, '21-02-07 09:33:08pm'),
(91, 1, 19, 21, 1, '21-02-07 09:34:35pm'),
(92, 1, 20, 21, 1, '21-02-07 09:42:35pm'),
(93, 1, 20, 21, 12, '21-02-07 09:52:49pm'),
(94, 1, 16, 21, 11, '21-02-07 10:07:30pm'),
(95, 1, 10, 21, 2, '21-02-07 10:32:05pm'),
(96, 1, 10, 21, 2, '21-02-07 10:32:48pm'),
(97, 1, 9, 21, 6, '21-02-08 12:20:14am'),
(98, 1, 9, 21, 6, '21-02-08 12:21:22am'),
(100, 1, 9, 21, 6, '21-02-08 12:23:57am'),
(102, 1, 10, 21, 6, '21-02-08 02:16:41am'),
(103, 1, 9, 37, 4, '21-02-08 06:16:49pm'),
(104, 1, 14, 37, 2, '21-02-08 06:18:08pm'),
(105, 1, 9, 21, 6, '21-02-09 11:03:53pm'),
(106, 1, 14, 21, 6, '21-02-09 11:04:43pm'),
(107, 1, 9, 21, 7, '21-02-09 11:05:38pm'),
(108, 1, 9, 21, 7, '21-02-09 11:05:53pm'),
(109, 1, 9, 21, 7, '21-02-09 11:05:58pm'),
(110, 1, 9, 21, 7, '21-02-09 11:05:58pm'),
(111, 1, 19, 21, 3, '21-02-10 08:19:03pm'),
(112, 1, 9, 21, 3, '21-02-10 09:49:32pm'),
(113, 1, 9, 21, 3, '21-02-10 09:52:04pm'),
(114, 1, 9, 21, 3, '21-02-10 09:53:02pm'),
(115, 1, 9, 21, 3, '21-02-10 09:53:36pm'),
(116, 2, 13, 21, 1, '21-02-11 10:24:35am'),
(117, 2, 13, 21, 2, '21-02-11 10:28:29am'),
(118, 2, 13, 21, 6, '21-02-11 10:44:47am'),
(119, 2, 13, 21, 6, '21-02-11 10:53:36am'),
(120, 2, 13, 21, 2, '21-02-11 11:40:22am'),
(121, 1, 10, 21, 6, '21-02-11 12:38:12pm'),
(122, 1, 10, 21, 7, '21-02-11 12:38:19pm'),
(123, 1, 10, 21, 7, '21-02-11 12:40:55pm'),
(124, 1, 10, 21, 6, '21-02-11 12:41:18pm'),
(125, 1, 10, 21, 6, '21-02-11 12:43:25pm'),
(126, 1, 10, 21, 7, '21-02-11 12:43:36pm'),
(127, 1, 10, 21, 7, '21-02-11 12:43:36pm'),
(128, 1, 11, 21, 6, '21-02-13 11:38:38pm'),
(129, 1, 13, 21, 12, '21-02-14 12:08:27pm'),
(130, 1, 13, 21, 10, '21-02-14 12:08:33pm'),
(131, 2, 14, 21, 1, '21-02-14 12:36:45pm'),
(132, 2, 14, 21, 2, '21-02-14 01:22:55pm'),
(133, 2, 14, 21, 2, '21-02-14 01:48:32pm'),
(134, 2, 13, 21, 3, '21-02-14 10:17:10pm'),
(135, 2, 13, 21, 3, '21-02-14 10:25:50pm'),
(136, 1, 9, 21, 6, '21-02-14 11:25:54pm'),
(137, 2, 13, 21, 4, '21-02-15 09:45:58am'),
(138, 2, 13, 21, 4, '21-02-15 09:53:18am'),
(139, 2, 13, 21, 4, '21-02-15 09:53:42am'),
(140, 2, 14, 21, 6, '21-02-15 12:49:10pm'),
(141, 2, 14, 21, 3, '21-02-15 10:12:19pm'),
(142, 2, 14, 21, 4, '21-02-15 10:13:20pm'),
(143, 1, 13, 21, 12, '21-02-15 10:21:06pm'),
(144, 1, 13, 21, 10, '21-02-15 10:21:12pm'),
(145, 1, 13, 21, 12, '21-02-15 10:21:20pm'),
(146, 1, 13, 21, 10, '21-02-15 10:21:36pm');

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
(23, 'Tushar', 'dHVzaGFyQGdtYWlsLmNvbQ==', 'OTA2OTU5OTcwOA==', 'VHVzaGFyQDEyMzQ=', 0, 2, 0, '21-01-30 01:22:50pm'),
(24, 'Tapas Baranwal', 'dGFwYXNAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-01-30 04:34:11pm'),
(25, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'ODQ0NzgxMTU5NQ==', 'SXNod2FyMjMwM0A=', 0, 1, 0, '21-01-30 11:51:26pm'),
(29, 'Jatin Kumar', 'amF0aW5AZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 1, 0, '21-02-03 11:21:11pm'),
(33, 'Tapas Baranwal', 'dGFwYXNAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-06 01:00:08am'),
(34, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-07 01:53:33pm'),
(35, 'Tushar Parashar', 'dHVzaGFycGFyYXNoYXJAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 1, 0, '21-02-07 02:10:28pm'),
(36, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-07 02:15:20pm'),
(37, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-07 02:43:23pm'),
(38, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-12 02:19:04am'),
(39, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-12 04:50:41pm'),
(40, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 0, '21-02-12 05:56:28pm'),
(41, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, 1, '21-02-12 06:14:51pm'),
(42, 'Tushar Parashar', 'dHVzaGFycGFyYXNoYXJAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 1, 1, '21-02-12 06:24:08pm'),
(43, 'Tapas Baranwal', 'dGFwYXNiYXJhbndhbEBnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 2, 1, '21-02-12 06:27:56pm');

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
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `car_loan`
--
ALTER TABLE `car_loan`
  MODIFY `car_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `car_loan_remarks`
--
ALTER TABLE `car_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `car_loan_status`
--
ALTER TABLE `car_loan_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `e_auction`
--
ALTER TABLE `e_auction`
  MODIFY `e_auction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_loan`
--
ALTER TABLE `home_loan`
  MODIFY `home_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `home_loan_remarks`
--
ALTER TABLE `home_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `home_loan_status`
--
ALTER TABLE `home_loan_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `to_do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
