<?php  
    session_start();
    require_once('connection.php');

    date_default_timezone_set("Asia/Kolkata");
    $epoch_time = time();
    $timestamp = date("y-m-d h:i:sa", $epoch_time);
    $current_date = new DateTime($timestamp);
    $current_date = $current_date->format('d-m-Y');
    require_once('middleware.php');

    if(!isset($_SESSION['print-home-loan-report'])){
        $_SESSION['error_msg'] = 'Something went wrong!';
        header('Location: index.php');
        exit;
    }

    $home_loan_case_id = $_SESSION['print-home-loan-report'];
    $result_array = array();
    foreach($home_loan_case_id as $cid){
        $sql = "SELECT * FROM home_loan WHERE home_loan_cid = '$cid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $bank_name = $row['bank_name'];
        array_push($result_array, $row);
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'includes/layout.php'; ?>
    <title>Home Loan Report</title>
</head>
<body>
    <div class="print-header">
        <a class="navbar-brand brand-logo" href="index.php">
            <h3 class="logo-container form-inline mb-0">
                <span style=" font-size:18px;">Asset Reconservices</span>
            </h3>
        </a>
        <div class="print-header-right-options">
            <button id="print-report-btn" class="btn btn-primary btn-setting mr-3">
                <i class="mdi mdi-printer mr-1"></i>
                Print
            </button>
            <!-- <button id="reset-btn" class="btn btn-primary mr-3">
                <i class="fas fa-redo-alt"></i>
                Reset
            </button>
            <button id="customize-report" class="btn btn-primary">
                <i class="fas fa-filter"></i>
                Customize Report
                <div class="checkbox-container report-options">
                    <label>
                        <span class="checkbox-icon-container">
                            <i class='mdi mdi-check icon-mr-5'></i>
                        </span>
                        <span class="checkbox-label">
                            Completed
                        </span>
                        <span class="checkbox-input-container">
                            <input onclick="caseStatusWise()" type="checkbox" name="caseCompleted" checked>
                        </span>
                    </label>
                    <label>
                        <span class="checkbox-icon-container">
                            <i class='fas fa-spinner fa-spin icon-mr-5'></i>
                        </span>
                        <span class="checkbox-label">
                            InProgress
                        </span>
                        <span class="checkbox-input-container">
                            <input onclick="caseStatusWise()" type="checkbox" name="caseInProgress" checked>
                        </span>
                    </label>
                    <label>
                        <span class="checkbox-icon-container">
                            <i class='mdi mdi-exclamation icon-mr-5'></i>
                        </span>
                        <span class="checkbox-label">
                            Withdraw
                        </span>
                        <span class="checkbox-input-container">
                            <input onclick="caseStatusWise()" type="checkbox" name="caseWithdraw" checked>
                        </span>
                    </label>
                </div>
            </button> -->
        </div>
        
    </div>
    <div class="print-header-cover-space"></div>
    <div class="print-report-content">
        <div class="from-and-date mb-3">
            <div class="report-from">
                <span>From</span>
                <div>
                    <span class="mk-bold">ASSET RECONSERVICES INDIA PVT. LTD.</span><br/>
                    Khasra No. 354, 1st Floor,<br/>
                    100 Foots Road,<br/>
                    Near Easy Engineering Center,<br/>
                    Jagat Complex Ghitorni,<br/>
                    New Delhi - 110030
                </div>
            </div>
            <div class="report-date">
                <div>Dated : <?php echo $current_date; ?></div>
                <div>E-mail : assetreconservices@gmail.com</div>
            </div>
        </div>
        <div class="report-to mb-3">
            <div>
                <span>To</span>
                <div>
                    <div>
                        <span id="report-to-bank" class="mk-bold mr-2">TO ANNUAL GENERAL MANAGER</span>
                        <input type="text" id="input-report-to-bank" class="mr-2 form-input set-input-style mb-2" value="TO ANNUAL GENERAL MANAGER">
                        <span id="edit-report-to-bank" class="blue-color"><i class="fas fa-pen-alt"></i> Edit</span>
                        <span id="update-report-to-bank" class="blue-color"><i class="fas fa-save"></i> Save</span><br/>
                    </div>
                    <div>
                        <span id="report-to-bank-name" class="mr-2">Bank Details here...</span>
                        <textarea type="text" id="input-report-to-bank-name" class="mr-2 form-input set-input-style mt-2" rows="5"></textarea>
                        <span id="edit-report-to-bank-name" class="blue-color"><i class="fas fa-pen-alt"></i> Edit</span>
                        <span id="update-report-to-bank-name" class="blue-color mt-2"><i class="fas fa-save"></i> Save</span><br/>
                    </div>
                </div>
            </div>
        </div>
        <div class="report-table">
            <table>
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Case Date</th>
                        <th>Borrower</th>
                        <th>Amount</th>
                        <th class="case-status-col">Case Status</th>
                        <!-- <th class="remove-case-row-heading text-align-center">Remove</th> -->
                    </tr>
                </thead>
                <tbody>
            <?php 
                $serial_no = 1;
                foreach($result_array as $home_loan){
                    ?>
                    <tr id="case-details<?php echo $serial_no; ?>" class="case-details-show">
                        <td><?php echo $serial_no; ?></td>
                        <td><?php echo $home_loan['case_date']; ?></td>
                        <td><?php echo $home_loan['borrower_name']; ?></td>
                        <td><?php echo $home_loan['amount']; ?></td>
                            <?php
                                $status = $home_loan['case_status'];
                                if($status == '2'){
                                    $status_icon = "<i class='mdi mdi-exclamation icon-mr-5'></i>";
                                    $status_value = 'Withdraw';
                                    $color = 'red-color';
                                } 
                                else if($status == '1'){
                                    $status_icon = "<i class='mdi mdi-check icon-mr-5'></i>";
                                    $status_value = 'Complete';
                                    $color = 'green-color';
                                } 
                                else if($status == '0'){
                                    $status_icon = "<i class='fas fa-spinner fa-spin icon-mr-5'></i>";
                                    $status_value = 'In Progress';
                                    $color = 'blue-color';
                                }
                            ?>
                        <td class="case-status-col <?php echo $color; ?>">
                            <?php echo $status_icon.$status_value; ?>
                        </td>
                        <!-- <td class="text-align-center case-status-col">
                            <i id="remove-row<?php echo $serial_no; ?>" class="mdi mdi-window-close remove-row"></i>
                            <div class="display-none case-status"><?php echo $home_loan['case_status']; ?></div>
                        </td>
                        <script>
                            document.getElementById('remove-row<?php echo $serial_no; ?>').addEventListener('click', () => {
                                document.getElementById('case-details<?php echo $serial_no; ?>').className = 'case-details-hide'
                                arrangeSerialNumber()
                            })
                        </script> -->
                    </tr>
                    <?php
                    $serial_no += 1;
                }
            ?>
            </tbody>  
            </table>
        </div>
    </div>
    
    <div class="black-cover-report-options"></div>
</body>
</html>

<!-- <script>

    document.getElementById('customize-report').addEventListener('click', () => {
        document.getElementsByClassName('report-options')[0].style.display = 'block'
        document.getElementsByClassName('black-cover-report-options')[0].style.display = 'block'
    })
    document.getElementsByClassName('black-cover-report-options')[0].addEventListener('click', () => {
        document.getElementsByClassName('black-cover-report-options')[0].style.display = 'none'
        document.getElementsByClassName('report-options')[0].style.display = 'none'
    })
</script> -->



<script>
        document.getElementById('print-report-btn').addEventListener('click', () => {
        let printHeader = document.getElementsByClassName('print-header')[0]
        let headerCoverSpace = document.getElementsByClassName('print-header-cover-space')[0]
        printHeader.style.display = 'none'
        headerCoverSpace.style.display = 'none'
        document.getElementById('edit-report-to-bank').style.display = 'none'
        document.getElementById('update-report-to-bank').style.display = 'none'
        document.getElementById('report-to-bank').style.display = 'block'
        document.getElementById('input-report-to-bank').style.display = 'none'
        document.getElementById('edit-report-to-bank-name').style.display = 'none'
        document.getElementById('update-report-to-bank-name').style.display = 'none'
        document.getElementById('report-to-bank-name').style.display = 'block'
        document.getElementById('input-report-to-bank-name').style.display = 'none'
        window.print();
        printHeader.style.display = 'block'
        printHeader.style.display = 'flex'
        headerCoverSpace.style.display = 'block'
        document.getElementById('edit-report-to-bank').style.display = 'block'
        document.getElementById('update-report-to-bank').style.display = 'none'
        document.getElementById('report-to-bank').style.display = 'block'
        document.getElementById('input-report-to-bank').style.display = 'none'
        document.getElementById('edit-report-to-bank-name').style.display = 'block'
        document.getElementById('update-report-to-bank-name').style.display = 'none'
        document.getElementById('report-to-bank-name').style.display = 'block'
        document.getElementById('input-report-to-bank-name').style.display = 'none'
    })

    function arrangeSerialNumber(){
        let cases = document.getElementsByClassName('case-details-show')
        let i
        for(i=0; i< cases.length; i++){
            cases[i].getElementsByTagName('td')[0].innerHTML = i+1
        }
    }
    function caseStatusWise(){
        let completeCaseCheckbox = document.getElementsByName('caseCompleted')[0]
        let inProgressCaseCheckbox = document.getElementsByName('caseInProgress')[0]
        let withdrawCaseCheckbox = document.getElementsByName('caseWithdraw')[0]
        let caseStatus = document.getElementsByClassName('case-status')
        let completed = completeCaseCheckbox.checked
        let withdraw = withdrawCaseCheckbox.checked
        let progress = inProgressCaseCheckbox.checked
        let i
        if(completed && withdraw && progress){  // all cases
            for(i=0; i<caseStatus.length; i++){
                caseRow = document.getElementById('case-details'+(i+1))
                caseRow.className = 'case-details-show'
            }
        }
        else if(completed && withdraw && !progress){ // completed and withdraw
            for(i=0; i<caseStatus.length; i++){
                caseRow = document.getElementById('case-details'+(i+1))
                if(caseStatus[i].innerHTML == '1' || caseStatus[i].innerHTML == '2'){
                    caseRow.className = 'case-details-show'
                }
                else{
                    caseRow.className = 'case-details-hide'
                }
            }
        }
        else if(completed && !withdraw && progress){ // completed and progress
            for(i=0; i<caseStatus.length; i++){
                caseRow = document.getElementById('case-details'+(i+1))
                if(caseStatus[i].innerHTML == '1' || caseStatus[i].innerHTML == '0'){
                    caseRow.className = 'case-details-show'
                }
                else{
                    caseRow.className = 'case-details-hide'
                }
            }
        }
        else if(!completed && withdraw && progress){ // withdraw and progress
            for(i=0; i<caseStatus.length; i++){
                caseRow = document.getElementById('case-details'+(i+1))
                if(caseStatus[i].innerHTML == '2' || caseStatus[i].innerHTML == '0'){
                    caseRow.className = 'case-details-show'
                }
                else{
                    caseRow.className = 'case-details-hide'
                }
            }
        }
        else if(completed && !withdraw && !progress){ // only completed
            for(i=0; i<caseStatus.length; i++){
                caseRow = document.getElementById('case-details'+(i+1))
                if(caseStatus[i].innerHTML == '1'){
                    caseRow.className = 'case-details-show'
                }
                else{
                    caseRow.className = 'case-details-hide'
                }
            }
        }
        else if(!completed && withdraw && !progress){ // only withdraw
            for(i=0; i<caseStatus.length; i++){
                caseRow = document.getElementById('case-details'+(i+1))
                if(caseStatus[i].innerHTML == '2'){
                    caseRow.className = 'case-details-show'
                }
                else{
                    caseRow.className = 'case-details-hide'
                }
            }
        }
        else if(!completed && !withdraw && progress){ // only progress
            for(i=0; i<caseStatus.length; i++){
                caseRow = document.getElementById('case-details'+(i+1))
                if(caseStatus[i].innerHTML == '0'){
                    caseRow.className = 'case-details-show'
                }
                else{
                    caseRow.className = 'case-details-hide'
                }
            }
        }
        // else{
        //     alert('Please Select at least one type')
        // }
        
        arrangeSerialNumber()
    }

    // document.getElementById('reset-btn').addEventListener('click', () => {
    //     caseStatusWise()
    // })
</script>

<script>
    document.getElementById('edit-report-to-bank').addEventListener('click', () => {
        document.getElementById('edit-report-to-bank').style.display = 'none'
        document.getElementById('update-report-to-bank').style.display = 'block'
        document.getElementById('report-to-bank').style.display = 'none'
        document.getElementById('input-report-to-bank').style.display = 'block'
    })
    document.getElementById('update-report-to-bank').addEventListener('click', () => {
        document.getElementById('edit-report-to-bank').style.display = 'block'
        
        document.getElementById('update-report-to-bank').style.display = 'none'
        let element = document.getElementById('input-report-to-bank')
        value = element.value
        element.style.display = 'none'
        element = document.getElementById('report-to-bank')
        element.style.display = 'block'
        element.innerHTML = value
    })

    
    document.getElementById('edit-report-to-bank-name').addEventListener('click', () => {
        document.getElementById('edit-report-to-bank-name').style.display = 'none'
        document.getElementById('update-report-to-bank-name').style.display = 'block'
        document.getElementById('report-to-bank-name').style.display = 'none'
        document.getElementById('input-report-to-bank-name').style.display = 'block'
    })
    document.getElementById('update-report-to-bank-name').addEventListener('click', () => {
        document.getElementById('edit-report-to-bank-name').style.display = 'block'
        
        document.getElementById('update-report-to-bank-name').style.display = 'none'
        let element = document.getElementById('input-report-to-bank-name')
        value = element.value.replace(/\n/g, "<br />").trim()
        element.style.display = 'none'
        element = document.getElementById('report-to-bank-name')
        element.style.display = 'block'
        if(value == '')
            value = 'Bank Details here...'
        element.innerHTML = value
    })
</script>