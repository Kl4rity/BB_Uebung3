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
            case "PROJECTS":
                return $this->listProjects();
            case "FLOORS":
                return $this->listFloors($parentID);
            case "ROOMS":
                return $this->listRooms($parentID);
            case "DEVICES":
                return $this->listDevices($parentID);
            case "SENSORS":
                return $this->listSensors($parentID);
            default:
                $this->pageNotFound();
                break;
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
    
    private function pageNotFound(){
        echo "The page was not found. Please try a different URL.";
    }
}
