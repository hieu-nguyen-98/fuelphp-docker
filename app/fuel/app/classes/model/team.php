<?php

class Model_Team extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'description',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'property' => 'created_at',
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'property' => 'updated_at',
			'mysql_timestamp' => true,
		),
	);

	protected static $_table_name = 'teams';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
	);

}
