<?php
require_once "config_class.php";
require_once "checkvalid_class.php";

class DataBase {
	 
    private $config;
	private $mysqli;
	private $valid;
	
	public function __construct(){
	  $this->config = new Config();
      $this->valid = new CheckValid();
      $this->mysqli = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
      $this->mysqli->query("SET NAMES `utf8`");  
	}
	
	private function query($query) {
	    return $this->mysqli->query($query);
	}
	
	private function select($table_name, $fields, $where = "", $order = "", $up = true, $limit = "") {
		for ($i = 0; $i < count($fields); $i++) {
             if ((strpos($fields[$i], "(") === false) && ($fields[$i] != "*")) $fields[$i] = "`".$fields."`";
        }			
	    $fields = implode(",", $fields);//превращает $fields массив в строку
		$table_name = $this->config->db_prefix.$table_name;
		if (!$order) $order = "ORDER BY `id`";
		else {
		    if ($order != "RAND()") {
                $order = "ORDER BY `$order`";
				if (!$up) $order .= " DESC";//сортировка по убыванию
			}	
           else $order = "ORDER BY $order";			
		}
		if ($limit) $limit = "LIMIT $limit";
		if ($where) $query = "SELECT $fields FROM $table_name WHERE $where $order $limit";
		else $query = "SELECT $fields FROM $table_name $order $limit";
		$result_set = $this->query($query);
		if (!$result_set) return false;
		$i = 0;
		while ($row = $result_set->fetch_assoc()) {
		    $data[$i] = $row;
            $i++;			
		}
		$result_set->close();
		return $data;
	}
	
	public function insert($table_name, $new_values) {
	    $table_name = $this->config->db_prefix.$table_name;
		$query = "INSERT INTO $table_name (";
		foreach ($new_values as $field => $value) $query .="`".$field."`,";
		$query = substr($query, 0, -1);//Функция убирает запятую в цикле
		$query .= ") VALUES (";
		foreach ($new_values as $value) $query .= "'".addslashes($value)."',";
	    $query = substr($query, 0, -1);
		$query .= ")";
		return $this->query($query);
	}
	
	private function update($table_name, $upd_fields, $where) {
		$table_name = $this->config->db_prefix.$table_name;
		$query = "UPDATE $table_name SET";
		foreach ($upd_fields as $field => $value) $query .="`$field` = '".addslashes($value)."',";
		$query = substr($query, 0, -1);
		if ($where) {
		    $query .= "WHERE $where";
            return $this->query($query);			
		}
		else return false;
	}
	
	public function delete($table_name, $where = "") {
		$table_name = $this->config->db_prefix.$table_name;
		if ($where) {
	         $query = "DELETE $table_name WHERE $where";
			 return $this->query($query);
		}
	   else	return false;
	}
	
	public function deleteAll($table_name) {
	    $table_name = $this->config->db_prefix.$table_name;
    	$query = "TRUNCATE TABLE `$table_name`";
		return $this->query($query);
	}
	
	public function getField($table_name, $field_out, $field_in, $value_in) {//$field_out, поле которое нужно вернуть)$field_in,поле которое мы знаем
		$data = $this->select($table_name, array($field_out), "`$field_in`='".addslashes($value_in)."'");
	    if(count($data) !=1) return false;
		return $data[0][$field_out];
	}
	
	public function getFieldOnID($table_name, $id, $field_out) {
	      if (!$this->existsID($table_name, $id)) return false;
		  return $this->getField($table_name, $field_out, "id", $id);
	}
	
	public function getAll($table_name, $order, $up) {
	    return $this->select($table_name, array("*"), "", $order, $up);	
	}
	
	public function getAllOnField($table_name, $field, $value, $order, $up)	{
        return $this->select($table_name, array ("*"), "`$field`='".addslashes($value)."'", $order, $up);
	}	
	
	public function getLastID($table_name) {
        $data = $this->select($table_name, array("MAX(`id`)"));
		return $data[0]["MAX(`id`)"];  
	  }

