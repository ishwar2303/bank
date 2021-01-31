<?php 
    session_start();
    require_once('connection.php');
    require_once('middleware.php');

    if(!isset($_SESSION['user_role'])){ // all access
        $_SESSION['error_msg'] = 'Sign In to view that resource';
        header('Location: login.php');
        exit;
    }

    date_default_timezone_set("Asia/Kolkata");
    $epoch_time = time();
    $timestamp = date("y-m-d h:i:sa", $epoch_time);

    $db_error = '';
    $sql = "SELECT * FROM bank ORDER BY bank_name ASC";
    $bank_list = $conn->query($sql);

    if($conn->error != ''){
        $_SESSION['error_msg'] = 'Something went wrong!';
        $db_error = $conn->error;
    }

    $case_date = '';
    $npa_case = '';
    $bank_name = '';
    $bank_branch = '';
    $bank_state = '';
    $bank_city = '';
    $bank_contact_person_name = '';
    $bank_contact_person_number = '';
    $bank_contact_person_designation = '';
    $bank_address = '';
    $bank_contact_person_email = '';
    $borrower_name = '';
    $amount = '';
    $outstanding = '';
    $ra_agreement_signed_on = '';
    $ra_agreement_expired_on = '';
    $date_of_notice13_2 = '';
    $date_of_notice13_3 = '';
    $primary_security = '';
    $collateral_security = '';
    $total_security = '';
    $date_of_symbolic_possession = '';
    $hindi_publication_name = '';
    $publication_hindu_newspaper = '';
    $english_publication_name = '';
    $publication_english_newspapaer = '';
    $requested_bank_for_documentation_on = '';
    $documents_received_on = '';
    $advocate_name = '';
    $documents_given_to_advocate_on = '';
    $application_file_dm_cmm_advocate_on = '';
    $date_of_hearing = '';
    $order_received_on = '';
    $order_forwarded_to_bank_on = '';
    $lease_on = '';
    $physical_possession_fixed_on = '';
    $mortgaged_property_on = '';
    $possession_taken_on = '';
    $emd_deposit = '';
    $emd_deposit_on = '';
    $fifteen_percent_possession_amount = '';
    $fifteen_percent_possession_on = '';
    $full_deposit = '';
    $full_deposit_on = '';
    $over_above = '';
    $forfitted = '';
    $compromise = '0';
    $date_of_compromise = '';
    $amount_of_compromise = '';
    $full_compromise_paid_upto = '';
    $ots = '0';
    $date_of_ots_accepted = '';
    $ots_amount = '';
    $full_ots_paid_upto = '';
    $compromise_ots_failed = '';
    $property_sold_on = '';
    $property_sold_for = '';
    $full_amount_of_compromise_received_on = '';
    $full_amount_of_ots_received_on = '';
    $date_of_ra_bill = '';
    $amount_of_ra_bill = '';
    $ra_bill_forward_to_bank_on = '';
    $ra_bill_paid_on = '';
    $ra_bill_paid_amount = '';
    $total_amount_of_expenses_incurred = '';
    $income_case_wise_profit_loss = '';
    //errors
    $case_date_error = '';
    $npa_case_error = '';
    $bank_name_error = '';
    $bank_branch_error = '';
    $bank_state_error = '';
    $bank_city_error = '';
    $bank_contact_person_name_error = '';
    $bank_contact_person_number_error = '';
    $bank_contact_person_designation_error = '';
    $bank_address_error = '';
    $bank_contact_person_email_error = '';
    $borrower_name_error = '';
    $amount_error = '';
    $outstanding_error = '';
    $ra_agreement_signed_on_error = '';
    $ra_agreement_expired_on_error = '';
    $date_of_notice13_2_error = '';
    $date_of_notice13_3_error = '';
    $primary_security_error = '';
    $collateral_security_error = '';
    $total_security_error = '';
    $date_of_symbolic_possession_error = '';
    $hindi_publication_name_error = '';
    $publication_hindu_newspaper_error = '';
    $english_publication_name_error = '';
    $publication_english_newspapaer_error = '';
    $requested_bank_for_documentation_on_error = '';
    $documents_received_on_error = '';
    $advocate_name_error = '';
    $documents_given_to_advocate_on_error = '';
    $application_file_dm_cmm_advocate_on_error = '';
    $date_of_hearing_error = '';
    $order_received_on_error = '';
    $order_forwarded_to_bank_on_error = '';
    $lease_on_error = '';
    $physical_possession_fixed_on_error = '';
    $mortgaged_property_on_error = '';
    $possession_taken_on_error = '';
    $emd_deposit_error = '';
    $emd_deposit_on_error = '';
    $fifteen_percent_possession_amount_error = '';
    $fifteen_percent_possession_on_error = '';
    $full_deposit_error = '';
    $full_deposit_on_error = '';
    $over_above_error = '';
    $forfitted_error = '';
    $date_of_compromise_error = '';
    $amount_of_compromise_error = '';
    $full_compromise_paid_upto_error = '';
    $date_of_ots_accepted_error = '';
    $ots_amount_error = '';
    $full_ots_paid_upto_error = '';
    $compromise_ots_failed_error = '';
    $property_sold_on_error = '';
    $property_sold_for_error = '';
    $full_amount_of_compromise_received_on_error = '';
    $full_amount_of_ots_received_on_error = '';
    $date_of_ra_bill_error = '';
    $amount_of_ra_bill_error = '';
    $ra_bill_forward_to_bank_on_error = '';
    $ra_bill_paid_on_error = '';
    $ra_bill_paid_amount_error = '';
    $total_amount_of_expenses_incurred_error = '';
    $income_case_wise_profit_loss_error = '';

    if(isset($_POST['caseDate']) && isset($_POST['npaCase']) && isset($_POST['bankName']) && isset($_POST['bankBranch']) && isset($_POST['bankState']) && isset($_POST['bankCity']) && isset($_POST['bankContactPersonName']) && isset($_POST['bankContactPersonDesignation']) && isset($_POST['bankContactPersonNumber']) && isset($_POST['bankContactPersonEmail']) && isset($_POST['bankAddress']) && isset($_POST['borrowerName']) && isset($_POST['amount']) && isset($_POST['outstanding']) && isset($_POST['raAgreementSignedOn']) && isset($_POST['raAgreementExpiredOn']) && isset($_POST['dateOfNotice132']) && isset($_POST['dateOfNotice133']) && isset($_POST['primarySecurity']) && isset($_POST['collateralSecurity']) && isset($_POST['totalSecurity']) && isset($_POST['dateOfSymbolicPossession']) && isset($_POST['hindiPublicationName']) && isset($_POST['publicationHindiNewspaperOn']) && isset($_POST['englishPublicationName']) && isset($_POST['publicationEnglishNewspaperOn']) && isset($_POST['requestedBankForDocumentsOn']) && isset($_POST['documentsReceivedOn']) && isset($_POST['advocateName']) && isset($_POST['documentsGivenToAdvocate']) && isset($_POST['applicationFileDmCmmByAdvocateOn']) && isset($_POST['dateOfHearing']) && isset($_POST['orderReceivedOn']) && isset($_POST['orderForwardedOn']) && isset($_POST['leaseOn']) && isset($_POST['physicalPossessionFixedOn']) && isset($_POST['mortgagedPropertyOn']) && isset($_POST['possessionTakenOn']) && isset($_POST['emdDeposit']) && isset($_POST['emdDepositOn'])  && isset($_POST['fifteenPercentPossession']) && isset($_POST['fifteenPercentPossessionOn']) && isset($_POST['fullDeposit']) && isset($_POST['fullDepositOn']) && isset($_POST['overAbove'])  && isset($_POST['forfitted']) && isset($_POST['compromise']) && isset($_POST['dateOfCompromise']) && isset($_POST['amountOfCompromise']) && isset($_POST['fullCompromisePaidUpto']) && isset($_POST['ots']) && isset($_POST['dateOfOtsAccepted']) && isset($_POST['otsAmount']) && isset($_POST['fullOtsPaidUpto']) && isset($_POST['propertySoldOn']) && isset($_POST['propertySoldFor']) && isset($_POST['fullAmountCompromiseReceivedOn']) && isset($_POST['fullAmountOtsReceivedOn']) && isset($_POST['dateOfRaBill']) && isset($_POST['amountOfRaBill']) && isset($_POST['raBillForwardToBankOn']) && isset($_POST['raBillPaidOn']) && isset($_POST['raBillPaidAmount']) && isset($_POST['totalAmountOfExpensesIncurred']) && isset($_POST['incomeCaseWiseProfitLoss'])){
        // initialize variables with loan data
        $control = 1;
        $case_date = cleanInput($_POST['caseDate']);
        $npa_case = cleanInput($_POST['npaCase']);
        $bank_name = cleanInput($_POST['bankName']);
        $bank_branch = cleanInput($_POST['bankBranch']);
        $bank_state = cleanInput($_POST['bankState']);
        $bank_city = cleanInput($_POST['bankCity']);
        $bank_contact_person_name = cleanInput($_POST['bankContactPersonName']);
        $bank_contact_person_number = cleanInput($_POST['bankContactPersonNumber']);
        $bank_contact_person_designation = cleanInput($_POST['bankContactPersonDesignation']);
        $bank_address = cleanInput($_POST['bankAddress']);
        $bank_contact_person_email = cleanInput($_POST['bankContactPersonEmail']);
        $borrower_name = cleanInput($_POST['borrowerName']);
        $amount = cleanInput($_POST['amount']);
        $outstanding = cleanInput($_POST['outstanding']);
        $ra_agreement_signed_on = cleanInput($_POST['raAgreementSignedOn']);
        $ra_agreement_expired_on = cleanInput($_POST['raAgreementExpiredOn']);
        $date_of_notice13_2 = cleanInput($_POST['dateOfNotice132']);
        $date_of_notice13_3 = cleanInput($_POST['dateOfNotice133']);
        $primary_security = cleanInput($_POST['primarySecurity']);
        $collateral_security = cleanInput($_POST['collateralSecurity']);
        $total_security = cleanInput($_POST['totalSecurity']);
        $date_of_symbolic_possession = cleanInput($_POST['dateOfSymbolicPossession']);
        $hindi_publication_name = cleanInput($_POST['hindiPublicationName']);
        $publication_hindu_newspaper = cleanInput($_POST['publicationHindiNewspaperOn']);
        $english_publication_name = cleanInput($_POST['englishPublicationName']);
        $publication_english_newspapaer = cleanInput($_POST['publicationEnglishNewspaperOn']);
        $requested_bank_for_documentation_on = cleanInput($_POST['requestedBankForDocumentsOn']);
        $documents_received_on = cleanInput($_POST['documentsReceivedOn']);
        $advocate_name = cleanInput($_POST['advocateName']);
        $documents_given_to_advocate_on = cleanInput($_POST['documentsGivenToAdvocate']);
        $application_file_dm_cmm_advocate_on = cleanInput($_POST['applicationFileDmCmmByAdvocateOn']);
        $date_of_hearing = cleanInput($_POST['dateOfHearing']);
        $order_received_on = cleanInput($_POST['orderReceivedOn']);
        $order_forwarded_to_bank_on = cleanInput($_POST['orderForwardedOn']);
        $lease_on = cleanInput($_POST['leaseOn']);
        $physical_possession_fixed_on = cleanInput($_POST['physicalPossessionFixedOn']);
        $mortgaged_property_on = cleanInput($_POST['mortgagedPropertyOn']);
        $possession_taken_on = cleanInput($_POST['possessionTakenOn']);
        $emd_deposit = cleanInput($_POST['emdDeposit']);
        $emd_deposit_on = cleanInput($_POST['emdDepositOn']);
        $fifteen_percent_possession_amount = cleanInput($_POST['fifteenPercentPossession']);
        $fifteen_percent_possession_on = cleanInput($_POST['fifteenPercentPossessionOn']);
        $full_deposit = cleanInput($_POST['fullDeposit']);
        $full_deposit_on = cleanInput($_POST['fullDepositOn']);
        $over_above = cleanInput($_POST['overAbove']);
        $forfitted = cleanInput($_POST['forfitted']);
        $compromise = cleanInput($_POST['compromise']);
        $date_of_compromise = cleanInput($_POST['dateOfCompromise']);
        $amount_of_compromise = cleanInput($_POST['amountOfCompromise']);
        $full_compromise_paid_upto = cleanInput($_POST['fullCompromisePaidUpto']);
        $ots = cleanInput($_POST['ots']);
        $date_of_ots_accepted = cleanInput($_POST['dateOfOtsAccepted']);
        $ots_amount = cleanInput($_POST['otsAmount']);
        $full_ots_paid_upto = cleanInput($_POST['fullOtsPaidUpto']);
        if(isset($_POST['compromiseOtsFailed'])){
            $compromise_ots_failed = cleanInput($_POST['compromiseOtsFailed']);
        }
        else{
            $compromise_ots_failed = '-1';
        }

        $property_sold_on = cleanInput($_POST['propertySoldOn']);
        $property_sold_for = cleanInput($_POST['propertySoldFor']);
        $full_amount_of_compromise_received_on = cleanInput($_POST['fullAmountCompromiseReceivedOn']);
        $full_amount_of_ots_received_on = cleanInput($_POST['fullAmountOtsReceivedOn']);
        $date_of_ra_bill = cleanInput($_POST['dateOfRaBill']);
        $amount_of_ra_bill = cleanInput($_POST['amountOfRaBill']);
        $ra_bill_forward_to_bank_on = cleanInput($_POST['raBillForwardToBankOn']);
        $ra_bill_paid_on = cleanInput($_POST['raBillPaidOn']);
        $ra_bill_paid_amount = cleanInput($_POST['raBillPaidAmount']);
        $total_amount_of_expenses_incurred = cleanInput($_POST['totalAmountOfExpensesIncurred']);
        $income_case_wise_profit_loss = cleanInput($_POST['incomeCaseWiseProfitLoss']);


        if(!empty($case_date)){
            if(!dateValidation($case_date)){
                $case_date_error = 'Invalid Date';
                $control = 0;
            }
        }
        else{
            $case_date_error = 'Required';
            $control = 0;
        }
        
        if($npa_case != '1' && $npa_case != '2' && $npa_case != '3'){
            $npa_case_error = 'Invalid npa code';
            $control = 0;
        }
        else{
            if($npa_case == '1'){
                $npa_case_value = 'Upto Rs 20 Lac';
            }
            
            if($npa_case == '2')
                $npa_case_value = 'From Rs. 20 Lac + to Rs. 10 Crore';

            if($npa_case == '3')
                $npa_case_value = 'Over 10 Crore';
        }

        if(!empty($bank_name)){
            if(!alphaSpaceValidation($bank_name)){
                $bank_name_error = 'Invalid Name';
                $control = 0;
            }
            else{
              $bank_name = strtoupper($bank_name);
            }
        }
        else{
            $bank_name_error = 'Required';
            $control = 0;
        }

        if(!empty($bank_branch)){
            if(!alphaSpaceValidation($bank_branch)){
                $bank_branch_error = 'Invalid name';
                $control = 0;
            }
        }
        // else{
        //     $bank_branch_error = 'Branch name required';
        //     $control = 0;
        // }
        
        if(!empty($bank_state)){
          if(!alphaSpaceValidation($bank_state)){
              $bank_state_error = 'Invalid state name';
              $control = 0;
          }
        }
        // else{
        //     $bank_state_error = 'State required';
        //     $control = 0;
        // }

        if(!empty($bank_city)){
            if(!alphaSpaceValidation($bank_city)){
                $bank_city_error = 'Invalid name';
                $control = 0;
            }
        }
        // else{
        //     $bank_city_error = 'City required';
        //     $control = 0;
        // }

        if(!empty($bank_contact_person_name)){
            if(!alphaSpaceValidation($bank_contact_person_name)){
                $bank_contact_person_name_error = 'Invalid Name';
                $control = 0;
            }
        }
        // else{
        //     $bank_contact_person_name_error = 'Required';
        //     $control = 0;
        // }
        
        if(!empty($bank_contact_person_designation)){
            if(!alphaSpaceValidation($bank_contact_person_designation)){
                $bank_contact_person_designation_error = 'Invalid Name';
                $control = 0;
            }
        }
        // else{
        //     $bank_contact_person_designation_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($bank_contact_person_number)){
            if(!contactValidation($bank_contact_person_number)){
                $bank_contact_person_number_error = 'Invalid contact';
                $control = 0;
            }
        }
        // else{
        //     $bank_contact_person_number_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($bank_contact_person_email)){
            if(!emailValidation($bank_contact_person_email)){
                $bank_contact_person_email_error = 'Invalid E-mail';
                $control = 0;
            }
        }
        // else{
        //     $bank_contact_person_email_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($bank_address)){
            if(!addressValidation($bank_address)){
                $bank_address_error = 'Invalid address';
                $control = 0;
            }
        }
        // else{
        //     $bank_address_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($borrower_name)){
            if(!alphaSpaceValidation($borrower_name)){
                $borrower_name_error = 'Invalid Name';
                $control = 0;
            }
        }
        else{
            $borrower_name_error = 'Required';
            $control = 0;
        }

        if($amount != ''){
            if(!amountValidation($amount)){
                $amount_error = 'Invalid Amount';
                $control = 0;
            }
        }
        // else{
        //     $amount_error = 'Required';
        //     $control = 0;
        // }

        if($outstanding != ''){
            if(!dateValidation($outstanding)){
                $outstanding_error = 'Invalid date';
                $control = 0;
            }
        }
        // else{
        //     $outstanding_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($ra_agreement_signed_on)){
            if(!dateValidation($ra_agreement_signed_on)){
                $ra_agreement_signed_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $ra_agreement_signed_on_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($ra_agreement_expired_on)){
            if(!dateValidation($ra_agreement_expired_on)){
                $ra_agreement_expired_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $ra_agreement_expired_on_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($date_of_notice13_2)){
            if(!dateValidation($date_of_notice13_2)){
                $date_of_notice13_2_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $date_of_notice13_2_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($date_of_notice13_3)){
            if(!dateValidation($date_of_notice13_3)){
                $date_of_notice13_3_error = 'Invalid Date';
                $control = 0;
            }
        }

        if($primary_security != ''){
            if(!amountValidation($primary_security)){
                $primary_security_error = 'Invalid amount';
                $control = 0;
            }
        }
        else{
            $primary_security_error = 'Required';
            $control = 0; 
        }

        if($total_security != ''){
            if(!amountValidation($total_security)){
                $total_security_error = 'Invalid amount';
                $control = 0;
            }
        }
        else{
            $total_security_error = 'Required';
            $control = 0; 
        }

        if(!empty($date_of_symbolic_possession)){
            if(!dateValidation($date_of_symbolic_possession)){
                $date_of_symbolic_possession_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $date_of_symbolic_possession_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($hindi_publication_name)){
            if(!alphaSpaceValidation($hindi_publication_name)){
                $hindi_publication_name_error = 'Invalid name';
                $control = 0;
            }
        }
        // else{
        //     $hindi_publication_name_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($publication_hindu_newspaper)){
            if(!dateValidation($publication_hindu_newspaper)){
                $publication_hindu_newspaper_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $publication_hindu_newspaper_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($english_publication_name)){
            if(!alphaSpaceValidation($english_publication_name)){
                $english_publication_name_error = 'Invalid name';
                $control = 0;
            }
        }
        // else{
        //     $english_publication_name_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($publication_english_newspapaer)){
            if(!dateValidation($publication_english_newspapaer)){
                $publication_english_newspapaer_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $publication_english_newspapaer_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($requested_bank_for_documentation_on)){
            if(!dateValidation($requested_bank_for_documentation_on)){
                $requested_bank_for_documentation_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $requested_bank_for_documentation_on_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($documents_received_on)){
            if(!dateValidation($documents_received_on)){
                $documents_received_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $documents_received_on_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($documents_given_to_advocate_on)){
            if(!dateValidation($documents_given_to_advocate_on)){
                $documents_given_to_advocate_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $documents_given_to_advocate_on_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($application_file_dm_cmm_advocate_on)){
            if(!dateValidation($application_file_dm_cmm_advocate_on)){
                $application_file_dm_cmm_advocate_on_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $application_file_dm_cmm_advocate_on_error = 'Required';
        //     $control = 0;
        // }

        if(!empty($date_of_hearing)){
            if(!dateValidation($date_of_hearing)){
                $date_of_hearing_error = 'Invalid Date';
                $control = 0;
            }
        }
        // else{
        //     $date_of_hearing_error = 'Required';
        //     $control = 0;
        // }

        // compromise
        if($compromise == '1'){
            if(!empty($date_of_compromise)){
                if(!dateValidation($date_of_compromise)){
                    $date_of_compromise_error = 'Invalid Date';
                    $control = 0;
                }
            }
            // else{
            //     $date_of_compromise_error = 'Required';
            //     $control = 0;
            // }

            if($amount_of_compromise != ''){
                if(!amountValidation($amount_of_compromise)){
                    $amount_of_compromise_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            else{
                $amount_of_compromise_error = 'Required';
                $control = 0;
            }

            if($full_compromise_paid_upto != ''){
                if(!dateValidation($full_compromise_paid_upto)){
                    $full_compromise_paid_upto_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            // else{
            //     $full_compromise_paid_upto_error = 'Required';
            //     $control = 0;
            // }
        }

        //ots
        if($ots == '1'){
            if(!empty($date_of_ots_accepted)){
                if(!dateValidation($date_of_ots_accepted)){
                    $date_of_ots_accepted_error = 'Invalid Date';
                    $control = 0;
                }
            }
            // else{
            //     $date_of_ots_accepted_error = 'Required';
            //     $control = 0;
            // }

            if($ots_amount != ''){
                if(!amountValidation($ots_amount)){
                    $ots_amount_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            else{
                $ots_amount_error = 'Required';
                $control = 0;
            }

            if($full_ots_paid_upto != ''){
                if(!amountValidation($full_ots_paid_upto)){
                    $full_ots_paid_upto_error = 'Invalid Amount';
                    $control = 0;
                }
            }
            // else{
            //     $full_ots_paid_upto_error = 'Required';
            //     $control = 0;
            // }

            if($compromise_ots_failed != ''){
                if($compromise_ots_failed != '1' && $compromise_ots_failed != '0' && $compromise_ots_failed != '-1'){
                    $compromise_ots_failed_error = 'Invalid';
                    $control = 0;
                }
            }
            // else{
            //     $compromise_ots_failed_error = 'Required';
            //     $control = 0;
            // }
        }

        if($control){ // Insert data into database control = 1
            $bank_address = str_replace("\n", "<br/>", $bank_address);
            $collateral_security = str_replace("\n", "<br/>", $collateral_security);
            $sql = "INSERT INTO `home_loan` (`home_loan_cid`, `case_date`, `npa_case`, `bank_name`, `bank_branch`, `bank_state`, `bank_city`, `bank_address`, `bank_contact_person_name`, `bank_contact_person_number`, `bank_contact_person_designation`, `bank_contact_person_email`, `borrower_name`, `amount`, `outstanding`, `ra_agreement_signed_on`, `ra_agreement_expired_on`, `date_of_notice13_2`, `date_of_notice13_3`, `primary_security`, `collateral_security`, `total_security`, `date_of_symbolic_possession`, `publication_hindi_newspaper_on`, `publication_english_newspaper_on`, `requested_bank_for_documents`, `documents_received_on`, `advocate_name`,  `documents_given_to_advocate_on`, `application_file_dm_cmm_by_advocate_on`, `date_of_hearing`, `order_received_on`, `order_forwarded_to_bank_on`, `lease_on`, `physical_possession_fixed_on`, `mortgage_property_on`, `possession_taken_on`, `emd_deposit`, `emd_deposit_on`,  `fifteen_percent_possession`, `fifteen_percent_possession_on`, `full_deposit`, `full_deposit_on`, `over_above`, `forfitted`, `compromise`, `date_of_compromise`, `amount_of_compromise`, `full_compromise_paid_upto`, `ots`, `date_of_ots_accepted`, `amount_of_ots`, `amount_of_ots_paid_upto`, `compromise_ots_failed`, `property_sold_on`, `property_sold_for`, `full_amount_compromise_received_on`, `full_amount_ots_received_on`, `date_of_ra_bill`, `amount_of_ra_bill`, `ra_bill_forward_to_bank_on`, `ra_bill_paid_on`, `ra_bill_paid_amount`, `total_amount_of_expenses_incurred`, `income_case_wise_profit_loss`, `hindi_publication_name`, `english_publication_name`, `approved`, `case_status`) VALUES (NULL, '$case_date', '$npa_case', '$bank_name', '$bank_branch', '$bank_state', '$bank_city', '$bank_address', '$bank_contact_person_name', '$bank_contact_person_number', '$bank_contact_person_designation', '$bank_contact_person_email', '$borrower_name', '$amount', '$outstanding', '$ra_agreement_signed_on', '$ra_agreement_expired_on', '$date_of_notice13_2', '$date_of_notice13_3', '$primary_security', '$collateral_security', '$total_security', '$date_of_symbolic_possession', '$publication_hindu_newspaper', '$publication_english_newspapaer', '$requested_bank_for_documentation_on', '$documents_received_on', '$advocate_name', '$documents_given_to_advocate_on', '$application_file_dm_cmm_advocate_on', '$date_of_hearing', '$order_received_on', '$order_forwarded_to_bank_on', '$lease_on', '$physical_possession_fixed_on', '$mortgaged_property_on', '$possession_taken_on', '$emd_deposit', '$emd_deposit_on', '$fifteen_percent_possession_amount', '$fifteen_percent_possession_on', '$full_deposit', '$full_deposit_on', '$over_above', '$forfitted', '$compromise', '$date_of_compromise', '$amount_of_compromise', '$full_compromise_paid_upto', '$ots', '$date_of_ots_accepted', '$ots_amount', '$full_ots_paid_upto', '$compromise_ots_failed', '$property_sold_on', '$property_sold_for', '$full_amount_of_compromise_received_on', '$full_amount_of_ots_received_on', '$date_of_ra_bill', '$amount_of_ra_bill', '$ra_bill_forward_to_bank_on', '$ra_bill_paid_on', '$ra_bill_paid_amount', '$total_amount_of_expenses_incurred', '$income_case_wise_profit_loss', '$hindi_publication_name', '$english_publication_name', '0', '0')";
            if($conn->query($sql) === TRUE){ 
                $case_id = $conn->insert_id;
                $sql = "INSERT INTO `user_activity` (`activity_id`, `loan`, `case_id`, `user_id`, `operation`, `timestamp`) VALUES (NULL, '1', '$case_id', '$_SESSION[user_id]', '1', '$timestamp')";
                $conn->query($sql);
                $_SESSION['success_msg'] = 'Case created successfully';
                header('Location: home-loan.php');
                exit; 
            }
            else{
                $_SESSION['error_msg'] = $conn->error;
            }
            
        }
        else{
            $_SESSION['note_msg'] = 'Fill required fields and make sure they are valid';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'includes/layout.php'; ?>
    <script src="assets/js/home-loan.js"></script>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php require 'includes/dashboard-header.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require 'includes/side-navigation.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Home Loan</h4>
            
                
                    <!-- Flash Message  -->
                    <?php require 'includes/flash-message.php'; ?>

                    <!-- Home loan form -->
                    <form class="pt-3" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Case Date</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="case-date" type="date" class="form-control form-input" name="caseDate"  value="<?php  ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $case_date_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('case-date').defaultValue = '<?php echo $case_date; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">NPA Cases</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-university"></i>
                                        </span>
                                    </div>
                                    <select class="form-control form-input" name="npaCase" >
                                        <option selectecd>Choose</option>
                                        <option value="1" <?php if($npa_case == '1') echo 'Selected'; ?>>New NPA Cases upto Rs 20 Lac</option>
                                        <option value="2" <?php if($npa_case == '2') echo 'Selected'; ?>>New NPA Cases From Rs. 20 Lac + to Rs. 10 Crore</option>
                                        <option value="3" <?php if($npa_case == '3') echo 'Selected'; ?>>New NPA Cases Over 10 Crore</option>
                                    </select>
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $npa_case_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bank-list -->
                        <?php if($bank_list->num_rows > 0){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Select from listed Banks</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-university"></i>
                                        </span>
                                    </div>
                                    <select id="bank-list" class="form-control form-input">
                                        <option value="-1" selected>Choose</option>
                                        <?php 
                                            while($bank = $bank_list->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo base64_encode($bank['bank_id']); ?>"><?php echo $bank['bank_name']; ?>&nbsp;(<?php echo $bank['bank_branch']; ?>)&nbsp;[<?php echo $bank['bank_contact_person_name']; ?>]</option>
                                                <?php 
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <script>
                            $(document).ready(() => {
                                $('#bank-list').on('change', () => {
                                    bank_id = $('#bank-list').val()
                                    if(bank_id != '-1'){
                                        let url = 'retrieve-bank-information.php'
                                        let reqData = {
                                            bank_id
                                        }
                                        $.ajax({
                                            url,
                                            type : 'POST',
                                            dataType : 'html',
                                            success : (msg) => {
                                            },
                                            complete : (res) => {
                                                setDetailsInHomeLoanForm(res.responseText)
                                            },
                                            data : reqData
                                        })
                                    }
                                })

                                function setDetailsInHomeLoanForm(resData){
                                
                                    resData = JSON.parse(resData)
                                    if(resData.success){
                                        let bankName = resData.bank.bank_name
                                        let branchName = resData.bank.bank_branch
                                        let bankCity = resData.bank.bank_city
                                        let bankState = resData.bank.bank_state
                                        let bankAddress = resData.bank.bank_address
                                        let personName = resData.bank.bank_contact_person_name
                                        let personNumber = resData.bank.bank_contact_person_number
                                        document.getElementById('bank-name').value = bankName
                                        document.getElementById('bank-address').value = bankAddress.replace(/<br\/>/g, "\n").trim()
                                        document.getElementById('bank-person-name').value = personName
                                        if(personNumber != '0')
                                            document.getElementById('bank-person-number').value = personNumber
                                        else document.getElementById('bank-person-number').value = ''

                                        document.getElementById('branch-name').value = branchName
                                        document.getElementById('bank-city').value = bankCity
                                        document.getElementById('bank-state').value = bankState
                                    }
                                    if(resData.error){
                                        alert(`Error : ${resData.error}`)
                                    }

                                }
                            })
                        </script>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-university"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-input" id="bank-name" name="bankName" placeholder="Name" value="<?php echo $bank_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_name_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Branch Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-code-branch"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-input" id="branch-name" name="bankBranch" value="<?php echo $bank_branch; ?>" placeholder="Branch Name">
                                    </div>
                                    <div  class="form-input-response">
                                        <?php echo $bank_branch_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Bank State</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fab fa-stripe-s"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" id="bank-state" name="bankState" value="<?php echo $bank_state; ?>" placeholder="State">
                            </div>
                            <div  class="form-input-response">
                                <?php echo $bank_state_error; ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="exampleInputCity1">Bank City</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-primary text-white br"><i class="fa fa-map-marker-alt"></i></span>
                              </div>
                              <input type="text" class="form-control form-input" id="bank-city" name="bankCity" value="<?php echo $bank_city; ?>" placeholder="City Name">
                            </div>
                            <div class="form-input-response">
                                <?php echo $bank_city_error; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-input" id="bank-person-name" name="bankContactPersonName" placeholder="Name" value="<?php echo $bank_contact_person_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_name_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person Designation</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-dot-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-input" id="" name="bankContactPersonDesignation" placeholder="Designation" value="<?php echo $bank_contact_person_designation; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_designation_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person Number</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control form-input" id="bank-person-number" name="bankContactPersonNumber" placeholder="Number" value="<?php echo $bank_contact_person_number; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_number_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Contact Person E-mail</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input  type="email" name="bankContactPersonEmail" value="<?php echo $bank_contact_person_email; ?>" placeholder="E-mail" class="form-control form-input">
                                    </div>   
                                    <div class="form-input-response">
                                        <?php echo $bank_contact_person_email_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Bank Address</label>
                                    <div class="input-group">
                                    <textarea class="form-control form-input" name="bankAddress" id="bank-address" cols="30" rows="5"><?php echo $bank_address; ?></textarea>
                                    </div>
                                    <div  class="form-input-response">
                                        <?php echo $bank_address_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Borrower Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text"  class="form-control form-input" id="" name="borrowerName" placeholder="Name" value="<?php echo $borrower_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $borrower_name_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="text" step="0.000001" class="form-control form-input"  name="amount" placeholder="Number" value="<?php echo $amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Outstanding</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date"  id="outstanding-on" class="form-control form-input" name="outstanding"  value="<?php echo $outstanding; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $outstanding_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('outstanding-on').defaultValue = '<?php echo $outstanding; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA agreement signed on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-signed" type="date" class="form-control form-input" name="raAgreementSignedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_signed_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-signed').defaultValue = '<?php echo $ra_agreement_signed_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA agreement expired on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="ra-agreement-expired" type="date" class="form-control form-input" name="raAgreementExpiredOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_agreement_expired_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-agreement-expired').defaultValue = '<?php echo $ra_agreement_expired_on; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of Notice 13(2)</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-notice13-2" name="dateOfNotice132">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_notice13_2_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-notice13-2').defaultValue = '<?php echo $date_of_notice13_2; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of Notice 13(3) If applicable</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-notice13-3" name="dateOfNotice133">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_notice13_3_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-notice13-3').defaultValue = '<?php echo $date_of_notice13_3; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Primary Security</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input" id="date-of-notice13-3"  name="primarySecurity" value="<?php echo $primary_security; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $primary_security_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Collateral Security</label>
                                    <div class="input-group">
                                    <textarea class="form-control form-input" name="collateralSecurity" id="" cols="30" rows="5"><?php echo $collateral_security; ?></textarea>
                                    </div>
                                    <div  class="form-input-response">
                                        <?php echo $collateral_security_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Total Security</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input" id="date-of-notice13-3"  name="totalSecurity" value="<?php echo $total_security; ?>">
                                    </div>
                                    <div  class="form-input-response">
                                        <?php echo $total_security_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of Symbolic Possession u/s 13(4)</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="symbolic-possession-date" name="dateOfSymbolicPossession">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_symbolic_possession_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('symbolic-possession-date').defaultValue = '<?php echo $date_of_symbolic_possession; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Hindi Publication Name</label>
                                    <div class="input-group">
                                    <input type="text" class="form-control form-input"  name="hindiPublicationName" value="<?php echo $hindi_publication_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $hindi_publication_name_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Publication in Hindi Newspaper on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="hindi-newspaper" name="publicationHindiNewspaperOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $publication_hindu_newspaper_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('hindi-newspaper').defaultValue = '<?php echo $publication_hindu_newspaper; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">English Publication Name</label>
                                    <div class="input-group">
                                    <input type="text" class="form-control form-input"  name="englishPublicationName" value="<?php echo $english_publication_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $english_publication_name_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Publication in English Newspaper on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="english-newspaper" name="publicationEnglishNewspaperOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $publication_english_newspapaer_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('english-newspaper').defaultValue = '<?php echo $publication_english_newspapaer; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Requested Bank to Provide full set of Documents</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="requested-documents-on" name="requestedBankForDocumentsOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $requested_bank_for_documentation_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('requested-documents-on').defaultValue = '<?php echo $requested_bank_for_documentation_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full set of Documents received on </label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="documents-received-on" name="documentsReceivedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $documents_received_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('documents-received-on').defaultValue = '<?php echo $documents_received_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Advocate Name</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-input" name="advocateName" value="<?php echo $advocate_name; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $advocate_name_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Documents given to advocte for filling appliation u/s 14 on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="documents-to-advocate" name="documentsGivenToAdvocate">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $documents_given_to_advocate_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('documents-to-advocate').defaultValue = '<?php echo $documents_given_to_advocate_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Application file with DM/CMM by Advocate on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="application-dm-cmm" name="applicationFileDmCmmByAdvocateOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $application_file_dm_cmm_advocate_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('application-dm-cmm').defaultValue = '<?php echo $application_file_dm_cmm_advocate_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date Of hearing</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-hearing" name="dateOfHearing">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_hearing_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-hearing').defaultValue = '<?php echo $date_of_hearing; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Order u/s 14 Received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="order-received-on" type="date" class="form-control form-input" name="orderReceivedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $order_received_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('order-received-on').defaultValue = '<?php echo $order_received_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Order u/s Forwarded to Bank</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="order-forwarded-on" type="date" class="form-control form-input" name="orderForwardedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $order_forwarded_to_bank_on_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Lease with Court Receiver/Tehsildar/SSP on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="lease-on" type="date" class="form-control form-input" name="leaseOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $lease_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('lease-on').defaultValue = '<?php echo $lease_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of  Physical Possession  fixed on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="physical-possession-fixed-on" type="date" class="form-control form-input" name="physicalPossessionFixedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $physical_possession_fixed_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('physical-possession-fixed-on').defaultValue = '<?php echo $physical_possession_fixed_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Mortgaged Property on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="mortgaged-property-on" type="date" class="form-control form-input" name="mortgagedPropertyOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $mortgaged_property_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('mortgaged-property-on').defaultValue = '<?php echo $mortgaged_property_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Possession taken on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="possession-taken-on" type="date" class="form-control form-input" name="possessionTakenOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $possession_taken_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('possession-taken-on').defaultValue = '<?php echo $possession_taken_on; ?>'
                                </script>
                            </div>
                        </div>

                        <!-- EMD -->
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">EMD Deposit</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input  type="number" step="0.000001" class="form-control form-input" name="emdDeposit" value="<?php echo $emd_deposit; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $emd_deposit_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">EMD Deposit on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="emd-deposit-on" type="date" class="form-control form-input" name="emdDepositOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $emd_deposit_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('emd-deposit-on').defaultValue = '<?php echo $emd_deposit_on; ?>'
                                </script>
                            </div>
                        </div>
                        
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">15% Of Possession</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input  type="number" step="0.000001" class="form-control form-input" name="fifteenPercentPossession" value="<?php echo $fifteen_percent_possession_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $fifteen_percent_possession_amount_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">15% Of Possession on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="percent-possession-on" type="date" class="form-control form-input" name="fifteenPercentPossessionOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $fifteen_percent_possession_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('percent-possession-on').defaultValue = '<?php echo $fifteen_percent_possession_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full Deposit</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input  type="number" step="0.000001" class="form-control form-input" name="fullDeposit" value="<?php echo $full_deposit; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_deposit_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full Deposit On</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input id="full-deposit-on" type="date" class="form-control form-input" name="fullDepositOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_deposit_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('full-deposit-on').defaultValue = '<?php echo $full_deposit_on; ?>'
                                </script>
                            </div>
                        </div>
                        <div class="form-group postpone-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Over above</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input  type="number" step="0.000001" class="form-control form-input" name="overAbove" value="<?php echo $over_above; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $over_above_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Forfitted</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input  type="number" step="0.000001" class="form-control form-input" name="forfitted" value="<?php echo $forfitted; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $forfitted_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- if compromise -->
                        
                        <h4 class="form-part-heading mb-3">If Compromise</h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="exampleInputCity1">Compromise</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input type="radio" name="compromise" value="1" <?php if($compromise == '1') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-check radio-check-icon"></i>
                                                Yes
                                            </span>
                                        </label>
                                        <label>
                                        <input type="radio" name="compromise" value="0" <?php if($compromise == '0') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-close radio-cross-icon"></i>
                                                No
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group compromise-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of Compromise</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-compromise" name="dateOfCompromise">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_compromise_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-compromise').defaultValue = '<?php echo $date_of_compromise; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount of compromise</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="amountOfCompromise" placeholder="Amount" value="<?php echo $amount_of_compromise; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_of_compromise_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group compromise-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full Compromise paid upto</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="fullCompromisePaidUpto" placeholder="Amount" value="<?php echo $full_compromise_paid_upto; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_compromise_paid_upto_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- if OTS -->

                        <h4 class="form-part-heading mb-3">If OTS</h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="exampleInputCity1">OTS</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input type="radio" name="ots" value="1" <?php if($ots == '1') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-check radio-check-icon"></i>
                                                Yes
                                            </span>
                                        </label>
                                        <label>
                                        <input type="radio" name="ots" value="0" <?php if($ots == '0') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-close radio-cross-icon"></i>
                                                No
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ots-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date of OTS accepted</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-ots-accepted" name="dateOfOtsAccepted">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_ots_accepted_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-ots-accepted').defaultValue = '<?php echo $date_of_ots_accepted; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount of OTS</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="otsAmount" placeholder="Amount" value="<?php echo $ots_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ots_amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ots-part">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full amount of OTS paid upto</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="fullOtsPaidUpto" placeholder="Amount" value="<?php echo $full_ots_paid_upto; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_ots_paid_upto_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Compromise OTS Failed</label>
                                    <div class="radio-inputs">
                                        <label>
                                            <input type="radio" name="compromiseOtsFailed" value="1" <?php if($compromise_ots_failed == '1') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-check radio-check-icon"></i>
                                                Yes
                                            </span>
                                        </label>
                                        <label>
                                        <input type="radio" name="compromiseOtsFailed" value="0" <?php if($compromise_ots_failed == '0') echo 'checked'; ?>>
                                            <span>
                                                <i class="fa fa-close radio-cross-icon"></i>
                                                No
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $compromise_ots_failed_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Property Sold On</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="property-sold-on" name="propertySoldOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $property_sold_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('property-sold-on').defaultValue = '<?php echo $property_sold_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Property Sold for</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="propertySoldFor" placeholder="Amount" value="<?php echo $property_sold_for; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $property_sold_for_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full amount of compromise received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="full-amount-of-compromise-received-on" name="fullAmountCompromiseReceivedOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_amount_of_compromise_received_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('full-amount-of-compromise-received-on').defaultValue = '<?php echo $full_amount_of_compromise_received_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Full amount of ots received on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="full-amount-of-ots-received-on" name="fullAmountOtsReceivedOn" >
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $full_amount_of_ots_received_on_error; ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById('full-amount-of-ots-received-on').defaultValue = '<?php echo $full_amount_of_ots_received_on; ?>'
                            </script>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Date Of RA Bill</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="date-of-ra-bill" name="dateOfRaBill">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $date_of_ra_bill_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('date-of-ra-bill').defaultValue = '<?php echo $date_of_ra_bill; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Amount of RA Bill</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step=".01" class="form-control form-input" name="amountOfRaBill" placeholder="Amount" value="<?php echo $amount_of_ra_bill; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $amount_of_ra_bill_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA Bill forward to Bank on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="ra-bill-forward-to-bank-on" name="raBillForwardToBankOn">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_bill_forward_to_bank_on_error; ?>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('ra-bill-forward-to-bank-on').defaultValue = '<?php echo $ra_bill_forward_to_bank_on; ?>'
                                </script>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA Bill paid on</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-input" id="ra-bill-paid-on" name="raBillPaidOn" >
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_bill_paid_on_error; ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById('ra-bill-paid-on').defaultValue = '<?php echo $ra_bill_paid_on; ?>'
                            </script>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">RA Bill paid amount</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input" name="raBillPaidAmount" placeholder="Amount" value="<?php echo $ra_bill_paid_amount; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $ra_bill_paid_amount_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Total amount of expenses incurred</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input" name="totalAmountOfExpensesIncurred" placeholder="Amount" value="<?php echo $total_amount_of_expenses_incurred; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $total_amount_of_expenses_incurred_error; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputCity1">Income case wise profit/loss</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-gradient-primary text-white br">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" step="0.000001" class="form-control form-input" name="incomeCaseWiseProfitLoss" value="<?php echo $income_case_wise_profit_loss; ?>">
                                    </div>
                                    <div class="form-input-response">
                                        <?php echo $income_case_wise_profit_loss_error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 form-inline justify-content-end">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Create</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <!-- <footer class="footer">
          </footer> -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<?php 
    $conn->close();
?>

<script>
    compromise = document.getElementsByName('compromise')
    for(i = 0; i<compromise.length; i++){
        compromise[i].addEventListener('click', compromiseFields)
    }
</script>
<?php if($compromise != ''){?>
    <script>compromiseFields()</script>
<?php } ?>


<script>
    ots = document.getElementsByName('ots')
    for(i = 0; i<ots.length; i++){
        ots[i].addEventListener('click', otsFields)
    }
</script>
<?php if($ots != ''){?>
    <script>otsFields()</script>
<?php } ?>