<?php
/**
 * @author helmuth
 */
class ListModel {
    
    private $database;
    
    public function __construct() {
        $this->database = new Database(DBHost, DBName, DBUser, DBPass);
    }
    
    public function listProjects(){
        $sql = " SELECT id, name FROM projects ";
        return $this->database->query($sql);
    }
}
