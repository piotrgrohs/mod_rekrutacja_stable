
<?php 
if(!empty($_POST)){
  if( isset( $_POST['email']) && isset( $_POST['password'])){
    if($mod->login($_POST['email'],$_POST['password'])){
        if($mod->isActive($mod->getId($_POST['email']))){
        $_SESSION['user_id'] = $mod->getId($_POST['email']);
        $mod->redirect('welcome');
      }else{
        $error = "Aktywuj konto, poprzez link wyłany na twoją pocztę";
        $mod->redirectWithError('login',$error);
      }
    }else{
      $error = "Niepoprawne hasło, bądź login";
      $mod->redirectWithError('login',$error);
      
    }
  
  } 
}else{
  
  include 'template/login.php';
}
?>
