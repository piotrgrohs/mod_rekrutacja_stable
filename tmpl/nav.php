<?php 
        $array = [
            "login" => "html/login.php",
            "registration" => "html/registration.php",
            "logout" => "html/logout.php",
            "activation" => "html/template/activation.php",
            "token" => "html/token.php",
            "admin" => "html/template/admin.php"
        ];
        $login = [
            "welcome" => "html/template/welcome.php",
            "logout" => "html/logout.php",
            "admin" => "html/template/admin.php"
        ];
    session_start();
    include "html/error.php";
    if( isset($_GET['nav']) ){
        if(isset( $_SESSION['user_id'] )) {
            if(empty($login[$_GET['nav']])){
                include $login["welcome"];
            }else{
                include $login[$_GET['nav']];
            }
        }else{
            if(empty(!$array[$_GET['nav']])){           
                include $array[$_GET['nav']];
            }else{
                include $array["login"];
            }
        }
    }elseif(isset( $_SESSION['user_id'] )){
        include $login["welcome"];
    }else{
        include $array["login"];
    }
?>