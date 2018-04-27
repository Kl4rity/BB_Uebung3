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
        
        $data;
        
        print_r(array_keys($_GET));
        
        $data = $listModel->listProjects();
        
        // TODO Differentiate between different URLs
        
        // TODO Route depending on params given
        
        $this->formatAndDisplayData($data);
    }
    
    private function formatAndDisplayData($data){
        
        $projectsList = array();
        
        foreach($data as $dbEntry){
            $projectsList[] = array(
                "name"=> $dbEntry['name'], 
                "url"=> "http://".$_SERVER["SERVER_NAME"]."/Uebung3/index.php?listtype=FLOORS&parentid=".$dbEntry['id']
            );
        }
        $outputData = array (
            "listtype" => "Projects",
            "items" => $projectsList
        );
        $this->jsonView->streamOutput($outputData);
    }
}
