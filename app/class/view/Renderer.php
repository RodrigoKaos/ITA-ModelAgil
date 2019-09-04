<?php

namespace View;

class Renderer {

  public function load($templatePath) {
    return file_get_contents(TEMPLATE_PATH . $templatePath); 
  }

  public function parseData($template, $data = array()) {
    if($data != null){
      foreach ($data as $key => $value) {
        $template = str_replace("{".$key."}", $value, $template); 
      }
    }  
    return $template;
  }

  private function render($template) {
    eval(  "?>" . $template );
  }
    
  private function mountTemplate($templatePath){    
    $headerTemplate = $this->load('/includes/header.php');
    $contentTemplate = $this->load($templatePath);
    $footerTemplate = $this->load('/includes/footer.php');
    
    return $headerTemplate . $contentTemplate . $footerTemplate;
  }

  public function renderTemplate($templatePath, $data = array()){
    $view = $this->mountTemplate($templatePath);
    $view = $this->parseData($view, $data);
    $this->render($view);
  }

  public function loadAndParse($templatePath, $data){
    $templateAux = $this->load($templatePath);
      $templateAux = $this->parseData($templateAux, $data);
      return $templateAux;
  }

}