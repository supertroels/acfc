<?php

/*
*********************************************
*
*	ACFC Layout
*	v0.1
*	
*	This class is to be used for creating new
*	layout groups when building ACF powered
*	edit screens programatically
*
*********************************************
*/

class acfc_layout {
	

	/**
	 * Runs on class contruction and will
	 * set up the layout group for manipulation
	 *
	 * @return void
	 **/

	public function __construct($label, $key){

		$field_key = acfc::parse_field_key($key, '02');

		$this->key 						= $field_key;
		$this->name						= $key;
		$this->label 					= $label;
		$this->display 					= 'block';
		$this->sub_fields 				= array();
		$this->min 						= '';
		$this->max 						= '';

	}


	/**
	 * Sets a value on the layout group
	 * 
	 * @param $key string - the key
	 * @param $value mixed - the value
	 * @return object - $this for chainability
	 **/

	public function set($key, $value){

		$this->{$key} = $value;

		return $this;
	}



	/**
	 * Add a acfc_field object to this layout group
	 *
	 * @param $field_object object - the acfc_field object to add
	 * @return object - $this for chainability
	 **/

	public function add_field($field_object){

		$this->sub_fields[] = $field_object->export();

		return $this;

	}



	/**
	 * Exports the layout group.
	 * Used primarily when included but can also be
	 * used in conjunction with acf_json_encode to
	 * export the field group to a JSON file
	 * 
	 * @return array - the exported field
	 **/

	public function export(){
		return (array)$this;
	}


}

?>