<?php
App::import('Model', 'LazyLoader.app_model');

class Tag extends LazyLoaderAppModel {
	var $name = 'Tag';
  
  var $hasAndBelongsToMany = array('Post' => array('joinTable' => 'posts_tags',
                                                   'associationForeignKey' => 'post_id'));
}

class Category extends LazyLoaderAppModel {
	var $name = 'Category';
  
  var $hasMany = array('Post');
}

class Post extends LazyLoaderAppModel {
	var $name = 'Post';
  
  var $hasAndBelongsToMany = array('Tag' => array('joinTable' => 'posts_tags',
                                                  'associationForeignKey' => 'tag_id'));
  var $belongsTo = array('Category');
}

class LazyLoaderTestCase extends CakeTestCase {
  var $Post = null;
  var $fixtures = array('plugin.lazy_loader.post',
                        'plugin.lazy_loader.tag',
                        'plugin.lazy_loader.category',
                        'plugin.lazy_loader.posts_tag');

  function start() {
    parent::start();
    $this->Post = & ClassRegistry::init('Post');
  }

  function testPostInstance() {
    $this->assertTrue(is_a($this->Post, 'Post'));
  }
  
  function testNoAssociations() {
    $this->assertFalse(property_exists($this->Post, 'Category'));
    $this->assertFalse(property_exists($this->Post, 'Tag'));
  }
  
  function testNoAssociationsHabtm() {
    $this->assertFalse(property_exists($this->Post, 'Tag'));
  }
  
  function testLazyBinding() {
    $this->assertFalse(property_exists($this->Post, 'Category'));
    $this->Post->Category;
    $this->assertTrue(property_exists($this->Post, 'Category'));
    $this->assertTrue(is_a($this->Post->Category, 'Category'));
  }
  
  function testLazyBindingHabtm() {
    $this->assertFalse(property_exists($this->Post, 'Tag'));
    $this->Post->Tag;
    $this->assertTrue(property_exists($this->Post, 'Tag'));
    $this->assertTrue(is_a($this->Post->Tag, 'Tag'));
    $this->assertTrue(property_exists($this->Post, 'PostsTag'));
    $this->assertTrue(is_a($this->Post->PostsTag, 'AppModel'));
  }
  
  function testContain() {
    ClassRegistry::removeObject('Post');
    $this->Post = & ClassRegistry::init('Post');
    $this->assertFalse(property_exists($this->Post, 'Category'));
    $results = $this->Post->find('all');
    $this->assertFalse(property_exists($this->Post, 'Category'));
    $this->assertEqual(array('Post'), array_keys($results[0]));
  }
  
  function testContainLazyBinding() {
    ClassRegistry::removeObject('Post');
    $this->Post = & ClassRegistry::init('Post');
    $this->assertFalse(property_exists($this->Post, 'Category'));
    $this->Post->contain('Category');
    $this->assertFalse(property_exists($this->Post, 'Category'));
    $results = $this->Post->find('all');
    $this->assertTrue(property_exists($this->Post, 'Category'));
    $this->assertTrue(is_a($this->Post->Category, 'Category'));
    $this->assertEqual(array('Post', 'Category'), array_keys($results[0]));
  }
  
  function testContainLazyBindingResetFalse() {
    ClassRegistry::removeObject('Post');
    $this->Post = & ClassRegistry::init('Post');
    $this->Post->contain(array('Category', 'Tag'), false);
    $results = $this->Post->find('all');
    $this->assertEqual(array('Post', 'Category', 'Tag'), array_keys($results[0]));
  }
  
  function testContainLazyBindingHabtm() {
    ClassRegistry::removeObject('Post');
    $this->Post = & ClassRegistry::init('Post');
    $this->assertFalse(property_exists($this->Post, 'Tag'));
    $this->Post->contain('Tag');
    $this->assertFalse(property_exists($this->Post, 'Tag'));
    $results = $this->Post->find('all');
    $this->assertTrue(property_exists($this->Post, 'Tag'));
    $this->assertTrue(is_a($this->Post->Tag, 'Tag'));
    $this->assertEqual(array('Post', 'Tag'), array_keys($results[0]));
  }
}