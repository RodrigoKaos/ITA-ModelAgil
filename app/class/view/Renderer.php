<?php

namespace View;

class Renderer {
    
  private $templateFile;

  public function __construct($template, $data = array()) {

    if(!file_exists(TEMPLATE_PATH . $template)){
      $template = '/404.php';
    }
    
    $this->mountTemplate($template);
    $this->ParseData($data);
    $this->render();
  }

  private function load($templatePath) {
    return file_get_contents(TEMPLATE_PATH . $templatePath); 
  }

  private function parseData($args) {
    if(args != null){
      foreach ($args as $key => $value) {
        $this->templateFile = str_replace("{".$key."}", $value, $this->templateFile); 
      }
    }  
  }

  private function render() {
    eval(  "?>" . $this->templateFile );
  }
    
  private function mountTemplate($templatePath){
    
    $headerTemplate = $this->load('/header.php');
    $contentTemplate = $this->load($templatePath);
    $footerTemplate = $this->load('/footer.php');
    
    $this->templateFile = $headerTemplate . $contentTemplate . $footerTemplate;
  }

}