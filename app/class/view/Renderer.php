<?php

namespace View;

class Renderer {
    
  // private $templateFile;

  // public function __construct($template, $data = array()) {

  //   if(!file_exists(TEMPLATE_PATH . $template)){
  //     $template = '/404.php';
  //   }
    
  //   $this->mountTemplate($template);
  //   $this->ParseData($data);
  //   $this->render();
  // }

  public static function load($templatePath) {
    return file_get_contents(TEMPLATE_PATH . $templatePath); 
  }

  public static function parseData($template, $data) {
    if($data != null){
      foreach ($data as $key => $value) {
        $template = str_replace("{".$key."}", $value, $template); 
      }
      return $template;
    }  
  }

  public static function render($template) {
    eval(  "?>" . $template );
  }
    
  public static function mountTemplate($templatePath){
    
    $headerTemplate = self::load('/header.php');
    $contentTemplate = self::load($templatePath);
    $footerTemplate = self::load('/footer.php');
    
    return $headerTemplate . $contentTemplate . $footerTemplate;
  }

}