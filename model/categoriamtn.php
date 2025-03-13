<?php
// Llama al controlador inizializador
require_once(__DIR__."/../controller/conexion.php");
// Llama a la conexion de la base de datos
require_once(LIB_PATH_MODEL.DS.'database.php');

class CategoriaMantencion {
    protected static $tblname = "tblcategoriamantencion";

    function dbfields () {
        global $mydb;
        return $mydb->getfieldsononetable(self::$tblname);

    }
    function list_of_categoria_mantencion(){
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname);
        $cur = $mydb->executeQuery();

        if (!$cur) {
            //Manejo de errores
            error_log("Error executing query: ".$mydb->error);
            return false;
        }

        $return = [];
        while ($row = $cur->fetch_assoc()){
            $result[] = $row;
        }

        return $result;
    }
    function find_categoria_mantencion($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." WHERE id_cate_mtn = {$id} OR categoria_mtn = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 
	function single_categoria_mantencion($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_cate_mtn = {$id} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	
	/*---Instantiation of Object dynamically---*/
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  global $mydb;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		echo $mydb->setQuery($sql);
	
	 if($mydb->executeQuery()) {
	    $this->id = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_cate_mtn =". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_cate_mtn =". $id;
		  $sql .= " LIMIT 1 ";
		$mydb->setQuery($sql);

		if($mydb->executeQuery()) {
		  return true;
		} else {
		  return false;
		} 
	}
}