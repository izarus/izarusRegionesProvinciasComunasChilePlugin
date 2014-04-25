<?php

/**
 * izarusWidgetFormComuna
 *
 * Widget para seleccionar Region, luego Provincia y luego Comuna
 * utilizando AJAX y selects.
 *
 * @author David Vega Regollo <david@izarus.cl>
 *
 *
 * IMPORTANTE: ESTE WIDGET REQUIERE jCombo v3.0!!!!
 * /web/js/jCombo.min.js
 * Debe cargarse en la vista mediante <?php use_javascript(...) ?>
 *
 */
class izarusWidgetFormComuna extends sfWidgetForm {

  public function configure($options = array(), $attributes = array()){
    $this->addOption('comuna', array('model'=>'Comuna','add_empty' =>'- Seleccione Comuna -'));
    $this->addOption('provincia', array('model'=>'Provincia','add_empty' =>'- Seleccione Provincia -'));
    $this->addOption('region', array('model'=>'Region','add_empty' =>'- Seleccione Región -'));
  }

  public function render($name, $value = null, $attributes = array(), $errors = array()) {

    $prefix = str_replace('-', '_', $this->generateId($name));

    if ($value) {
      $comuna_obj = ComunaTable::getInstance()->find($value);
    }

    $comuna =  $this->getComunaWidget($attributes)->render($name,$value);
    $region =  $this->getRegionWidget($attributes)->render($prefix.'_region_id',($value)? $comuna_obj->getRegionId():null);
    $provincia =  $this->getProvinciaWidget($attributes)->render($prefix.'_provincia_id',($value)? $comuna_obj->getProvinciaId():null);

    sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

    $op_comuna = $this->getOptionsFor('comuna');
    $op_provincia = $this->getOptionsFor('provincia');
    $op_region = $this->getOptionsFor('region');

    return $region.'<br>'.$provincia.'<br>'.$comuna.
    sprintf(<<<EOF
<script>

jQuery(function (){
  // REGIONES
  jQuery('#%s').jCombo({
    url: '%s',
    initial_text: '%s',
    dataType: 'json',
    first_optval: '',
    selected_value: '%s'
  });

  // PROVINCIAS
  jQuery('#%s').jCombo({
    url: '%s',
    initial_text: '%s',
    dataType: 'json',
    parent: '#%s',
    first_optval: '',
    selected_value: '%s'
  });

  // COMUNAS
  jQuery('#%s').jCombo({
    url: '%s',
    initial_text: '%s',
    dataType: 'json',
    parent: '#%s',
    first_optval: '',
    selected_value: '%s'
  });
});

</script>
EOF
    ,
    $this->generateId($name.'_region_id'),
    url_for('regiondata/getRegiones'),
    $op_region['add_empty'],
    ($value)? $comuna_obj->getRegionId():'',
    $this->generateId($name.'_provincia_id'),
    url_for('regiondata/getProvincias?region_id='),
    $op_provincia['add_empty'],
    $this->generateId($name.'_region_id'),
    ($value)? $comuna_obj->getProvinciaId():'',
    $this->generateId($name),
    url_for('regiondata/getComunas?provincia_id='),
    $op_comuna['add_empty'],
    $this->generateId($name.'_provincia_id'),
    ($value)? $value:''
    );
  }

  /**
   * Devuelve un widget para la Comuna
   * @param  array  $attributes Array de atributos
   * @return sfWidgetForm             Widget con la lista de Comunas
   */
  protected function getComunaWidget($attributes = array()) {
    return new sfWidgetFormDoctrineChoice($this->getOptionsFor('comuna'),$this->getAttributesFor('comuna',$attributes));
  }

  /**
   * Devuelve un widget para elegir provincia
   * @param  array  $attributes Array de atributos del widget
   * @return sfWidgetForm             Widget con lista de Provincias
   */
  protected function getProvinciaWidget($attributes = array()) {
    return new sfWidgetFormDoctrineChoice($this->getOptionsFor('provincia'),$this->getAttributesFor('provincia',$attributes));
  }

  /**
   * Devuelve un widget para elegir región
   * @param  array  $attributes Arreglo de atributos
   * @return sfWidgetForm             Widget con lista de Regiones
   */
  protected function getRegionWidget($attributes = array()) {
    return new sfWidgetFormDoctrineChoice($this->getOptionsFor('region'),$this->getAttributesFor('region',$attributes));
  }

  /**
   * Returns an array of options for the given type.
   * @param  string $type  The type (region, provincia, comuna)
   * @return array  An array of options
   * @throws InvalidArgumentException when option region|provincia|comuna type is not array
   */
  protected function getOptionsFor($type)
  {
    $options = $this->getOption($type);
    if (!is_array($options))
    {
      throw new InvalidArgumentException(sprintf('Se debe pasar un arreglo (array) para la opcion %s.', $type));
    }

    return $options;
  }

  /**
   * Returns an array of HTML attributes for the given type.
   * @param  string $type        The type (region, provincia, comuna)
   * @param  array  $attributes  An array of attributes
   * @return array  An array of HTML attributes
   */
  protected function getAttributesFor($type, $attributes)
  {
    $defaults = isset($this->attributes[$type]) ? $this->attributes[$type] : array();
    return isset($attributes[$type]) ? array_merge($defaults, $attributes[$type]) : $defaults;
  }
}