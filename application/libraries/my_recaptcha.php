<?php

if (!defined('BASEPATH'))
   exit('No direct script access allowed');

class My_RECAPTCHA {

   public function My_RECAPTCHA() {
       require_once('recaptcha-php-1.11/recaptchalib.php');
   }

}

?>