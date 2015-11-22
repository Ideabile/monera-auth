<?php

// Base requirements
require 'vendor/autoload.php';
require 'generated-conf/config.php';

use Nelmio\Alice\Fixtures\Fixture as Fixture;
use Nelmio\Alice\Fixtures\Loader as FixturesLoader;
use Nelmio\Alice\Instances\Instantiator\Methods\MethodInterface as Instantiator;

class PropelInstantiator implements Instantiator{
  public function __constructor(){
    var_dump(func_get_args());
  }

  public function canInstantiate(Fixture $fixture){
    // var_dump($fixture);
    return false;
  }

  public function instantiate(fixture $fixture){
    var_dump($fixture);
  }
}

$loader = new FixturesLoader();

$loader->addInstantiator(new PropelInstantiator());

$objs = $loader->load(__DIR__.'/fixtures.yml');
var_dump($objs);
