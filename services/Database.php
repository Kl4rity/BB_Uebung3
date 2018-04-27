<?php

/**
 * Description of Database
 *
 * @author helmuth
 */
class Database extends PDO{
    private $pdo;
    
    public function __construct($dbHost, $dbName, $dbUser,$dpPass){
        $this->pdo = new PDO("mysql:host=".$dbHost.";dbname=".$dbName.";charset=utf8", $dbUser, $dpPass);
    }

    public function query( $sql){
        $resultTable = array();
        
        try{
            foreach ($this->pdo->query($sql) as $row) {
                $resultTable[] = $row;
                echo("DB");
                print_r($row);
            }
        } catch (PDOException $ex){
            error_log("PDO ERROR: querying database: " . $ex->getMessage()."\n".$sql);
            return $resultTable;
        }
        
        return $resultTable;
    }
}
