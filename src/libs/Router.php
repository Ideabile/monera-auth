<?php
namespace App;

class Router {

  protected $get = [];

  protected $post = [];

  protected $put = [];

  protected $delete = [];

  protected $option = [];

  public function __construct(){
    $this->router  = new \Slim\Slim();
    $methods = ['get','post','put', 'delete', 'option'];

    foreach( $methods as $method ){
      $this->parseRoutes( $method );
    }

    $this->router->run();
  }

  public function parseRoutes( $method ){
    foreach ( $this->{$method} as $route => $action ) {
      call_user_func(
        array( $this->router, 'add' ),
        $route, $this->getAction( $action )
      );
    }
  }

  public function getAction( $action ){
    $obj = $this;

    return function() use ( $obj, $action ){
      $args = func_get_args();
      try {
        $result = call_user_func_array( array( $obj, $action ), $args );
        return var_dump(json_encode( $result ));
      } catch (Exception $e) {
        return var_dump($e->getMessage());
      }

    };
  }

}
