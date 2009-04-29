<?php
/*
 * Model Lazy Load
 * Copyright (c) 2009 Matt Curry
 * http://www.pseudocoder.com/archives/2009/04/17/on-the-fly-model-chains-with-cakephp/
 *
 * This is my second attempt at this.
 * This code posted by jose_zap on bin.cakephp.org provided inspiration for this revised version
 * http://bin.cakephp.org/saved/39855
 *
 * @author      Matt Curry <matt@pseudocoder.com>
 * @license     MIT
 *
 */
 
class LazyAppModel extends Model {
  function __isset($name) {
    foreach ($this->__associations as $type) {
      if(array_key_exists($name, $this->{$type})) {
        parent::__constructLinkedModel($name, $this->{$type}[$name]['className']);
        parent::__generateAssociation($type);
        return $this->{$name};
      }
    } 
    
    return false;
  }
  
  function __get($name) {
    if(isset($this->{$name})) {
      return $this->{$name};
    }
    
    return false;
  }
  
  function __constructLinkedModel($assoc, $className = null) {
    foreach ($this->__associations as $type) {
      if(!isset($this->{$type}[$assoc])) {
        return;
      }
    }
    
    return parent::__constructLinkedModel($assoc, $className);
  }
  
  function resetAssociations() {
    return true;
  }
}
?>