	public function deleteOnID($table_name, $id) {
	    if (!$this->existsID($table_name, $id)) return false;
     return $this->delete($table_name, "`id` = '$id'" );    	
	}
	
	public function setField($table_name, $field, $value, $field_in, $value_in) {
         return $this->update($table_name, array($field => $value), "`$field_in` = '".addslashes($value_in)."'");		 
	}
	
	public function setFieldOnID($table_name, $id, $field, $value) {
	     if (!$this->existsID($table_name, $id)) return false;
         return $this->setField	($table_name, $field, $value, "id", $id);	 
	}
	
	public function getElementOnID($table_name, $id) {
        if (!$this->existsID($table_name, $id)) return false;
		$arr = $this->select($table_name, array("*"), "`id` = '$id'");
		return $arr[0];
	}

    public function getRandomElements($table_name, $count) {
         return $this->select($table_name, array("*"), "", "RAND()", true, $count);
	}

    public function getCount($table_name) {//функция позваляет узнать сколько записей в таблице
      $data = $this->select($table_name, array("COUNT(`id`)"));
	  return $data[0]["COUNT(`id`)"];
	}

    public function isExists($table_name, $field, $value) {// проверкa на сущ. пользователя
       $data = $this->select($table_name, array("id"), "`$field` = '".addslashes($value)."'");
	   if (count($data) === 0) return false;
	   return true;
	}
	
	private function existsID($table_name, $id) {
	    if(!$this->valid->validID($id)) return false;
        $data = $this->select($table_name, array("id"), "`id`='".addslashes($id)."'");
        if(count($data) === 0) return false;
     	return true;	
	}
	////////////////////////////////////////////////////////////////////////Forma poiska
	public function search($table_name, $words, $fields) {
		$words = mb_strtolower($words);
		$words = trim($words);
		$words = quotemeta($words);
		if ($words == "") return false;
		$where = "";
		$arraywords = explode(" ", $words);//explode-превращает строку в массив внутри скобок происходит пробел в поиске
	    $logic = "OR";
		
		foreach ($arraywords as $key => $value) {
			if (isset($arraywords[$key - 1])) $where .= $logic;
			for ($i = 0; $i < count($fields); $i++) {
				$where .= "`".$fields[$i]."` LIKE '%".addslashes($value)."%'";
				if (($i + 1) != count($fields)) $where .= " OR";
			}
		}
		
		$results = $this->select($table_name, array("*"), $where);
		if(!$results) return false;
		$k = 0;
		$data = array();
		for ($i = 0; $i < count($results); $i++) {
			for ($j = 0; $j < count($fields); $j++) {
				$results[$i][$fields[$j]] = mb_strtolower(strip_tags($results[$i][$fields[$j]]));
			}
			$data[$k] = $results[$i];
			$data[$k]["relevant"] = $this->getRelevantForSearch($results[$i], $fields, $words);
			$k++;
		}
		$data = $this->orderResultSearch($data, "relevant");
		return $data;
	}
	
	private function getRelevantForSearch($result, $fields, $words) {
		$relevant = 0;
		$arraywords = explode(" ", $words);
		for ($i = 0; $i < count($fields); $i++) {
			for ($j = 0; $j < count($arraywords); $j++) {
				$relevant += substr_count($result[$fields[$i]], $arraywords[$j]);
			}
		}
		return $relevant;
	}
	
	private function orderResultSearch($data, $order) {
		for ($i = 0; $i < count($data) - 1; $i++) {
			$k = $i;
			for ($j = $i + 1; $j < count($data); $j++) {
			   if ($data[$j][$order] > $data[$k][$order]) $k = $j;	
			}
			$temp = $data[$k];
			$data[$k] = $data[$i];
			$data[$i] = $temp;
		}
		return $data;
	}
	/////////////////////////////////
	public function __destruct() {
	   if ($this->mysqli) $this->mysqli->close();	
	}
}
?>