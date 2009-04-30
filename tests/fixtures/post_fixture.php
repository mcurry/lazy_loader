<?php

class PostFixture extends CakeTestFixture {
	var $name = 'Post';

	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
    'category_id' => array('type' => 'integer'),
		'title' => array('type' => 'string', 'null' => false),
		'body' => 'text',
		'created' => 'datetime',
		'updated' => 'datetime'
	);

	var $records = array(
		array('id' => 1, 'title' => 'First Post', 'body' => 'First Post Body', 'created' => '2007-03-18 10:39:23', 'updated' => '2007-03-18 10:41:31'),
		array('id' => 2, 'title' => 'Second Post', 'body' => 'Second Post Body', 'created' => '2007-03-18 10:41:23', 'updated' => '2007-03-18 10:43:31'),
		array('id' => 3, 'title' => 'Third Post', 'body' => 'Third Post Body', 'created' => '2007-03-18 10:43:23', 'updated' => '2007-03-18 10:45:31')
	);
}
?>
