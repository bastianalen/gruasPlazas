<?php
// Llama al controlador inizializador
require_once(__DIR__."/../controller/conexion.php");
// Llama a la conexion de la base de datos
require_once(LIB_PATH_MODEL.DS.'database.php');

// Crea la clase mantencion
class MantencionVehiculo {

	// Almacena el nombre de la tabla
	protected static  $tblname = "tblmantencionvehiculo ";

	// Almacena las relaciones que posee la tabla principal "tblmantencion"
	protected static  $innertbl = "tm INNER JOIN tbltipomantencion ttm ON tm.id_tipo_mtn = ttm.id_tipo_mtn
									INNER JOIN tblcategoriamantencion cm ON cm.id_cate_mtn = ttm.id_cate_mtn
									INNER JOIN tblmantencionrecomendada tmr ON tmr.id_tipo_mtn = ttm.id_tipo_mtn";

	protected static $columns = " tm.id_mtn_vehiculo, tm.patente, tm.id_tipo_mtn, tm.fecha_mtn, tm.lugar_mtn, tm.costo_mtn, tm.desc_mtn_vehi,
 								ttm.tipo_mantencion, ttm.desc_tipo_mtn,
 								cm.categoria_mtn,
 								tmr.km_recomen, tmr.tiempo_recomen, tmr.fecha_recomen, tmr.desc_recomen, tmr.destacar";

	// 
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);
	}

	// funcion que obtiene todos los datos en de la tabla
	function list_of_mantencion_vehiculo(){
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

	function list_of_mantencion_all_tipo($tipo_mantencion=""){
		// Conecta la base de datos
		global $mydb;
		// Almacena la consulta de la funcion
		$mydb->setQuery("SELECT " . self::$columns . " FROM " . self::$tblname. self::$innertbl." WHERE tmr.tipo_mantencion = {$tipo_mantencion}");
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
	
	function find_mantencion_row($id="",$patente=""){
		global $mydb;
		$mydb->setQuery("SELECT " . self::$columns . " FROM ".self::$tblname. self::$innertbl." WHERE id_mtn_vehiculo = {$id} OR patente = '{$patente}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
    
    function find_mantenciones($id = "", $patente = "") {
		global $mydb;
		$sql = "SELECT " . self::$columns . " FROM " . self::$tblname . self::$innertbl . " WHERE 1=1 ";
	
		if ($id != "") {
			$sql .= " AND tm.id_mtn_vehiculo = {$id}";
		}
	
		if ($patente != "") {
			// Asegúrate de que no se agregue un OR innecesario
			$sql .= " AND tm.patente = '{$patente}'";
		}
	
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();
		return $cur;
	}
	 
	function single_mantencion($id=""){
		global $mydb;
		$mydb->setQuery("SELECT " . self::$columns . " FROM ".self::$tblname. self::$innertbl." where id_mtn_vehiculo = {$id} LIMIT 1");
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
		$sql = "UPDATE ".self::$tblname. " SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_mtn_vehiculo =". $id;
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
		$sql .= " WHERE id_mtn_vehiculo =". $id;
		$sql .= " LIMIT 1 ";
		$mydb->setQuery($sql);
	
		if($mydb->executeQuery()) {
			return true;
		} else {
			return false;
		} 	
	
	}	
	
	public function filtrar_mantenciones($filtros) {
		global $mydb;
		$sql = "SELECT " . self::$columns . " FROM " . self::$tblname . self::$innertbl . " WHERE 1=1 ";

		if (!empty($filtros['patente'])) {
			$sql .= " AND tm.patente LIKE '%" . $filtros['patente'] . "%'";
		}
		if (!empty($filtros['fecha'])) {
			$sql .= " AND tm.fecha_mtn = '" . $filtros['fecha'] . "'";
		}
		if (!empty($filtros['tipoMantencion']) && $filtros['tipoMantencion'] != "0") {
			$sql .= " AND tm.id_tipo_mtn = " . intval($filtros['tipoMantencion']);
		}
		if (!empty($filtros['categoria']) && $filtros['categoria'] != "0") {
			$sql .= " AND ttm.id_cate_mtn = " . intval($filtros['categoria']);
		}
		if (!empty($filtros['lugar'])) {
			$sql .= " AND tm.lugar_mtn LIKE '%" . $filtros['lugar'] . "%'";
		}
		if (!empty($filtros['costo']) && $filtros['costo'] != "0") {
			$sql .= " AND tm.costo_mtn = " . intval($filtros['costo']);
		}
		if (!empty($filtros['descripcion'])) {
			$sql .= " AND tm.desc_mtn_vehi LIKE '%" . $filtros['descripcion'] . "%'";
		}
		if (!empty($filtros['destacar']) && $filtros['destacar'] != "0") {
			if ($filtros['destacar']== 1) {
				$sql .= " AND tmr.destacar LIKE '%" . $filtros['destacar'] . "%'";
			}else {
				$sql .= " AND tmr.destacar LIKE 2";
			}
		}
		
		
		// Almacena los resultados de la consulta
		$mydb->setQuery($sql);
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

}