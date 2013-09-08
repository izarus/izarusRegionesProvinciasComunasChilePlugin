<?php

/**
 * izarusRegionesProvinciasComunasChilePlugin configuration.
 * 
 * @package    izarusRegionesProvinciasComunasChilePlugin
 * @subpackage config
 * @author     David Vega
 * @version    
 */
class izarusRegionesProvinciasComunasChilePluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if ( sfConfig::get('app_izarus_comunas_plugin_routes_register', true) )
    {
      $this->dispatcher->connect('routing.load_configuration', array('comunasPluginRouting', 'listenToRoutingLoadConfigurationEvent'));
    }

    foreach (array('comunas','regiones','provincias') as $module)
    {
      if (in_array($module, sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('comunasPluginRouting', 'addRouteFor'.$module));
      }
    }
  }
}