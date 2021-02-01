<?php 
    require_once('connection.php');
    if(isset($_POST['case_id'])){
        $case_id = base64_decode($_POST['case_id']);
        $sql = "SELECT * FROM home_loan_status WHERE case_id = $case_id";
        $result = $conn->query($sql);

        if($conn->error == ''){
            if($result->num_rows > 0){
            ?>
            <table class="table table-hover">
                <thead>
                    <th>Serial No</th>
                    <th>Revised RA Agreement Expired on</th>
                    <th>Date of next hearing </th>
                    <th>Date Of Redirection by advocate</th>
                    <th>Lease with Court Receiver/Tehsildar/SSP on</th>
                    <th>Date of Physical Possession fixed on</th>
                    <th>Possession postpone on</th>
                    <th>Postpone reason</th>
                    <th>Reserve Price</th>
                    <th>EMD Amount</th>
                    <th>Property visit by prospective buyers</th>
                    <th>Auction Date</th>
                    <th>Date of Compromise</th>
                    <th>Amount of compromise</th>
                    <th>Full Compromise paid upto</th>
                    <th>Date of OTS accepted</th>
                    <th>Amount of OTS</th>
                    <th>Full amount of OTS paid upto</th>
                    <th>Compromise/OTS Failed Date</th>
                    <th>Compromise OTS Failed</th>
                    <th>Date Of RA Bill</th>
                    <th>Amount of RA Bill</th>
                    <th>RA Bill forward to Bank on</th>
                    <th>RA Bill paid on</th>
                    <th>RA Bill paid amount</th>
                    <th>Action</th>
                </thead>
            <?php
                $serial_no = 1;
                while($row = $result->fetch_assoc()){
                    $encoded_status_id = base64_encode($row['status_id']);
            ?>
                    <tbody>
                        <td><?php echo $serial_no; ?></td>
                        <td><?php echo $row['ra_agreement_expired_on'] != '0000-00-00' ? $row['ra_agreement_expired_on'] : '-'; ?></td>
                        <td><?php echo $row['date_of_next_hearing'] != '0000-00-00' ? $row['date_of_next_hearing'] : '-'; ?></td>
                        <td><?php echo $row['date_of_redirection_by_advocate'] != '0000-00-00' ? $row['date_of_redirection_by_advocate'] : '-'; ?></td>
                        <td><?php echo $row['lease_on'] != '0000-00-00' ? $row['lease_on'] : '-'; ?></td>
                        <td><?php echo $row['physical_possession_fixed_on'] != '0000-00-00' ? $row['physical_possession_fixed_on'] : '-'; ?></td>
                        <td><?php echo $row['possession_postpone_on'] != '0000-00-00' ? $row['possession_postpone_on'] : '-'; ?></td>
                        <td><?php echo $row['possession_postpone_reason']; ?></td>
                        <td><?php echo $row['reserve_price']; ?></td>
                        <td><?php echo $row['emd_amount']; ?></td>
                        <td><?php echo $row['property_visit_by_prospective_buyers_on'] != '0000-00-00' ? $row['property_visit_by_prospective_buyers_on'] : '-'; ?></td>
                        <td><?php echo $row['auction_date'] != '0000-00-00' ? $row['auction_date'] : '-'; ?></td>
                        <td><?php echo $row['date_of_compromise'] != '0000-00-00' ? $row['date_of_compromise'] : '-'; ?></td>
                        <td><?php echo $row['amount_of_compromise'] != '0000-00-00' ? $row['amount_of_compromise'] : '-'; ?></td>
                        <td><?php echo $row['full_compromise_paid_upto'] != '0000-00-00' ? $row['full_compromise_paid_upto'] : '-'; ?></td>
                        <td><?php echo $row['date_of_ots_accepted'] != '0000-00-00' ? $row['date_of_ots_accepted'] : '-'; ?></td>
                        <td><?php echo $row['amount_of_ots'] != '0000-00-00' ? $row['amount_of_ots'] : '-'; ?></td>
                        <td><?php echo $row['amount_of_ots_paid_upto'] != '0000-00-00' ? $row['amount_of_ots_paid_upto'] : '-'; ?></td>
                        
                        <td><?php echo $row['compromise_ots_failed_date'] != '0000-00-00' ? $row['compromise_ots_failed_date'] : '-'; ?></td>
                        <td>
                        <?php $compromise_ots_failed = $row['compromise_ots_failed']; 
                            if($compromise_ots_failed == '-1')
                                echo '-';
                            if($compromise_ots_failed == '0'){
                                ?>

                                <div class="failed-status">
                                    <i class="fas fa-dot-circle"></i>
                                    <span>No</span>
                                </div>

                                <?php
                            }
                            if($compromise_ots_failed == '1'){
                                ?>

                                <div class="success-status">
                                    <i class="fas fa-dot-circle"></i>
                                    <span>Yes</span>
                                </div>

                                <?php
                            }
                        ?>
                        </td>
                        <td><?php echo $row['date_of_ra_bill'] != '0000-00-00' ? $row['date_of_ra_bill'] : '-'; ?></td>
                        <td><?php echo $row['amount_of_ra_bill'] != '0000-00-00' ? $row['amount_of_ra_bill'] : '-'; ?></td>
                        <td><?php echo $row['ra_bill_forward_to_bank_on'] != '0000-00-00' ? $row['ra_bill_forward_to_bank_on'] : '-'; ?></td>
                        <td><?php echo $row['ra_bill_paid_on'] != '0000-00-00' ? $row['ra_bill_paid_on'] : '-'; ?></td>
                        <td><?php echo $row['ra_bill_paid_amount'] != '0000-00-00' ? $row['ra_bill_paid_amount'] : '-'; ?></td>
                        
                        <td>
                            <a class="edit-btn mr-1" href="edit-home-loan-status.php?status_id=<?php echo $encoded_status_id; ?>" target="_blank">
                                <span>Edit</span>
                                <i class="fas fa-edit"></i>
                            </a>
                            <label class="delete-btn" onclick="confirmResourceDeletion('<?php echo $encoded_status_id; ?>','home-loan-status')" >
                                <span>Delete</span>
                                <i class="fas fa-trash-alt"></i>
                            </label>
                        </td>
                    </tbody>
            <?php   

                $serial_no += 1;
                }
                
            ?>

            </table>
            <script>
                document.getElementsByClassName('show-case-status')[0].style.display = 'block';
            </script>
<?php
            }
        }
        else{

        }
    }

?>