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
        $result = array();
        try{
            //iterieren für alle moeglichen zeilen
            foreach ($this->database->query($sql) as $row) {
                $result[] = $row; //die Zeile in den Array schreiben
            }
        } catch (PDOException $ex){
            //error handling, wenn der query schief ging
            error_log("PDO ERROR: querying database: " . $ex->getMessage()."\n".$sql);
        }
        
        return $result;
    }
    
}
