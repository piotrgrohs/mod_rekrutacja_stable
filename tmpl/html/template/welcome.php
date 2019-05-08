<?php

function eventExists($mod,$listOfEvent, $id){
    foreach($listOfEvent as $innerArray => $innerValue){
        if($id == $innerValue[0]){
            return true;
        }
    }
    return false;
}


if ( isset($_SESSION['user_id'])) {
    if(isset($_POST['chooseEvent'])){
        foreach ($_POST as $event => $value){
            foreach($value as $id){
                if($mod->isNegativeNumber($id)){
                    $id = abs($id);
                    $mod->removeAssignEvent($id,$_SESSION['user_id']);
                }else{
                    $mod->assignEvent($id,$_SESSION['user_id']);
                }
            }
        }
        $success = 'Zapisano';
        $mod->redirectWithSuccess('welcome',$success);
    }
    include 'events.php';
    echo '<a class="btn btn-link" href="dni_otwarte.html?nav=logout">wyloguj</a>';
} else {
    echo '<h1>Not found 404</h1>';
}
?>
