<?php

/**
 *
 * @package    
 * @subpackage 
 * @author     
 * @version    
 */
class comunasPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    
  }
  
  /**
   * Adds an sfDoctrineRouteCollection collection to manage comunas.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForcomunas(sfEvent $event)
  {
    $event->getSubject()->prependRoute('comunas', new sfDoctrineRouteCollection(array(
      'name'                => 'comunas',
      'model'               => 'Comuna',
      'module'              => 'comunas',
      'prefix_path'         => 'comunas',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  /**
   * Adds an sfDoctrineRouteCollection collection to manage regiones.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForregiones(sfEvent $event)
  {
    $event->getSubject()->prependRoute('regiones', new sfDoctrineRouteCollection(array(
      'name'                => 'regiones',
      'model'               => 'Region',
      'module'              => 'regiones',
      'prefix_path'         => 'regiones',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  /**
   * Adds an sfDoctrineRouteCollection collection to manage provincias.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForprovincias(sfEvent $event)
  {
    $event->getSubject()->prependRoute('provincias', new sfDoctrineRouteCollection(array(
      'name'                => 'provincias',
      'model'               => 'Provincia',
      'module'              => 'provincias',
      'prefix_path'         => 'provincias',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

}

