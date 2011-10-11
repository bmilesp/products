<?php

class Product extends ProductsAppModel{
	
	public $actsAs = array('Cart.Buyable','Search.Searchable');
	
	public $hasMany = array(
		'Image' => array(
			'className' => 'FileSystem.FileSystem',
			'foreignKey' => 'foreign_key',
			'conditions' => array('Image.category_id' => 'Product'),
			'order' => array('Image.order ASC')
		)
	);
	
	public $filterArgs = array(
		array('name' => 'active', 'type' => 'value'),
	);
	
	public $activeOptions = array(0 => 'Inactive',1 => 'Active');
	
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->validate = array(
			'name' => array(
				'notempty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('cart', 'This field cannot be left blank', true))),
			'price' => array(
				'notempty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('cart', 'This field cannot be left blank', true))),
			'description' => array(
				'notempty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('cart', 'This field cannot be left blank', true))),
		);
	}
}
