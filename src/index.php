<?php
// Base requirements
require 'vendor/autoload.php';
require 'generated-conf/config.php';

// Name spaces
use Auth\Gate\GateQuery as GateQuery;

if( !isset($_SESSION) ){
  session_start();
}

function getConfig($gate_id, $provider_name, $key, $secret){
  return [
     "base_url" => 'http://'.$_SERVER['HTTP_HOST'].'/login/'.$gate_id.'/'.$provider_name.'/something',
         "providers" => [
           $provider_name => [
               "enabled" => true,
               "keys" => [ "id" => $key, "secret" => $secret ],
               "wrapper" => [ "path" => "./vendor/hybridauth/hybridauth/additional-providers/hybridauth-github/Providers/GitHub.php", "class" => "Hybrid_Providers_GitHub" ]
           ]
     ]
  ];
}

// Start Slim App
$app = new \Slim\Slim();

// Get Gate
$app->get('/login/:gate_id(/:provider(/:time))', function($gate_id = false, $provider_id = false, $time = false) use($app){
    try{
      $gate = GateQuery::create()->findPk($gate_id);
      $website = $gate->getWebsite();
      $provider = $gate->getProvider();
      $provider_name =$provider->getName();

      $config_array = getConfig($gate_id, $provider_name, $gate->getKey(), $gate->getSecret());
      $hybridauth = new Hybrid_Auth( $config_array );


      if ( $provider_id || $time){
          return Hybrid_Endpoint::process($request = array(
              'hauth_start' => $provider_id,
              'hauth_time' => $time
            ));
      }else{
        $adapter = $hybridauth->authenticate( $provider_name );
      }

  		// then grab the user profile
  		$user_profile = $adapter->getUserProfile();
      var_dump($user_profile);

    }catch( Exception $e ){
      print_r($e);
      echo $e->getMessage();
    }
});

// Home
$app->get('/', function () {
    echo "Welcome to the auth service";
});

$app->run();
