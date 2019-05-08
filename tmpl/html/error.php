<?php 

function error_message($message){
    echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
}
(isset($_GET['error']))? error_message($_GET['error']) : '';

function success_message($message){
    echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
}
(isset($_GET['success']))? success_message($_GET['success']) : '';
?>