<?php
namespace App;

class Router {

  protected $get;

  protected $post;

  protected $put;

  protected $delete;

  protected $option;

  public function __construct(){
    $this->router  = new \Slim\Slim();
    $methods = ['get','post','put', 'delete', 'option'];

    foreach( $methods as $method ){
      $this->parseRoutes( $method );
    }

    $this->router->run();
  }

  public function parseRoutes( $method ){
    $obj = $this;

    foreach ( $this->{$method} as $route => $action ) {
      return call_user_func(
        array( $this->router, $method ),
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
        return echo json_encode( $result );
      } catch (Exception $e) {
        return echo $e->getMessage();
      }

    };
  }

}
