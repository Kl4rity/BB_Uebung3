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
        $data = $listModel->listProjects();
        
        $this->formatAndDisplayData($data);
    }
    
    private function formatAndDisplayData($data){
        
        $projectsList = array();
        
        foreach($data as $dbEntry){
            $projectsList[] = array(
                "name"=> $dbEntry['name'], 
                "url"=> "http://localhost/Uebung3/index.php?listtype=FLOORS&parentid=".$dbEntry['id']
            );
        }
        $outputData = array (
            "listtype" => "Projects",
            "items" => $projectsList
        );
        $this->jsonView->streamOutput($outputData);
    }
    
}
