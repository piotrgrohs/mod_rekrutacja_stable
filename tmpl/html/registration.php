
<?php 
if(!empty($_POST)){
  $login = $_POST['login'];
  if( isset( $login) & isset( $_POST['password'])){
    if(!$mod->checklogin($login)){
      $mod->register($_POST);
      $subject = 'Aktywacja konta w ZSTE.pl';
      $body = 'kliknij w <a href="http://'
      .$_SERVER['HTTP_HOST'].'/dni_otwarte.html?nav=token&token='
      .$mod->getId($_POST['login']).'">Link</a> by aktywowac </br></br> Pozdrawiam, </br> ZST-E';      
      $mail->sendMail($_POST['login'],$subject,$body);
      $success = "Wysłaliśmy na twojego maila link aktywacyjny. Po wejściu w niego, będziesz mógł się zalogować. ";
      $mod->redirectwithSuccess('login',$success);
      
    }else{
      $error = "Adres email jest już zarejestrowany";
      $mod->redirectWithError('registration',$error);
    }
  }
  }else{
    include 'template/registration.php';
  }
?>


