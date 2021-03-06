<?php

/*
*********************************************
*
*	ACFC Field Group
*	v0.1
*	
*	This class is to be used for creating new
*	field groups when building ACF powered
*	edit screens programatically
*
*********************************************
*/

class acfc_field_group {
	

	/**
	 * Runs on class contruction and will
	 * set up the field group for manipulation
	 *
	 * @return void
	 **/

	public function __construct($title){

		$field_key = acfc::get_valid_field_key($title);

		$this->key 						= 'group_'.$field_key;
		$this->title 					= $title;

		$this->fields 					= array();

		// Default layout
		$this->location 				= array();
		$this->menu_order				= 0;
		$this->position					= 'normal';
		$this->style					= 'default';
		$this->label_placement			= 'top';
		$this->instruction_placement	= 'label';
		$this->hide_on_screen			= '';
		$this->modified					= 0;

	}



	/**
	 * Sets a value on the field group
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
	 * Add a acfc_field object to this field group
	 *
	 * @param $field_object object - the acfc_field object to add
	 * @return object - $this for chainability
	 **/

	public function add_field($field_object){

		$this->fields[] = $field_object->export();

		return $this;

	}



	/**
	 * Apply the rules in the given acfc_ruleset object
	 * as the location rules for this field group
	 *
	 * @param $rulese object - the acfc_ruleset object to add
	 * @return object - $this for chainability
	 **/

	public function add_location($ruleset){

		$this->location[] = $ruleset->export();

		return $this;

	}




	/**
	 * Exports the field group.
	 * Used primarily when included but can also be
	 * used in conjunction with acf_json_encode to
	 * export the field group to a JSON file
	 * 
	 * @return array - the exported field
	 **/

	public function export(){
		return (array)$this;
	}



	public function add(){

		if($this->has_been_added)
			return;

		acf_add_local_field_group(acf_get_valid_field_group($this->export()));

		$this->has_been_added;
		return $this;

	}



}

?>