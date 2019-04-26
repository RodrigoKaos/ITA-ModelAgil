<?php

namespace View;

class Renderer {
    
  private $templateFile;

  public function __construct($template, $data = null) {
    if(!file_exists($template)){
      $template = 'app/pages/404.php';
    }
    
    $this->mountTemplate($template);
    $this->ParseData($data);
    $this->render();
  }

  private function load($templatePath) {
    return file_get_contents($templatePath); 
  }

  private function parseData($args) {
    if(args != null){
      foreach ($args as $key => $value) {
        echo $key . " - " . $value . "<br>";
        $this->templateFile = str_replace("{".$key."}", $value, $this->templateFile); 
      }
    }  
  }

  private function render() {
    eval( "?>" . $this->templateFile);
  }
    
  private function mountTemplate($templatePath){
    
    $headerTemplate = $this->load('app/pages/header.test.php');
    $contentTemplate = $this->load($templatePath);
    $footerTemplate = $this->load('app/pages/footer.php');
    
    $this->templateFile = $headerTemplate . $contentTemplate . $footerTemplate;
  }

}