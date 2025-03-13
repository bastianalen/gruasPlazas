<?php
// Llama al controlador inizializador
require_once(__DIR__."/../controller/conexion.php");
// Llama a la conexion de la base de datos
require_once(LIB_PATH_MODEL.DS.'database.php');

// Crea la clase MantencionRecomendada
class MantencionRecomendada {

	// Almacena el nombre de la tabla
	protected static  $tblname = "tblmantencionrecomendada";

	// Almacena las relaciones que posee la tabla principal "tblcaleneucaristia"
	protected static  $innertbl = " tmr INNER JOIN tbltipomantencion ttm ON tmr.id_tipo_mtn = ttm.id_tipo_mtn";

	// 
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}

	// funcion que obtiene todos los datos en de la tabla
	function list_of_mantencionrecomendada(){
		// Conecta la base de datos
		global $mydb;
		// Almacena la consulta de la funcion
		$mydb->setQuery("SELECT * FROM " . self::$tblname);
		// Almacena los resultados de la consulta
		$cur = $mydb->executeQuery();

		// Valida que se obtengan datos
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}

		// Crea una variable que almacenará en arreglo los datos
		$result = [];
		// Recorre la variable $cur y almacena los datos en la varible tipo array creada
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		// Devuelve los datos obtenidos
		return $result;
	}

	function list_of_mantencionrecomendada_tipo($tipo_mantencion=""){
		// Conecta la base de datos
		global $mydb;
		// Almacena la consulta de la funcion
		$mydb->setQuery("SELECT * FROM " . self::$tblname. self::$innertbl." WHERE tmr.tipo_mantencion = {$tipo_mantencion}");
		// Almacena los resultados de la consulta
		$cur = $mydb->executeQuery();

		// Valida que se obtengan datos
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}

		// Crea una variable que almacenará en arreglo los datos
		$result = [];
		// Recorre la variable $cur y almacena los datos en la varible tipo array creada
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		// Devuelve los datos obtenidos
		return $result;
	}
	
	function find_mantencionrecomendada($id="",$patente=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname. self::$innertbl." WHERE id_mtn_recomen = {$id} OR patente = '{$patente}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 
	function single_mantencionrecomendada($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname. self::$innertbl." where id_mtn_recomen = {$id} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}

	function single_mantencion_recomendada_destacada($destacar="",$tipo_mantencion=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname. self::$innertbl." where tmr.destacar = {$destacar} AND tmr.id_tipo_mtn = {$tipo_mantencion} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}

	function single_mantencionrecomendada_tipomantencion($patente="",$tipo_mantencion=""){
		global $mydb;
		$sql = "SELECT * FROM ".self::$tblname. self::$innertbl." WHERE 1=1 AND tmr.patente = '{$patente}' AND tmr.id_tipo_mtn = {$tipo_mantencion}  LIMIT 1 ";
		$mydb->setQuery($sql);
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	
	function find_mantenciones_recomendadas_destacadas($patente=""){
		global $mydb;
		$sql = "SELECT * FROM ".self::$tblname. self::$innertbl." WHERE 1=1 AND tmr.patente = '{$patente}'";
		$mydb->setQuery($sql);
		
		// Almacena los resultados de la consulta
		$cur = $mydb->executeQuery();
		
		// Valida que se obtengan datos
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}

		// Crea una variable que almacenará en arreglo los datos
		$result = [];
		// Recorre la variable $cur y almacena los datos en la varible tipo array creada
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		// Devuelve los datos obtenidos
		return $result;
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
		$sql .= " WHERE id_mtn_recomen =". $id;
        echo $mydb->setQuery($sql);
    	
    	if($mydb->executeQuery()) {
    	    return true;
    	} else {
    	    return false;
    	} 	
		
	}

	public function delete($id=0) {
		global $mydb;
		$sql = "DELETE FROM ".self::$tblname;
		$sql .= " WHERE id_mtn_recomen =". $id;
		$sql .= " LIMIT 1 ";
		$mydb->setQuery($sql);
	
		if($mydb->executeQuery()) {
			return true;
		} else {
			return false;
		} 	
	
	}	
	
	
}