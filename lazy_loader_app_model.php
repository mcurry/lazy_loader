<?php
/*
 * CakePHP Lazy Loader Plugin
 * Copyright (c) 2009 Matt Curry
 * http://www.pseudocoder.com/archives/2009/04/27/github-updates
 *
 * This is my second attempt at this.
 * The code posted by jose_zap (José Lorenzo - http://joselorenzo.com.ve/)
 * on bin.cakephp.org provided inspiration for this revised version
 * http://bin.cakephp.org/saved/39855
 *
 * @author      Matt Curry <matt@pseudocoder.com>
 * @license     MIT
 *
 */
 
class LazyLoaderAppModel extends AppModel {
  var $__backInnerAssociation = array();
  
  function __isset($name) {
    $className = false;
    
    foreach ($this->__associations as $type) {
      if (array_key_exists($name, $this-> {$type})) {
        $className = $this-> {$type}[$name]['className'];
        break;
      }
      if($type == 'hasAndBelongsToMany') {
        $withs = Set::extract('/with', array_values($this-> {$type}));
        if(in_array($name, $withs)) {
          $className = $name;
          break;
        }
      }
    }
    
    if($className) {
      parent::__constructLinkedModel($name, $className);
      parent::__generateAssociation($type);
      return $this-> {$name};
    }

    return false;
  }

  function __get($name) {
    if (isset($this-> {$name})) {
      return $this-> {$name};
    }

    return false;
  }

  function __constructLinkedModel($assoc, $className = null) {
    foreach ($this->__associations as $type) {
      if (isset($this-> {$type}[$assoc])) {
        return;
      }
      if($type == 'hasAndBelongsToMany') {
        $withs = Set::extract('/with', array_values($this-> {$type}));
        if(in_array($assoc, $withs)) {
          return;
        }
      }
    }

    return parent::__constructLinkedModel($assoc, $className);
  }

  function resetAssociations() {
    return true;
  }
}
?>