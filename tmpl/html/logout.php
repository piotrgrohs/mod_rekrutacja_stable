<?php
session_destroy();
$success = "wylogowano";
$mod->redirectWithSuccess('login',$success);
?>
