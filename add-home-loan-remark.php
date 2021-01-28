<?php 

    session_start();
    require_once('connection.php');

    date_default_timezone_set("Asia/Kolkata");
    $epoch_time = time();
    $timestamp = date("y-m-d h:i:sa", $epoch_time);

    require_once('middleware.php');

    if(isset($_POST['caseID']) && isset($_POST['remark'])){
        $case_id = cleanInput($_POST['caseID']);
        $remark = cleanInput($_POST['remark']);
        $case_id = base64_decode($case_id);
        if($remark != '' && $case_id != ''){
            $remark = str_replace("\n", "<br/>", $remark);
            $sql = "INSERT INTO `home_loan_remarks` (`remark_id`, `case_id`, `remark_date`, `remark`) VALUES (NULL, '$case_id', '$timestamp', '$remark')";
            $conn->query($sql);
            if($conn->error == ''){
                ?>
                <label class="success-msg mt-2 mb-2">Remark added to case successfully</label>
                <?php
            }
            else{
                ?>
                <label class="error-msg mt-2">Something went wrong!</label>
                <?php
            }
        }
        else{
            ?>
                <label class="error-msg mt-2">Remark required!</label>
            <?php 
        }
    }

    if(isset($_POST['remarkIdDelete'])){
        $remark_id = cleanInput($_POST['remarkIdDelete']);
        if($remark_id != ''){
            $sql = "DELETE FROM home_loan_remarks WHERE remark_id = '$remark_id'";
            $conn->query($sql);
            if($conn->error == ''){
                ?>
                <label class="success-msg mt-2 mb-2">Remark deleted successfully</label>
                <?php
            }
            else{
                ?>
                <label class="error-msg mt-2">Something went wrong!</label>
                <?php
            }
        }
    }
?>

<?php 
    if(isset($_POST['caseID'])){
        $case_id = cleanInput($_POST['caseID']);
        $case_id = base64_decode($case_id);
        $sql = "SELECT * FROM home_loan_remarks WHERE case_id = '$case_id' ORDER BY remark_id DESC";
        $result = $conn->query($sql);
        $index = 0;
        if($conn->error == ''){
            ?>
            <div id="case-remarks">
            <?php
            if($result->num_rows > 0){
                ?>
                <?php
                while($row = $result->fetch_assoc()){
                    $date = new DateTime($row['remark_date']);
                    $remark_date = $date->format('d-m-Y');
                    $remark_time = $date->format('h:i:sa');
                    ?>
                        <div class="mb-2">
                            <div class="remark-value">
                                <span><?php echo ($index+1).'.'; ?></span>
                                <label><?php echo $row['remark']; ?></label>
                            </div>
                            <div class="remark-date-delete">
                                    <div>Date : <?php echo $remark_date ?></div>

                                    <i class="far fa-trash-alt remove-remark"></i>
                                    <script>
                                        $('.remove-remark').eq(<?php echo $index; ?>).click(() => {
                                        let confirmation = confirm('Remove : Are your sure!')
                                        if(confirmation){
                                            let remarkIdDelete = '<?php echo $row['remark_id']; ?>'
                                            let caseID = '<?php echo base64_encode($row['case_id']); ?>'
                                            let reqData = {
                                                remarkIdDelete,
                                                caseID
                                            }
                                            let url = 'add-home-loan-remark.php'
                                            $.ajax({
                                                url,
                                                type : 'POST',
                                                dataType : 'html',
                                                success : (msg) => {
                                                },
                                                complete : (res) => {
                                                    $('#remark-response').html(res.responseText)
                                                },
                                                data : reqData
                                            })
                                            }
                                        })
                                    </script>
                                </div>
                        </div>
                    <?php
                    $index += 1;
                }
            }
            else{
                ?>
                <label class="error-msg mt-2">No remarks!</label>
                <?php
            }
            ?>
            </div>
            <?php
        }
    }

?>