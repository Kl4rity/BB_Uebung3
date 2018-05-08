<?php
/**
 * @author helmuth
 */
class ListController {
   
    private $jsonView;
   
    public function __construct() {
        $this->jsonView = new JsonView();
    }
    
    public function route(){
        $listModel = new ListModel();
        
        $listData;
        
        // Checks whether a listtype was given - provides a default (PROJECTS) if none was given.
        if (!array_key_exists("listType", $_GET)){
            $requestParams["listType"] = "PROJECTS";
        } else {
            $requestParams["listType"] = $_GET["listType"];   
        }
        
        // Checks whether parentID exists and provides a default if it doesn't
        if (!array_key_exists("parentID", $_GET)){
            $requestParams["parentID"] = "NONE";
        } else {
            $requestParams["parentID"] = $_GET["parentID"];
        }
                
        $listData = $listModel->getList($requestParams);
        
        $this->formatAndDisplayData($listData);
    }
    
    private function formatAndDisplayData($listData){

        $list = array();
        
        foreach($listData["queryData"] as $dbEntry){
            // Generate holder for all the data fetched.
            $listEntry = array();
            // Get names for attribtues in table
            foreach(array_keys(array_unique($dbEntry)) as $rowName){
                // Fetch all data returned from SQL Query and fill it in
                $listEntry[$rowName] = $dbEntry[$rowName];
            }
            // Generate and attach URL for further navigation (if not at last level already)
            if($listData["nextLevel"] != "NONE"){
                $listEntry["url"] = "http://".$_SERVER["SERVER_NAME"]."/Uebung3/index.php?listType=".$listData["nextLevel"]."&parentID=".$dbEntry['id'];
            }
            $list[] = $listEntry;
        }
        $outputData = array (
            "listtype" => $listData["currentLevel"],
            "items" => $list
        );
        $this->jsonView->streamOutput($outputData);
    }
}
