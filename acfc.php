<?php

/*
**************************************
*
*	ACFC
*	Advanced Custom Fields Controller
*	v0.1
*
*	This is a tool to programatically
*	define and build build field groups
*	and fields with ACF.
*
**************************************
*/


class acfc {


	/*
	*****************************
	*	
	*	Properties
	*	
	*****************************
	*/

	private static $errors 		= array();
	private static $field_keys 	= array();
	public static $field_groups = array();



	/**
	 * This function should be called somewhere in the
	 * plugin or theme initiation phase. It initiates
	 * acfc and all the modules needed for it to function
	 *
	 * @return void
	 **/

	public static function init(){

		// Require all the needed files
		require_once 'acfc_field_group.php';
		require_once 'acfc_field.php';
		require_once 'acfc_ruleset.php';

		add_action('acf/include_fields', 'acfc::include_field_groups', 20, 1);

	}



	/**
	 * Parses a field or group key and returns the
	 * a hashed version. If the key is already in use
	 * the function will throw an error
	 *
	 * @param $field_key string - the key to parse and hash
	 * @param $salt string - a salt to use for the hashing
	 * @return string - the parsed and hashed field key
	 **/

	public static function parse_field_key($field_key, $salt){

		$field_key = preg_replace('~[^\w]{1}~', '0', crypt($field_key, $salt));

		if(in_array($field_key, self::$field_keys))
			throw new Exception("Field and group keys can not be used more than once", 1);
		
		self::$field_keys[] = $field_key;

		return $field_key;

	}



	/**
	 * Will add an error to the error output
	 *
	 * @return void;
	 **/

	public function error($error, $object = false){
		$this->errors[] = array($error, $object);
	}



	/**
	 * Will return all errors
	 *
	 * @return array - the errors
	 **/

	public function errors(){
		return $this->errors;
	}



	/**
	 * Includes a given acfc_field_group object for
	 * in the fields that will be registered with ACF
	 * later on.
	 * 
	 * @param $group object - the group object to include
	 * @return string - the parsed and hashed field key
	 **/

	public static function include_field_group($group){
		self::$field_groups[] = $group->export();
	}



	/**
	 * This is hooked to 'acf/include_fields'.
	 * It makes sure that all fields included with
	 * include_field_group are actually included
	 * 
	 * @return string - the parsed and hashed field key
	 **/

	public static function include_field_groups(){

		if(self::$field_groups){
			foreach(self::$field_groups as $group){
				acf_add_local_field_group($group);
			}
		}

	}


}

?>