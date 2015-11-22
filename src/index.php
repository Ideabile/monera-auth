<?php
// Base requirements
require 'vendor/autoload.php';
require 'generated-conf/config.php';

use \App as App;

try{
  new App();
} catch(Exception $e){
  echo $e->getMessage();
}
