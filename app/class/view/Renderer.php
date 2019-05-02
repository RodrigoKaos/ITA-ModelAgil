<?php

namespace View;

class Renderer {

  public static function load($templatePath) {
    return file_get_contents(TEMPLATE_PATH . $templatePath); 
  }

  public static function parseData($template, $data = array()) {
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
    $headerTemplate = self::load('/includes/header.php');
    $contentTemplate = self::load($templatePath);
    $footerTemplate = self::load('/includes/footer.php');
    
    return $headerTemplate . $contentTemplate . $footerTemplate;
  }

  public static function renderTemplate($templatePath, $data = array()){
    $view = self::mountTemplate($templatePath);
    $view = self::parseData($view, $data);
    self::render($view);
  }

  public static function loadAndParse($templatePath, $data){
    $templateAux = Renderer::load($templatePath);
      $templateAux = Renderer::parseData($templateAux, $data);
      return $templateAux;
  }

}