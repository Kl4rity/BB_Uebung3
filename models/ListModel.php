<?php
/**
 * @author helmuth
 */
class ListModel {
    
    private $database;
    
    public function __construct() {
        $this->database = new Database(DBHost, DBName, DBUser, DBPass);
    }
    
    public function getList($requestParams){
        $parentID = $requestParams["parentID"];
        
        switch($requestParams["listType"]):
            case "projects":
                return listProjects();
            case "floors":
                return listFloors($parentID);
            case "rooms":
                return listRooms($parentID);
            case "devices":
                return listDevices($parentID);
            case "sensors":
                return listSensors($parentID);
        endswitch;
    }
    
    // TODO create public function generateQuery(){}
    // Should take a keyword and, if necessary, a parentId
    // argument should be a dictionary with 2 entries  -listtype and parentID
    
    private function listProjects(){
        $sql = " SELECT id, name FROM projects ";
        return $this->database->query($sql);
    }
    
    private function listFloors($parentID){
        $sql = " SELECT id, name, floor_count_from_basement, created FROM floors WHERE projects_id = " . $parentID . " ";
        return $this->database->query($sql);
    }
    
    private function listRooms($parentID){
        $sql = " SELECT id, name, created FROM rooms WHERE floors_id = " . $parentID . " ";
        return $this->database->query($sql);
    }
    
    private function listDevices($parentID){
        $sql = " SELECT id, name, created FROM devices WHERE rooms_id = " . $parentID . " ";
        return $this->database->query($sql);
    }
    
    private function listSensors($parentID){
        $sql = " SELECT id, name, unit, value, created FROM sensors WHERE devices_id = " . $parentID . " ";
        return $this->database->query($sql);
    }
}
