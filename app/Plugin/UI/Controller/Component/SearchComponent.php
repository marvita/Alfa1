<?php

App::uses('Component', 'Controller');

class SearchComponent extends Component {
	public function initialize($controller) {
		parent::initialize($controller);
		
		$this->controller = $controller;
		$this->request = $this->controller->request;
	}

	public function getConditions($modelPaths = array()) {
		$conditions = array();
		
		$data = array();
		
		if (!empty($this->request->data)) {
			foreach ( $this->request->data as $model => $fields) {
				if (is_array($fields)) {
					foreach ($fields as $field => $value) {
						if (trim($value)) {
							$data["$model.$field"] = $value;
						}
					}
				}
			}
		}
		
		$searchfields = array_merge($this->request->named, $data);
		
		$this->controller->set("searchFields", $searchfields);
		
		foreach ($searchfields as $key => $value) {
			if (!strpos($key, ".")) continue;
			
			list($model, $field) = explode(".", $key);
			
			if (array_key_exists($model, $modelPaths)) {
				App::uses($model, $modelPaths[$model]);
			} else {
				App::uses($model, "Model");
			}
					
			$obj = new $model;
			$types = $obj->getColumnTypes();
			
			if (trim($value)) {
				if (substr($field, -9) == "_fromdate") { $field = substr($field, 0, -9); $boundary = 0; }
				if (substr($field, -7) == "_todate") { $field = substr($field, 0, -7); $boundary = 1; }
				
				$type = false;
				if ($obj->isVirtualField($field) ) {
					if (isset($boundary)) {
						$type = "datetime";
					} else {
						$type = "string";
					}
					
					// mysql needs to use the expression inside the where clause, not the "AS" alias.
					$fieldName = $obj->virtualFields[$field];
				} else {
					if (isset($types[$field])) {
						$type = $types[$field];
						$fieldName = "$model.$field";
					}
				}
				
				if ($type) {
					switch ($type) {
						case "string":
		                    $conditions["$fieldName LIKE"] = "%".trim($value)."%";
		                    break;
						case "datetime":
		                case "date":
						    if ( isset($boundary) && ! $boundary ) {
								$dateformat = "Y-m-d" . ($type == "datetime" ? " 00:00:00" : "");
								$from = date($dateformat, strtotime( $value ));
		                        $conditions["$fieldName >="] = trim($from);
		                    }
		                    if ( isset($boundary) && $boundary ) {
								$dateformat = "Y-m-d" . ($type == "datetime" ? " 23:59:59" : "");
								$to = date($dateformat, strtotime( $value ));
		                        $conditions["$fieldName <="] = trim($to);
		                    }
							break;
						default:
							$conditions["$fieldName"] =  $value;
		                    break;
					}
				}
			}
		}
		
		return $conditions;
	}
}