<?php

class PostsTagFixture extends CakeTestFixture {
	var $name = 'PostsTag';

	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'post_id' => array('type' => 'integer', 'null' => false),
    'tag_id' => array('type' => 'integer', 'null' => false)
	);

	var $records = array(
		array('id' => 1, 'post_id' => 1, 'tag_id' => 1),
		array('id' => 2, 'post_id' => 1, 'tag_id' => 2),
		array('id' => 3, 'post_id' => 2, 'tag_id' => 1)
	);
}
?>
