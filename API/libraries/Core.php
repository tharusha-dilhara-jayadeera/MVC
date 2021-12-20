
<?php


class Core{
    protected $currentController = 'index';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      //print_r($this->getUrl());
      
      $url = $this->getUrl();
    
    
      if(!empty($url[0])){ 


      // Look in BLL for first value
      if(file_exists('../API/pages/' . ucwords($url[0]). '.php')){
        // If exists, set as controller
        $this->currentController = ucwords($url[0]);
        // Unset 0 Index
        unset($url[0]);
      }

      // Require the controller
      require_once '../API/pages/'. $this->currentController . '.php';

    }else{

        echo json_encode(array('massage' => 'not found url to access'));
        http_response_code(404);
    }


    }

    public function getUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  }



  ?>
