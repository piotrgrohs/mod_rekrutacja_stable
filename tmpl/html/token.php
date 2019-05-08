
<?php 
if(isset($_GET['token'])){
    $mod->active($_GET['token']);
    $success = "Poprawnie aktywowano konto. Możesz się teraz zalogować";
    $mod->redirectwithSuccess('login',$success);
}else{
    $mod->redirect('login');
}
?>
