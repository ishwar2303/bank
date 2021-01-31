-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 12:15 PM
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
(12, 'PNB', 'Mukherjee Nagar', '', 'Delhi', ' Shop No G1, G2, G3, G4 Manushri Ansal Building', 'Ishwar Baisla', 9821671707),
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
  `case_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_loan`
--

INSERT INTO `car_loan` (`car_loan_cid`, `case_date`, `bank_name`, `home_branch`, `account_number`, `customer_name`, `npa_date`, `outstanding`, `arr_co_nd`, `notice13_sent_on`, `principal_outstanding`, `bounce_charges`, `overdue_charges`, `other_charges`, `loan_emi_amount`, `no_of_emi_outstanding`, `reg_no`, `residence_address`, `residence_contact_no`, `office_address`, `office_contact_no`, `make`, `engine_no`, `chassis_no`, `tenure`, `co_applicant_name`, `co_applicant_mobile`, `co_applicant_address`, `employer_name`, `employer_mobile`, `employer_address`, `amount_recovered`, `bill_raised`, `payment_received`, `case_status`) VALUES
(1, '2021-01-01', 'ISHWAR BAISLA', 'Ishwar Baisla', '1811003030232', 'Ishwar Baisla', '2021-01-15', '', '', '0000-00-00', '', '', '', '', '', 0, '', 'Wazirabad Village', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0);

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
  `application_file_dm_cmm_by_advocate_on` date NOT NULL,
  `date_of_hearing` date NOT NULL,
  `order_received_on` date NOT NULL,
  `order_forwarded_to_bank_on` date NOT NULL,
  `lease_on` date NOT NULL,
  `physical_possession_fixed_on` date NOT NULL,
  `mortgage_property_on` date NOT NULL,
  `possession_taken_on` date NOT NULL,
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

