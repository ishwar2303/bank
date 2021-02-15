<?php 
    require_once('connection.php');
    require_once('middleware.php');
    if(isset($_POST['case_id'])){
        $case_id = base64_decode(cleanInput($_POST['case_id']));
        $sql = "SELECT case_status FROM car_loan WHERE car_loan_cid = '$case_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $case_status = $row['case_status'];
        $sql = "SELECT * FROM car_loan_status WHERE case_id = $case_id";
        $result = $conn->query($sql);

        if($conn->error == ''){
            if($result->num_rows > 0){
            ?>
            <div class="table-container set-vh-80">
            <table class="table table-hover">
                <thead>
                    <th>Serial No</th>
                    <th>Auction Date</th>
                    <th>Auction Amount</th>
                    <th>Recovery Date</th>
                    <th>Full Amount</th>
                    <th>Part Amount</th>
                    <th>Bill Raised</th>
                    <th>Payment Received On</th>
                    <th>Payment Received</th>
                    <th>Regularise Amount</th>
                    <th>Full Payment Paid On</th>
                    <!-- <th>Status ID</th> -->
                    <?php if($case_status == '0'){ ?> <!-- case in progress -->
                    <th>Action</th>
                    <?php } ?>
                </thead>
            <?php
                $serial_no = 1;
                while($row = $result->fetch_assoc()){
                    $encoded_status_id = base64_encode($row['status_id']);
            ?>
                    <tbody>
                        <td><?php echo $serial_no; ?></td>
                        <td><?php echo $row['auction_date'] != '0000-00-00' ? $row['auction_date'] : '-'; ?></td>
                        <td><?php echo $row['auction_amount']; ?></td>                        
                        <td><?php echo $row['recovery_date'] != '0000-00-00' ? $row['recovery_date'] : '-'; ?></td>
                        <td><?php echo $row['full_amount']; ?></td>
                        <td><?php echo $row['part_amount']; ?></td>
                        <td><?php echo $row['bill_raised']; ?></td>
                        <td><?php echo $row['payment_received_on'] != '0000-00-00' ? $row['payment_received_on'] : '-'; ?></td>
                        <td><?php echo $row['payment_received']; ?></td>
                        <td><?php echo $row['regularise_date'] != '0000-00-00' ? $row['regularise_date'] : '-'; ?></td>
                        <td><?php echo $row['full_payment_paid_on'] != '0000-00-00' ? $row['full_payment_paid_on'] : '-'; ?></td>
                        
                        <!-- <td><?php echo $row['status_id']; ?></td> -->
                        <?php if($case_status == '0'){ ?> <!-- case in progress -->
                        <td>
                            <div class="icon-btn-container">
                                <a class="edit"  href="edit-car-loan-status.php?status_id=<?php echo $encoded_status_id; ?>" target="_blank">
                                <i class="fas fa-pencil-alt"></i>
                                <span class="operation-name">Edit Details</span>
                                </a>
                                <!-- <a onclick="return false" class="delete delete-e-auction">
                                <i class="fas fa-trash-alt"></i>
                                <span class="operation-name">Remove</span>
                                </a> -->
                            </div>
                            <!-- <label class="delete-btn" onclick="confirmResourceDeletion('<?php echo $encoded_status_id; ?>','home-loan-status')" >
                                <span>Delete</span>
                                <i class="fas fa-trash-alt"></i>
                            </label> -->
                        </td>
                        <?php } ?>
                    </tbody>
            <?php   

                $serial_no += 1;
                }
                
            ?>

            </table>
            </div>
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