<?php

class regiondataActions extends sfActions
{

  /**
   * Acción GetRegiones
   * Devuelve la lista de regiones.
   * @return jSON   Array Lista de Regiones
   */
  public function executeGetRegiones(sfWebRequest $request) {
    $regiones = RegionTable::getInstance()->findAll();
    $list = array();
    foreach ($regiones as $r) {
      $list[$r->getId()] = $r->__toString();
    }
    return $this->renderText(json_encode($list));
  }

  /**
   * Acción GetProvincias
   * Devuelve la lista de provincias de una región
   * @param sfWebRequest $request Objeto Request para recibir el ID de la región
   * @return jSON     Array, lista de Provincias dada una región
   */
  public function executeGetProvincias(sfWebRequest $request) {
    $provincias = ProvinciaTable::getInstance()->findBy('region_id',$request->getParameter('region_id'));
    $list = array();
    foreach ($provincias as $p) {
      $list[$p->getId()] = $p->__toString();
    }
    return $this->renderText(json_encode($list));
  }


  /**
   * Acción GetComunas
   * Devuelve la lista de comunas de una provincia
   * @param  sfWebRequest $request Objeto Request, para recibir el ID de la provincia
   * @return jSON                Array, lista de regiones de la provincia
   */
  public function executeGetComunas(sfWebRequest $request) {
    $comunas = ComunaTable::getInstance()->findBy('provincia_id',$request->getParameter('provincia_id'));
    $list = array();
    foreach ($comunas as $c) {
      $list[$c->getId()] = $c->__toString();
    }
    return $this->renderText(json_encode($list));
  }
}