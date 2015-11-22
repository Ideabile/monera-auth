<?php
namespace App;

// Website
use Auth\Website\Website as Website;
use Auth\Website\WebsiteQuery as WebsiteQuery;

//Provider
use Auth\Provider\Provider as Provider;
use Auth\Provider\ProviderQuery as ProviderQuery;

// Gate
use Auth\Gate\Gate as Gate;
use Auth\Gate\GateQuery as GateQuery;

use \App\Router as Router;

// The App
class App extends Router {

  protected $user;

  protected $router;

  protected $hauth;

  /*
   * Todo:
   *  - get/post:gate:user/s
   *  - get/post:gate:role/s
   *  - get/post:gate:permission/s
   *  - get/post:gate:status/s
   */
  protected $get = [
    // 'get/:id_website/user' => 'getUser',
    // 'get/:id_website/users' => 'getUsers',
    // 'get/:id_website/role' => 'getRole',
    // 'get/:id_website/permissions' => 'getPermissions',
    '/auth/:id(/:try/)' => 'auth'
  ];

  protected $post = [
    // 'create/website' => 'createWebsite',
    // 'create/:website_id/gate' => 'createGate',
    // 'create/:website_id/role' => 'createRole',
    // 'create/:website_id/permission' => 'createRole',
    // 'create/:website_id/status' => 'createRole'
  ];

  protected $put = [
    // 'create/website' => 'createWebsite',
    // 'create/:website_id/gate' => 'createGate',
    // 'create/:website_id/role' => 'createRole',
    // 'create/:website_id/permission' => 'createRole',
    // 'create/:website_id/status' => 'createRole'
  ];

  protected $delete = [];

  public function __construct(){
    session_start();
    parent::__construct();
  }

  public function auth($id = false, $try = null){
    try{
      $gate = GateQuery::create()->findPk($id);
      $this->hauth = new Hybrid_Auth( $this->getHibrydConfig($gate) );
      if($try) return Hybrid_Endpoint::process();
      $this->logged = $this->hauth->authenticate( $gate->getProvider()->getName() );

      return $this->logged ->getUserProfile();

    }catch(Exception $e){
      return $e;
    }
  }

  private function getHibrydConfig(Gate $gate){
    if(!$gate) return [];
    $provider = $gate->getProvider()->getName();
    return [
       "base_url" => 'http://'.$_SERVER['HTTP_HOST'].'/auth/'.$gate->getId().'/logged/',
           "providers" => [
               $provider => [
                 "enabled" => true,
                 "keys" => [ "id" => $gate->getKey(), "secret" => $gate->getSecret() ],
                 "wrapper" => [ "path" => "./vendor/hybridauth/hybridauth/additional-providers/hybridauth-github/Providers/GitHub.php", "class" => "Hybrid_Providers_GitHub" ]
             ]
       ]
    ];
  }


}
