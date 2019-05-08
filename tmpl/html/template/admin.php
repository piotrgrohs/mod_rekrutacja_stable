<?php


if($_POST['name']){
    $mod->addEvent($_POST);
}elseif($_POST['removeEventid']){
    console.log($_POST['removeEventid']);
    $mod->removeEvent($_POST['removeEventid']);
}elseif($_POST['removeUserid']){
    console.log($_POST['removeUserid']);
    $mod->removeUser($_POST['removeUserid']);
}elseif($_POST['addGroupEvent']){
    $mod->addEventGroup();
}elseif($_POST['rmEventGroupid']){
    $mod->removeEventGroup($_POST['rmEventGroupid']);
}elseif($_POST['onlyOnceId']){
    $value = (($_POST['onlyOnce'] == $_POST['onlyOnceId'])? 1 : 0);
    $mod->updateOnlyOnce($_POST['onlyOnceId'],$value);
}elseif($_POST['updateGroupName']){
    $mod->updateGroupName($_POST['updateGroupName'],$_POST['updateGroupID']);
}


function addEvent($id){
    echo '<form action="" method="post">
        <div class="form-group">
            <label for="name">Dodaj konkurs: </label>
            <input type="text" class="form-control" name="name" id="name">
            <input type="hidden" class="form-control" value="'.$id.'" name="idgr" id="idgr">
            <label for="timeOfEvent">Czas konkursu: </label>
            <input type="time" name="timeOfEvent" >
        </div>
        <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>'; 
}
function removeEvent($id){
    echo '<input type="hidden" class="form-control" value="'.$id.'" name="removeEventid" id="removeEventid">
    <button type="submit" class="btn btn-primary">Usuń</button>';
}
function onlyOnce($id,$state){
    echo '
    <div class="form-check">
    <input type="hidden" class="form-control" value="'.$id.'" name="onlyOnceId" id="onlyOnceId">
    <input type="checkbox" class="form-check-label" value="'.$id.'" name="onlyOnce" id="onlyOnce" '.(($state)? 'checked' : '').'>
    <label class="form-check-label" for="onlyOnce">Tylko raz</label>
    </div>';
}
function save(){
    echo '<button type="submit" class="btn btn-primary">Zapisz</button>';
}
function removeEventGroup($id){
    echo '<form action="" method="post"><div class="form-group">
        <input type="hidden" class="form-control" value="'.$id.'" name="rmEventGroupid" id="rmEventGroupid">
    </div>
    <button type="submit" class="btn btn-primary">Usuń grupe</button>
</form>';
}
function updateGroupName($mod,$id){
    echo '<form action="" method="post"><div class="form-group">
    <input type="hidden" class="form-control" value="'.$id.'" name="updateGroupID" id="updateGroupID">
    <input type="text" class="form-control" value="'.$mod->getGroupName($id).'" name="updateGroupName" id="updateGroupName">
    </div>
<button type="submit" class="btn btn-primary">Zapisz nazwe</button>
</form>';
} 

function form_begin(){
    echo '<form action="" method="post">';
}
function form_end(){
    echo '</form>';
}
function getEvent($mod,$userID){
    $assignedEvents = $mod->eventAssign($userID);
    foreach($assignedEvents as $event){
        $string .= $mod->getNameEvent($event[0]). ', ';
    }
    return $string;
}
echo '</br>Grupy:</br>';
foreach($mod->eventGroup() as $group){
    echo '<h4>id grupy: '.$group[0].'</h4>';
    updateGroupName($mod,$group[0]);
    foreach($mod->event((int)$group[0]) as $event){
        echo '<h4> id:'.$event[0].' nazwa konkursu: '.$event[1].' czas: '.$event[2].'</h4>';
        form_begin();
        removeEvent($event[0]);
        form_end();
    } 
    form_begin();
    echo onlyOnce($group[0],$mod->onlyOnceState($group[0])) . save();
    form_end();
    addEvent($group[0]);
    removeEventGroup((int)$group[0]);
}

foreach($mod->users() as $user){
    echo '<h4> id: '.$user[0].' nazwa: '.$user[1].' aktywny: '.$user[2].' konkursy:'. getEvent($mod,$user[0]).'</h4>';
}

/* echo '</br>Konkursy</br>';
echo '</br>Przypisane konkursy</br>';
foreach($mod->assignedEvents() as $event){
    echo '<h4> id:'.$event[0].' id_rekru '.$event[1].' id_przyp '.$event[2].'</h4>';
} */



?>
<form action="" method="post">
    <div class="form-group">
        <label for="addGroupEvent">Dodaj grupe konkursow: </label>
        <input type="hidden" class="form-control" name="addGroupEvent" value="group" id="addGroupEvent">
    </div>
    <button type="submit" class="btn btn-primary">Dodaj</button>
</form>
<form action="" method="post">
    <div class="form-group">
        <label for="removeEventid">Usuń konkurs: </label>
        <input type="text" class="form-control" name="removeEventid" id="removeEventid">
    </div>
    <button type="submit" class="btn btn-primary">Usuń</button>
</form>
<form action="" method="post">
    <div class="form-group">
        <label for="removeUserid">Usuń uzytkownika: </label>
        <input type="text" class="form-control" name="removeUserid" id="removeUserid">
    </div>
    <button type="submit" class="btn btn-primary">Usuń</button>
</form>
<script>
    var onlyOnce = document.getElementById("onlyOnce");
    var onlyOnceValue = onlyOnce.value; 
    onlyOnce.addEventListener('change', onlyOnceF);
    function onlyOnceF() {
       onlyOnce.value = (onlyOnce.checked)? onlyOnceValue : '-1';  
    }
</script>

