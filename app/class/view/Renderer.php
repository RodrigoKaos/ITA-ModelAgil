<?php

namespace View;

class Renderer {
    
  private $templateFile;

  public function __construct($template = "app/pages/404.php", $data = null) {
    if(file_exists($template)){
      $this->load($template);
      $this->ParseData($data);
      $this->render();
    }else{
      echo "Not Found";
    }
  }

  private function load($templatePath) {
    $templateFile = fopen($templatePath, "r");
    var_dump($templateFile);
    if($templateFile != null){
      $this->templateFile = fread($templateFile, filesize($templatePath));
    }
  }

  private function parseData($args) {
    if(args != null){
      foreach ($args as $key => $value) {
        $this->templateFile = str_replace("{".$key."}", $value, $this->templateFile); 
      }
    }  
  }

  private function render() {
    var_dump( $this->templateFile );
  }

}