<div class="card">
    <div class="card-body">
        <p>Wybierz konkurs: </p>
    </div>  
<?php 

function classChooseEvent(){
    return (!$isAssign)? "form-check" : "form-check disabled";
}

function groupChecker($mod,$groupID,$eventID,$session){
    if($mod->isUserAtGroup($groupID,$session)&&$mod->onlyOnceState($groupID)){
            return true;
    }elseif($mod->isUserAtEvent($eventID,$session)){
            return true;
    } 
    return false;
}

$sortEvents = $mod->events();
echo '<form action="" id="form" method="post"> ';
foreach($mod->eventGroup() as $group){
    echo '<ul class="list-group list-group-flush"  id='.$group[0].'>
            <li class="list-group-item'.(($mod->onlyOnceState($group[0]) && $mod->counterGroupEvent($group[0]))?' multiple':'').'">
            <p>'.$mod->getGroupName($group[0]).'</p>';
            foreach($mod->event((int)$group[0]) as $event){
                echo '
                <div class="'.(!($mod->isUserAtGroup($group[0],$_SESSION['user_id']))?"form-check":"form-check disabled").'">
                    <input class="form-check-input" type="hidden" name="chooseEvent[]" id="'.$event[0].'" value="-'.$event[0].'" >
                    <input class="form-check-input" type="checkbox" name="chooseEvent[]" id="'.$event[0].'" value="'.$event[0].'" '.
                    (groupChecker($mod,$group[0],$event[0],$_SESSION['user_id'])?" disabled ":"").
                    (($mod->isUserAtEvent($event[0],$_SESSION['user_id'])?'checked':'')).' >
                    <label class="form-check-label" for="'.$event[0].'" id="'.$event[0].'" >'.$event[1].((isset($event[2])?', godzina: '.date("G:i",strtotime($event[2])):'')).
                    ($mod->isUserAtEvent($event[0],$_SESSION['user_id'])?'<a class="linkChange" href="/">zmień</a>':'').
                    '</label>
                </div>';
            }
            echo '
            </li>
    </ul>';
                
}
echo '<ul class="list-group list-group-flush>
        <li class="list-group-item">
        <a href="https://zste.pl/images/stories/PDFy/dniotwarte/Regulamin_konkursu.pdf">Regulamin</a>
        </br>';
echo '<button type="submit" class="btn btn-primary">Zatwierdź</button></li>' ;
echo '</ul></form>';
?>
<div class="card-body">
</div>
</div>
<script>
    var multiples = document.getElementsByClassName("multiple");
        for(let one of multiples){
            one.addEventListener('change', function(){
                var chks = one.getElementsByTagName("INPUT");
                for (var i = 0; i < chks.length; i++) {
                chks[i].onclick = function () {
                for (var i = 0; i < chks.length; i++) {
                    if (chks[i] != this && this.checked) {
                        chks[i].checked = false;
                    }
                }
            };
        }
            });
    }
    var eventVoleyBall;
    for (let item of document.getElementsByTagName('input'))
        {(item.type=="checkbox"&item.id=='18')?eventVoleyBall=item:'';}

    eventVoleyBall.addEventListener('change',function(){
        for(let item of document.getElementsByTagName('input')){
                if(item!=this)
                item.checked = false;
        }
        }
    );
    var input = document.getElementsByTagName('input');
    for(let item of input){
        item.addEventListener('change',function(){
            if(item!=eventVoleyBall){
                eventVoleyBall.checked = false;
            }
        });
    }
    var checkBoxes = document.getElementsByClassName('form-check-input');
    var linkChanges = document.getElementsByClassName("linkChange");
    document.getElementById("form").addEventListener("submit", function(){ 
        for (let item of checkBoxes){
                item.disabled = false;
            }
    });
    for(let link of linkChanges){
        link.addEventListener('click', function(e){ e.preventDefault();
            for (let item of checkBoxes){
                item.disabled = false;
                item.checked = false;
            }
            link.style.color = "gray"; });
        }
    
    
</script>

