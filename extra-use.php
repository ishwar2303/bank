
<div class="col-md-6">
    <label for="exampleInputCity1">Order received on</label>
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
    <label for="exampleInputCity1">Order forwarded to bank on</label>
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
<script>
    document.getElementById('order-forwarded-on').defaultValue = '<?php echo $order_forwarded_to_bank_on; ?>'
</script>


&& isset($_POST['orderReceivedOn']) && isset($_POST['orderForwardedOn'])

$order_received_on = '';
$order_forwarded_to_bank_on = '';
$order_received_on_error = '';
$order_forwarded_to_bank_on_error = '';

$order_received_on = cleanInput($_POST['orderReceivedOn']);
$order_forwarded_to_bank_on = cleanInput($_POST['orderForwardedOn']);



order_received_on = '$order_received_on', order_forwarded_to_bank_on = '$order_forwarded_to_bank_on',


<td><?php echo $row['order_received_on'] != '0000-00-00' ? $row['order_received_on'] : '-'; ?></td>
<td><?php echo $row['order_forwarded_to_bank_on'] != '0000-00-00' ? $row['order_forwarded_to_bank_on'] : '-'; ?></td>
                        