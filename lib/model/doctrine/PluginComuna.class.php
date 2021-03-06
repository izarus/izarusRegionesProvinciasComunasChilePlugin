<?php

/**
 * PluginComuna
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginComuna extends BaseComuna
{
  public function __toString() {
    return ($this->getId())? $this->getNombre():'No especificada.';
  }

  public function getNombreConRegion($separador = ', ') {
    return $this->getNombre() . $separador . $this->getProvincia()->getRegion()->__toString();
  }
}
