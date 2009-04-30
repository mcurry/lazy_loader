<?php

class TagFixture extends CakeTestFixture {
	var $name = 'Tag';

	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'tag' => array('type' => 'string', 'null' => false)
	);

	var $records = array(
		array('id' => 1, 'tag' => 'First Tag'),
		array('id' => 2, 'tag' => 'Second Tag'),
		array('id' => 3, 'tag' => 'Third Tag')
	);
}
?>
