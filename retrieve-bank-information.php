<?php
    
    require_once('connection.php');

    class response{
        public $bank;
        public $error;
        public $success;

        function create_response($suc, $err, $data){
            $this->success = $suc;
            $this->error = $err;
            $this->bank = $data;
            $json_format_data = json_encode($this);
            print_r($json_format_data);
        }
    }
    if(isset($_POST['bank_id'])){
        $bank_id = base64_decode($_POST['bank_id']);
        $sql = "SELECT * FROM bank WHERE bank_id = '$bank_id'";
        $result = $conn->query($sql);

        $bank_response = new response();
        if($conn->error == ''){
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $bank_response->create_response(true, false, $row);
            }
            else{
                $bank_response->create_response(false, 'No bank found with the given ID!', '');
            }
            
        }
        else{
            $bank_response->create_response(false, $conn->error, '');
        }
    }
    else{
        $bank_response->create_response(false, 'Index not set!', '');
    }

?>