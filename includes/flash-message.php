<?php 
if(isset($_SESSION['success_msg'])){
    ?>
    <div class="success-msg">
        <i class="mdi mdi-check"></i>
        <span>
            <?php echo $_SESSION['success_msg']; ?>
        </span>
        <i class="mdi mdi-window-close close-success-flash-msg"></i>
    </div>
    <!-- <script>
    setTimeout(() => {
        $('.success-msg').remove()
    }, 10000)
    </script> -->
    <?php
    unset($_SESSION['success_msg']);
}
?>
<?php 
if(isset($_SESSION['error_msg'])){
    ?>
    <div class="error-msg">
        <!-- <i class="fas fa-exclamation-triangle"></i> -->
        <span>
            <?php echo $_SESSION['error_msg']; ?>
        </span>
        <i class="mdi mdi-window-close close-error-flash-msg"></i>
    </div>
    <!-- <script>
    setTimeout(() => {
        $('.error-msg').remove()
    }, 10000)
    </script> -->
    <?php
    unset($_SESSION['error_msg']);
}
?>
<?php 
if(isset($_SESSION['note_msg'])){
    ?>
    <div class="note-msg">
        <i class="fas fa-exclamation"></i>
        <span>
            <?php echo $_SESSION['note_msg']; ?>
        </span>
        <i class="mdi mdi-window-close close-note-flash-msg"></i>
    </div>
    <!-- Remove message after 10 seconds -->
    <!-- <script>
    setTimeout(() => {
        $('.note-msg').remove()
    }, 10000)
    </script> -->
    <?php
    unset($_SESSION['note_msg']);
}
?>

<script>
    $(document).ready(() => {
        $('.close-success-flash-msg').click(() => {
            $('.success-msg').remove()
        })
        $('.close-error-flash-msg').click(() => {
            $('.error-msg').remove()
        })
        $('.close-note-flash-msg').click(() => {
            $('.note-msg').remove()
        })
    })
</script>