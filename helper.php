<?php

class Helper
{
    public function checkLogin($login){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('login'))
                    ->from($db->quoteName('#__rekrutacja'))
                    ->where($db->quoteName('login'). ' = ' . $db->Quote($login));
        $db->setQuery($query);
        $result = $db->loadResult();
        return (isset($result))? true: false;
    }   
    
    public function active($id){
        $this->updateActive($id, 1);
    }

    public function disable($id){
        $this->updateActive($id, 0);
    }
    public function back(){
        echo '<script>window.history.back();</script>';
    }
    public function backT($time){
        sleep($time);
        $this->back();
    }
    public function updateActive($id, $state){
        $object = new stdClass();
        $object->id = $id;
        $object->active = $state;
        JFactory::getDbo()->updateObject('#__rekrutacja', $object, 'id');
    }
    public function addEvent($post){
        $arrayPost = array($post);
        $data = new stdClass();
        $data->id = null;
        $data->name = $arrayPost[0]['name'];
        $data->id_grkonkursy = $arrayPost[0]['idgr'];
        $data->timeOfEvent = $arrayPost[0]['timeOfEvent'];
        $db = JFactory::getDBO();
        $db->insertObject('#__konkursy',$data,id);
    }
    public function eventGroup(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName(array('id','onlyOnce')))
                    ->from($db->quoteName('#__grkonkursy'));    
        $db->setQuery($query);
        $result = $db->loadRowList();
        return $result;
    }
    public function eventAssignTGroup($groupId){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('id'))
                    ->from($db->quoteName('#__konkursy'))
                    ->where($db->quoteName('id_grkonkursy'). ' = ' . $db->Quote($groupId));    
        $db->setQuery($query);
        $result = $db->loadRowList();
        return $result;
    }
    public function groupAssignTEvent($eventID){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('id_grkonkursy'))
                    ->from($db->quoteName('#__konkursy'))
                    ->where($db->quoteName('id'). ' = ' . $db->Quote($eventID));    
        $db->setQuery($query);
        $result = $db->loadRowList();
        return $result;
    }

    public function addEventGroup(){
        $data = new stdClass();
        $data->id = null;
        $db = JFactory::getDBO();
        $db->insertObject('#__grkonkursy',$data,id);
    }
    public function assignEvent($event,$user){
        $arrayPost = array($post);
        $data = new stdClass();
        $data->id = null;
        $data->id_rekrutacja = $user;
        $data->id_konkursy = $event;
        $db = JFactory::getDBO();
        $db->insertObject('#__przypisane',$data,id);
    }
    public function removeAssignEvent($event,$user){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $conditions = array(
            $db->quoteName('id_konkursy') . ' = ' . $event . ' and '. 
            $db->quoteName('id_rekrutacja') . ' = ' . $user);
        $query->delete($db->quoteName('#__przypisane'));
        $query->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();
    }
    
    public function getIdEvent($name){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('id'))
                    ->from($db->quoteName('#__konkursy'))
                    ->where($db->quoteName('name'). ' LIKE ' . $db->Quote($name));
        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;
    }
    public function getNameEvent($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('name'))
                    ->from($db->quoteName('#__konkursy'))
                    ->where($db->quoteName('id'). ' = ' . $db->Quote($id));
        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;
    }
    public function eventAssign($userId){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('id_konkursy'))
                    ->from($db->quoteName('#__przypisane'))
                    ->where($db->quoteName('id_rekrutacja'). ' = ' . $db->Quote($userId));
        $db->setQuery($query);
        $result = $db->loadRowList();
        return $result;
    }
    public function isEventAssign($userId){
        $result = $this->eventAssign($userId);
        return (isset($result))? true : false;
    }
    public function isActive($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('active'))
                    ->from($db->quoteName('#__rekrutacja'))
                    ->where($db->quoteName('id'). ' = ' . $db->Quote($id));
        $db->setQuery($query);
        $result = $db->loadResult();
        return ($result == 1)? true : false;
    }
    public function console($log){
        echo '<script>console.log("'.$log.'")</script>';
    }
    public function removeUser($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $conditions = array(
            $db->quoteName('id') . ' = ' . $id
        );
        $query->delete($db->quoteName('#__rekrutacja'));
        $query->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();
    }
    public function removeEvent($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $conditions = array(
            $db->quoteName('id') . ' = ' . $id
        );
        $query->delete($db->quoteName('#__konkursy'));
        $query->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();
    }
    public function removeEventGroup($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $conditions = array(
            $db->quoteName('id') . ' = ' . $id
        );
        $query->delete($db->quoteName('#__grkonkursy'));
        $query->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();
    }

    public function register($post){
        $arrayPost = array($post);
        $data = new stdClass();
        $data->id = null;
        $data->login = $arrayPost[0]['login'];
        $data->password = password_hash($arrayPost[0]['password'], PASSWORD_BCRYPT);
        $data->tOfSchool = $arrayPost[0]['tOfSchool'];
        $data->tOfClass = $arrayPost[0]['tOfClass'];
        $data->schoolChoose = $arrayPost[0]['schoolChoose'];
        $data->schoolName = $arrayPost[0]['schoolName'];
        $db = JFactory::getDBO();
        $db->insertObject('#__rekrutacja',$data,id);
    }
    public function users(){
    $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName(array('id','login','active')))
                    ->from($db->quoteName('#__rekrutacja'));    
        $db->setQuery($query);
        $result = $db->loadRowList();
        return $result;
    }
    public function assignedEvents(){
        $db = JFactory::getDbo();
            $query = $db->getQuery(true)
                        ->select($db->quoteName(array('id','id_rekrutacja','id_konkursy')))
                        ->from($db->quoteName('#__przypisane'));    
            $db->setQuery($query);
            $result = $db->loadRowList();
            return $result;
        }
    public function events(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName(array('id','name','id_grkonkursy')))
                    ->from($db->quoteName('#__konkursy'));    
        $db->setQuery($query);
        $result = $db->loadRowList();
        return $result;
    }
    public function event($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName(array('id','name','timeOfEvent')))
                    ->from($db->quoteName('#__konkursy'))
                    ->where($db->quoteName('id_grkonkursy').' = '.$id);  
        $db->setQuery($query);
        $result = $db->loadRowList();   
        return $result;
    }
    public function redirect($path){
        echo '<script>window.location.replace("http://' . $_SERVER['HTTP_HOST'].'/dni_otwarte.html?nav='.$path.'");</script>';
    }
    public function redirectWithSuccess($path,$success){
        echo '<script>window.location.replace("http://' . $_SERVER['HTTP_HOST'].'/dni_otwarte.html?nav='.$path.'&success='.$success.'");</script>';
    }
    public function redirectWithError($path,$error){
        echo '<script>window.location.replace("http://' . $_SERVER['HTTP_HOST'].'/dni_otwarte.html?nav='.$path.'&error='.$error.'");</script>';
    }
    public function rmUser($user){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $conditions = array(
            $db->quoteName('login') . ' = "'.$user.'"', 
        );
        $query->delete($db->quoteName('#__rekrutacja'));
        $query->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();
    }

    public function getId($login){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('id'))
                    ->from($db->quoteName('#__rekrutacja'))
                    ->where($db->quoteName('login'). ' = ' . $db->Quote($login));
        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;
    }

    public function id($login){
        $result = $this->getId($login);
        return (isset($result))? true : false;
    }

    public function login($login,$password){ 
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('password'))
                    ->from($db->quoteName('#__rekrutacja'))
                    ->where($db->quoteName('login'). ' = ' . $db->Quote($login));
        $db->setQuery($query);
        $result = $db->loadResult();
        return (isset($result)&&password_verify($password,$result))? true : false;
    }
    
    public function isUserAtGroup($groupId,$userId){
        
        $userEvents = $this->eventAssign($userId);
        $groupEvents = $this->eventAssignTGroup($groupId);
        foreach($userEvents as $arrayEvent){
            foreach($arrayEvent as $user){
                foreach($groupEvents as $arrayEvent){
                    foreach($arrayEvent as $group){
                        if($user == $group){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }
    public function isUserAtEvent($eventID,$userId){
        $userEvents = $this->eventAssign($userId);
        foreach($userEvents as $arrayEvent){
            foreach($arrayEvent as $user){
                        if($user == $eventID){
                            return true;
                        }
                    }
        }
        return false;
    }

    public function updateGroupName($name,$id){
        $object = new stdClass();
        $object->id = $id;
        $object->nazwa = $name;
        JFactory::getDbo()->updateObject('#__grkonkursy', $object, 'id');
    }
    public function getGroupName($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('nazwa'))
                    ->from($db->quoteName('#__grkonkursy'))
                    ->where($db->quoteName('id'). ' = ' . $db->Quote($id));
        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;
    }
    public function onlyOnceState($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('onlyOnce'))
                    ->from($db->quoteName('#__grkonkursy'))
                    ->where($db->quoteName('id'). ' = ' . $db->Quote($id));
        $db->setQuery($query);
        $result = $db->loadResult();
        return ($result == 1)? true : false;
    }
    public function updateOnlyOnce($id, $state){
        $object = new stdClass();
        $object->id = $id;
        $object->onlyOnce = $state;
        JFactory::getDbo()->updateObject('#__grkonkursy', $object, 'id');
    }
    public function isNegativeNumber($number){
        return ($number<0)? true: false;
    }

    public function counterGroupEvent($groupID){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                    ->select($db->quoteName('id'))
                    ->from($db->quoteName('#__grkonkursy'));    
        $db->setQuery($query);
        $my_count = $db->query();
        $my_count = $db->getNumRows();
        return $my_count;
    }

}
?>