INSERT INTO `home_loan` (`home_loan_cid`, `case_date`, `npa_case`, `bank_name`, `bank_branch`, `bank_state`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`, `bank_contact_person_designation`, `bank_contact_person_email`, `borrower_name`, `amount`, `outstanding`, `ra_agreement_signed_on`, `ra_agreement_expired_on`, `date_of_notice13_2`, `date_of_notice13_3`, `primary_security`, `collateral_security`, `total_security`, `date_of_symbolic_possession`, `publication_hindi_newspaper_on`, `publication_english_newspaper_on`, `requested_bank_for_documents`, `documents_received_on`, `advocate_name`, `documents_given_to_advocate_on`, `application_file_dm_cmm_by_advocate_on`, `date_of_hearing`, `order_received_on`, `order_forwarded_to_bank_on`, `lease_on`, `physical_possession_fixed_on`, `mortgage_property_on`, `possession_taken_on`, `emd_deposit`, `emd_deposit_on`, `fifteen_percent_possession`, `fifteen_percent_possession_on`, `full_deposit`, `full_deposit_on`, `over_above`, `forfitted`, `compromise`, `date_of_compromise`, `amount_of_compromise`, `full_compromise_paid_upto`, `ots`, `date_of_ots_accepted`, `amount_of_ots`, `amount_of_ots_paid_upto`, `compromise_ots_failed`, `property_sold_on`, `property_sold_for`, `full_amount_compromise_received_on`, `full_amount_ots_received_on`, `date_of_ra_bill`, `amount_of_ra_bill`, `ra_bill_forward_to_bank_on`, `ra_bill_paid_on`, `ra_bill_paid_amount`, `total_amount_of_expenses_incurred`, `income_case_wise_profit_loss`, `hindi_publication_name`, `english_publication_name`, `approved`, `case_status`) VALUES
(1, '2021-01-07', '2', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', 'Manager', 'ishwar2303@gmail.com', 'Jatin Kumar', '200000000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '0', '0', 0, '0000-00-00', '', '0', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 1),
(2, '2021-01-01', '2', 'IDBI', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', 'Manager', 'ishwar2303@gmail.com', 'Jatin Kumar', '200000000', '2021-01-17', '2021-01-20', '2021-01-09', '2021-01-09', '2021-01-02', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 2),
(3, '2021-01-08', '2', 'IDBI', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', 'Manager', 'ishwar2303@gmail.com', 'Samarth Tandon', '200000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(8, '2021-01-01', '2', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Samarth Tandon', '7573919585', 'Manager', 'samarth@gmail.com', 'Samarth Tandon', '1000000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(9, '2021-01-09', '2', 'ISHWAR BAISLA', 'Mukherjee Nagar', 'Delhi', 'Delhi', 'Shop No G1, G2, G3, G4 Manushri Ansal Building', 'Ishwar Baisla', '9821671707', 'Manager', 'ishwar1999@gmail.com', 'Jatin Kumar', '1000000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(10, '2021-01-08', '2', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', 'Manager', 'ishwar047@gmail.com', 'Samarth Tandon', '1000000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 1),
(11, '2021-01-10', '2', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', 'Manager', 'ishwar1999@gmail.com', 'Ishwar Baisla', '500', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 2),
(13, '2021-01-08', '1', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', '', '', 'Samarth Tandon', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '152222', '', '5452222', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'ishwar baisla', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(14, '2021-01-09', '2', 'IDBI', 'Mukherjee Nagar', 'New Delhi', 'Delhi', '1048, Ground Floor, Banda \r<br/>Bahadur Marg, \r<br/>Mukherjee Nagar, \r<br/>New Delhi, Delhi 110009', 'Ishwar Baisla', '8447811595', '', '', 'Ishwar Baisla', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '100000', '', '520000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2021-01-08', '2021-01-07', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(15, '2021-01-08', '1', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Ishwar Baisla', '7573919585', '', '', 'Ishwar Baisla', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '10000', '', '50000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 1, '0000-00-00', '80000', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(16, '2021-01-10', '3', 'BANK OF BARODA', 'Vijay Nagar', 'Gujarat', 'Delhi', 'Wazirabad Village\r<br/>delhi 110084', 'Ishwar Baisla', '9821671707', '', '', 'Jatin Kumar', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '8500', '', '90000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '15000', '2021-01-01', '8500', '2021-12-31', '50000000', '2018-12-06', '90000', '70000', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(17, '2021-01-09', '3', 'BANK OF BARODA', 'Vijay Nagar', 'Gujarat', 'Delhi', 'Wazirabad Village\r<br/>delhi 110084', 'Ishwar Baisla', '9821671707', '', '', 'Jatin Kumar', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '5000', '', '10000', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2021-01-15', '2021-01-16', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', -1, '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(18, '2021-01-01', '1', 'HDFC', 'Mukherjee Nagar', 'Delhi', 'Wazirabad Village', 'No 1054 A\r<br/>Mukherjee Nagar\r<br/>New Delhi-110009', 'Jatin Kumar', '7573919585', 'Manager', 'jatin@gmail.com', 'Jatin Kumar', '200000000', '2021-01-02', '2021-01-03', '2021-01-04', '2021-01-05', '2021-01-06', '10000', 'asset1\r<br/>asset 2', '5000', '2021-01-07', '2021-01-08', '2021-01-09', '2021-01-10', '2021-01-11', 'Tapas', '2021-01-12', '2021-01-13', '2021-01-14', '2021-01-15', '2021-01-16', '2021-01-17', '2021-01-18', '2021-01-19', '2021-01-20', '5000655', '2021-01-21', '80000', '2021-01-22', '50000', '2021-01-23', '9000', '70000', 1, '2021-01-24', '6000', '3000', 1, '2021-01-25', '4000', '10000', 1, '2021-01-26', '12500', '2021-01-27', '2021-01-28', '2021-01-29', '4500', '2021-01-30', '2021-01-31', '9000', '4500', '2300000', 'Dainik Jagaran', 'Times of India', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `home_loan_comments`
--

CREATE TABLE `home_loan_comments` (
  `comment_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `date_of_next_hearing` date NOT NULL,
  `lease_on` date NOT NULL,
  `physical_possession_on` date NOT NULL,
  `notice_of_physical_possession` date NOT NULL,
  `possession_taken_on` date NOT NULL,
  `possession_postpone_on` date NOT NULL,
  `possession_postpone_reason` varchar(200) NOT NULL,
  `property_on_auction` date NOT NULL,
  `reserve_price` varchar(200) NOT NULL,
  `emd_amount` varchar(200) NOT NULL,
  `property_visit_by_prospective_buyers_on` date NOT NULL,
  `auction_date` varchar(200) NOT NULL,
  `auction_status` tinyint(4) NOT NULL,
  `doc_for_redirection_of_order_given_to_advocate_on` date NOT NULL,
  `redirection_order_filled_with_dm_cmm_on` date NOT NULL,
  `redirection_order_received_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_loan_comments`
--

INSERT INTO `home_loan_comments` (`comment_id`, `case_id`, `date_of_next_hearing`, `lease_on`, `physical_possession_on`, `notice_of_physical_possession`, `possession_taken_on`, `possession_postpone_on`, `possession_postpone_reason`, `property_on_auction`, `reserve_price`, `emd_amount`, `property_visit_by_prospective_buyers_on`, `auction_date`, `auction_status`, `doc_for_redirection_of_order_given_to_advocate_on`, `redirection_order_filled_with_dm_cmm_on`, `redirection_order_received_on`) VALUES
(32, 1, '2021-01-14', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(33, 1, '2021-01-22', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(34, 1, '2021-01-10', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', 0, '0000-00-00', '0000-00-00', '0000-00-00'),
(35, 1, '2021-01-15', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(36, 1, '2021-01-10', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', 1, '0000-00-00', '0000-00-00', '0000-00-00'),
(37, 1, '2021-01-14', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(38, 1, '2021-01-08', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(39, 1, '2021-01-09', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(40, 1, '2021-01-03', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(41, 1, '2021-01-02', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(42, 1, '2021-01-03', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00'),
(43, 2, '2021-01-02', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', -1, '0000-00-00', '0000-00-00', '0000-00-00');

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
(52, 1, '2021-01-31', 'This is a remark');

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
  `operation` tinyint(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`activity_id`, `loan`, `case_id`, `user_id`, `operation`, `timestamp`) VALUES
(1, 1, 1, 21, 1, '2021-01-30 06:06:50'),
(2, 2, 1, 21, 1, '2021-01-30 06:10:33'),
(3, 2, 1, 21, 2, '2021-01-30 06:12:28'),
(4, 2, 1, 21, 2, '2021-01-30 06:18:57'),
(5, 2, 1, 24, 2, '2021-01-30 06:20:09'),
(6, 2, 1, 25, 2, '2021-01-30 06:21:48'),
(7, 1, 1, 25, 2, '2021-01-30 06:21:58'),
(8, 1, 2, 21, 1, '2021-01-30 20:04:16'),
(9, 1, 3, 21, 1, '2021-01-30 20:05:19'),
(14, 1, 8, 21, 1, '2021-01-30 20:21:58'),
(15, 1, 9, 21, 1, '2021-01-30 20:22:41'),
(16, 1, 10, 21, 1, '2021-01-30 20:25:28'),
(17, 1, 11, 21, 1, '2021-01-30 20:27:06'),
(19, 1, 13, 21, 1, '2021-01-30 20:56:03'),
(20, 1, 14, 21, 1, '2021-01-30 21:10:23'),
(21, 1, 15, 21, 1, '2021-01-30 21:30:58'),
(22, 1, 16, 21, 1, '2021-01-30 22:06:06'),
(23, 1, 17, 21, 1, '2021-01-30 22:40:38'),
(24, 1, 18, 21, 1, '2021-01-30 23:03:26');

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
(21, 'Ishwar Baisla', 'aXNod2FyMjMwM0BnbWFpbC5jb20=', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 2, '21-01-29 07:07:19pm'),
(23, 'Tushar', 'dHVzaGFyQGdtYWlsLmNvbQ==', 'OTA2OTU5OTcwOA==', 'VHVzaGFyQDEyMzQ=', 0, 2, '21-01-30 01:22:50pm'),
(24, 'Tapas Baranwal', 'dGFwYXNAZ21haWwuY29t', 'OTgyMTY3MTcwNw==', 'SXNod2FyMjMwM0A=', 0, 0, '21-01-30 04:34:11pm'),
(25, 'Shubham Maurya', 'c2h1YmhhbUBnbWFpbC5jb20=', 'ODQ0NzgxMTU5NQ==', 'SXNod2FyMjMwM0A=', 0, 1, '21-01-30 11:51:26pm');

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
-- Indexes for table `home_loan_comments`
--
ALTER TABLE `home_loan_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `home_loan_remarks`
--
ALTER TABLE `home_loan_remarks`
  ADD PRIMARY KEY (`remark_id`);

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
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `car_loan`
--
ALTER TABLE `car_loan`
  MODIFY `car_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `car_loan_remarks`
--
ALTER TABLE `car_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `home_loan`
--
ALTER TABLE `home_loan`
  MODIFY `home_loan_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `home_loan_comments`
--
ALTER TABLE `home_loan_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `home_loan_remarks`
--
ALTER TABLE `home_loan_remarks`
  MODIFY `remark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `to_do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_registration` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
