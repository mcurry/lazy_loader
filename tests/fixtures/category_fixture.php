<?php

class CategoryFixture extends CakeTestFixture {
	var $name = 'Category';

	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false)
	);

	var $records = array(
		array('id' => 1, 'name' => 'First Category'),
		array('id' => 2, 'name' => 'Second Category'),
		array('id' => 3, 'name' => 'Third Category')
	);
}
?>
