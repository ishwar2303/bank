<?php 
    require_once('connection.php');
    if(isset($_POST['case_id'])){
        $case_id = base64_decode($_POST['case_id']);
        $sql = "SELECT * FROM home_loan_comments WHERE case_id = $case_id";
        $result = $conn->query($sql);

        if($conn->error == ''){
            if($result->num_rows > 0){
            ?>
            <table class="table table-hover">
                <thead>
                    <th>Serial No</th>
                    <th>Next hearing</th>
                    <th>Order received</th>
                    <th>Order forwarded</th>
                    <th>Lease On</th>
                    <th>Physical possession</th>
                    <th>Notice of physical possession</th>
                    <th>Possession taken</th>
                    <th>Possession postpone</th>
                    <th>Postpone reason</th>
                    <th>Property on Auction</th>
                    <th>Reserve Price</th>
                    <th>EMD Amount</th>
                    <th>Property visit by prospective buyers</th>
                    <th>Auction</th>
                    <th>Auction Status</th>
                    <th>Documents given to Advocate</th>
                    <th>Redirection order filled with DM/CMM</th>
                    <th>Redirection order received</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
            <?php
                $serial_no = 1;
                while($row = $result->fetch_assoc()){
                    $encoded_comment_id = base64_encode($row['comment_id']);
            ?>
                    <tbody>
                        <td><?php echo $serial_no; ?></td>
                        <td><?php echo $row['date_of_next_hearing'] != '0000-00-00' ? $row['date_of_next_hearing'] : '-'; ?></td>
                        <td><?php echo $row['order_received_on'] != '0000-00-00' ? $row['order_received_on'] : '-'; ?></td>
                        <td><?php echo $row['order_forwarded_to_bank_on'] != '0000-00-00' ? $row['order_forwarded_to_bank_on'] : '-'; ?></td>
                        <td><?php echo $row['lease_on'] != '0000-00-00' ? $row['lease_on'] : '-'; ?></td>
                        <td><?php echo $row['physical_possession_on'] != '0000-00-00' ? $row['physical_possession_on'] : '-'; ?></td>
                        <td><?php echo $row['notice_of_physical_possession'] != '0000-00-00' ? $row['notice_of_physical_possession'] : '-'; ?></td>
                        <td><?php echo $row['possession_taken_on'] != '0000-00-00' ? $row['possession_taken_on'] : '-'; ?></td>
                        <td><?php echo $row['possession_postpone_on'] != '0000-00-00' ? $row['possession_postpone_on'] : '-'; ?></td>
                        <td><?php echo $row['possession_postpone_reason']; ?></td>
                        <td><?php echo $row['property_on_auction'] != '0000-00-00' ? $row['property_on_auction'] : '-'; ?></td>
                        <td><?php echo $row['reserve_price'] != '0000-00-00' ? $row['reserve_price'] : '-'; ?></td>
                        <td><?php echo $row['emd_amount'] != '0000-00-00' ? $row['emd_amount'] : '-'; ?></td>
                        <td><?php echo $row['property_visit_by_prospective_buyers_on'] != '0000-00-00' ? $row['property_visit_by_prospective_buyers_on'] : '-'; ?></td>
                        <td><?php echo $row['auction_date'] != '0000-00-00' ? $row['auction_date'] : '-'; ?></td>
                        <td>
                            <?php 
                            $status = $row['auction_status'];
                                if($status == '-1')
                                    echo '-';
                                else if($status == '1'){
                                    ?>
                                    <div class="success-status">
                                        <i class="fas fa-dot-circle"></i>
                                        <span>Success</span>
                                    </div>
                                    <?php
                                }
                                else if($status == '0'){
                                    ?>
                                    <div class="failed-status">
                                        <i class="fas fa-dot-circle"></i>
                                        <span>Failed</span>
                                    </div>
                                    <?php
                                }
                            ?>
                        </td>
                        <td><?php echo $row['doc_for_redirection_of_order_given_to_advocate_on'] != '0000-00-00' ? $row['doc_for_redirection_of_order_given_to_advocate_on'] : '-'; ?></td>
                        <td><?php echo $row['redirection_order_filled_with_dm_cmm_on'] != '0000-00-00' ? $row['redirection_order_filled_with_dm_cmm_on'] : '-'; ?></td>
                        <td><?php echo $row['redirection_order_received_on'] != '0000-00-00' ? $row['redirection_order_received_on'] : '-'; ?></td>
                        <td >
                            <a class="edit-btn" href="edit-home-loan-comment.php?comment_id=<?php echo $encoded_comment_id; ?>" target="_blank">
                                <span>Edit</span>
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <label class="delete-btn" onclick="confirmResourceDeletion('<?php echo $encoded_comment_id; ?>','home-loan-comment')" >
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