<?php
    session_start();
    require_once('connection.php');
    require_once('middleware.php');
    if(isset($_POST['toDoWork'])){
        $to_do_work = cleanInput($_POST['toDoWork']);

        if(!empty($to_do_work)){
            $sql = "INSERT INTO `to_do` (`to_do_id`, `user_id`, `to_do_work`, `status`) VALUES (NULL, '$_SESSION[user_id]', '$to_do_work', '0')";
            $conn->query($sql);
            if($conn->error != ''){
                ?>
                    <div class="error-msg">Somthing went wrong!</div>
                <?php
            }
        }

    }

    if(isset($_POST['toDoIdDelete'])){
        $ID = cleanInput($_POST['toDoIdDelete']);
        $sql = "DELETE FROM to_do WHERE to_do_id = '$ID'";
        $conn->query($sql);
        if($conn->error != ''){
            ?>
                <div class="error-msg">Somthing went wrong!</div>
            <?php
        }

    }

    if(isset($_POST['toDoSuccess'])){
        $ID = cleanInput($_POST['toDoSuccess']);
        $sql = "UPDATE to_do SET status = '1' WHERE to_do_id = '$ID'";
        $conn->query($sql);
        if($conn->error != ''){
            ?>
                <div class="error-msg">Somthing went wrong!</div>
            <?php
        }
    }

    if(isset($_POST['toDoIncomplete'])){
        $ID = cleanInput($_POST['toDoIncomplete']);
        $sql = "UPDATE to_do SET status = '0' WHERE to_do_id = '$ID'";
        $conn->query($sql);
        if($conn->error != ''){
            ?>
                <div class="error-msg">Somthing went wrong!</div>
            <?php
        }
    }
?>
<?php 
    if(isset($_SESSION['user_id'])){
        $sql = "SELECT * FROM to_do WHERE user_id = '$_SESSION[user_id]' ORDER BY to_do_id DESC";
        $result = $conn->query($sql);
        $index = 0;
        $statusIndexDone = 0;
        $statusIndexIncomplete = 0;
        while($row = $result->fetch_assoc()){
            if($row['status'] == '0')
                $css_class = 'bg-gradient-danger';
            if($row['status'] == '1')
                $css_class = 'bg-gradient-success'
        ?>
        <li class="<?php echo $css_class; ?>">
            <div>
                <span><?php echo ($index+1).'.'; ?></span>
                <label><?php echo $row['to_do_work']; ?></label>
            </div>
            <span>
                <?php if($row['status'] == '0'){ ?>
                        <i class="far fa-check-circle make-status-success"></i>
                <script>
                    $('.make-status-success').eq(<?php echo $statusIndexDone; ?>).click(() => {
                    let confirmation = confirm('Mark as done!')
                    if(confirmation){
                        let toDoSuccess = '<?php echo $row['to_do_id']; ?>'
                        let reqData = {
                            toDoSuccess
                        }
                        let url = 'to-do-work.php'
                        $.ajax({
                            url,
                            type : 'POST',
                            dataType : 'html',
                            success : (msg) => {
                            },
                            complete : (res) => {
                                $('#all-to-do-list').html(res.responseText)
                            },
                            data : reqData
                        })
                    }
                    })
                </script>
                <?php
                        $statusIndexDone += 1;
                    } 
                ?>
                <?php if($row['status'] == '1'){ ?>
                        <i class="far fa-times-circle make-status-incomplete"></i>
                <script>
                    $('.make-status-incomplete').eq(<?php echo $statusIndexIncomplete; ?>).click(() => {
                    let confirmation = confirm('Mark as incomplete!')
                    if(confirmation){
                        let toDoIncomplete = '<?php echo $row['to_do_id']; ?>'
                        let reqData = {
                            toDoIncomplete
                        }
                        let url = 'to-do-work.php'
                        $.ajax({
                            url,
                            type : 'POST',
                            dataType : 'html',
                            success : (msg) => {
                            },
                            complete : (res) => {
                                $('#all-to-do-list').html(res.responseText)
                            },
                            data : reqData
                        })
                    }
                    })
                </script>
                <?php
                        $statusIndexIncomplete += 1;
                    } 
                ?>
                <i class="far fa-trash-alt remove-to-do-work"></i>
            </span>
        </li>
        <script>
            $('.remove-to-do-work').eq(<?php echo $index; ?>).click(() => {
            let confirmation = confirm('Remove : Are your sure!')
            if(confirmation){
                let toDoIdDelete = '<?php echo $row['to_do_id']; ?>'
                let reqData = {
                    toDoIdDelete
                }
                let url = 'to-do-work.php'
                $.ajax({
                    url,
                    type : 'POST',
                    dataType : 'html',
                    success : (msg) => {
                    },
                    complete : (res) => {
                        $('#all-to-do-list').html(res.responseText)
                    },
                    data : reqData
                })
            }
            })
        </script>
        <?php
        $index += 1;
        }
    }
?>