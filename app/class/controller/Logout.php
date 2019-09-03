<?php

namespace Controller;

use Network\IhttpGet;

class Logout implements IhttpGet
{
    public static function get($args) {
      session_start();
      session_destroy();
      header("Location: /");
    }
}