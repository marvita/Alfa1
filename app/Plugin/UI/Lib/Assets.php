<?php
/**
 * Assets helper library.
 *
 * Methods that return some assets (ie option sets that need proper labels for enum fields)
 *
 * @package       Dinamo
 ** link http://book.cakephp.org/2.0/en/core-libraries/helpers/number.html
 */

class Asset extends stdClass {
	public function __construct($values) {
		foreach ($values as $key => $value) {
			$this->{
				$key
			} = $value;
		}
	}
	
	public function __get($varname) {
		if (!$varname || !isset($this->$varname)) {
			return null;
		}
		
		return $this->$varname;
	}
}

class Assets {
	public static function __callStatic($name, $arguments) {
		$type = "object";
		if (substr($name, -5) == "Array") {
			$name = substr($name, 0, -5);
			$type = "array";
		}
		if (substr($name, -3) == "SQL") {
			$name = substr($name, 0, -3);
			$type = "sql";
		}
		
		try {
			if (method_exists("Assets",$name)) {
				// there's a static method to handle this specific case
				$value = call_user_func("Assets::".$name);
			} else {
				// use Model_Field notation for the called method
				@list($model, $field) = explode("_", $name);
				
				// load model config
				$result = Configure::load($model, "objects");
				$config = Configure::read("$model.Fields");
				
				if (isset($config[$field]["mapping"])) {
					$value = $config[$field]["mapping"];
				} else {
					throw new Exception(__("Mapping not found"));
				}
			}
			
		} catch (Exception $e) {
			return null;
		}
		
		switch ($type) {
			case "object":
				return new Asset($value);
			
			case "array":
				return $value;
				
			case "sql":
				// build a sql case structure
				$fieldname = $arguments[0];
				$sentence = "CASE $fieldname ";
				foreach ($value as $key => $val) {
					$sentence .= " WHEN '$key' THEN '$val' ";
				}
				$sentence .= " END ";
				
				return $sentence;
				
			default:
				return (object) $value;
		}
	}
	
	private static function DiscountScopes() {
		return array(
			'IndividualItems' => __("Producto individual (se ve en la tienda)"),
			'Items' => __("Total de Productos (solo se ve en la órden)"),
			'Shipping' => __("Costo de envío"),
			'Total' => __("Total final de la compra")
		);
	}
	
	private static function StockTypes() {
		return array(
			'Units' => __("Unidades"),
			'Kg' => __("Kilogramos"),
			'Lt' => __("Litros"),
		);
	}
	
	private static function PeriodTypes() {
		return array(
			'Hour' => __("Horas"),
			'Day' => __("Días"),
			'Month' => __("Meses"),
			'Year' => __("Años"),
		);
	}
	
	public static function slugify($string) {
		$mytitle=strtolower($string); // lowercase from a lowlevel C function
		$mytitle=preg_replace('/^\W+/','',$mytitle); // delete all leading ('/^.../') non-alphanumeric characters
		$mytitle=preg_replace('/\W+$/','',$mytitle); // delete all trailing ('/...$/') non-alphanumeric characters
		$mytitle=preg_replace('/\W+/','-',$mytitle); // replace remaining non-alphanumeric characters with single hyphen
		$mytitle=preg_replace('/\s+/','-',$mytitle); // replace single or multiple spaces with a hyphen
		
		return $mytitle;
	}

	public static function time2date($time = null) {
		if (!$time) $time = time();
		return date("d/m/Y", $time);
	}
	public static function sqldate2date($date = null) {
		if ($date == "0000-00-00") return date("d/m/Y");
		if ($date == "") return null;
		return date("d/m/Y", strtotime($date));
	}
	public static function sqldate2datetime($date = null) {
		if ($date == "0000-00-00") return date("d/m/Y H:i");
		if ($date == "") return null;
		return date("d/m/Y H:i", strtotime($date));
	}
	public static function datetime2sqldate($date = null) {
		list($d, $h) = explode(" ", $date);
		list($d, $m, $y) = explode("/", $d);
		
		foreach (explode(":", $h) as $c) {
			$hour .= "$c:";
		}
		$hour = substr($hour, 0, -1);
		
		return ("$y-$m-$d $hour");
	}
	public static function date2sqldate($date = null) {
		$datevals = explode("/", $date);
		if (count($datevals) < 3) return null;
		list($d, $m, $y) = $datevals;
  
		return ("$y-$m-$d");
	}
	public static function YesNo($value) {
		if ($value) return __("Si");
		return __("No");
	}

}


?>