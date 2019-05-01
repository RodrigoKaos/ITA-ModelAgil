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
    $headerTemplate = self::load('/header.php');
    $contentTemplate = self::load($templatePath);
    $footerTemplate = self::load('/footer.php');
    
    return $headerTemplate . $contentTemplate . $footerTemplate;
  }

  public static function renderTemplate($templatePath, $data = array()){
    $view = self::mountTemplate($templatePath);
    $view = self::parseData($view, $data);
    self::render($view);
  }

}