<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Comment $Comment
 */
class PatientsController extends AppController {
	  
	public $paginate = array(
		"contain" => array("PatientFile" , "User" )
	);
  
	
	public function __construct($request = null, $response = null) {
		/*if ($request) {
			//$this->components[] = 'Plupload.Plupload';
			$this->helpers[] = "AjaxMultiUpload.Upload";
			$this->components[] = "AjaxMultiUpload.Upload";
			//Configure::write("UI.rootContext", "#content .profile-content .content");
		}*/
		parent::__construct($request, $response);
	}
	
	public function index() {
		if (isset($this->request->params["named"]["status"])) {
			switch ($this->request->params["named"]["status"]) {
				case "ship":
					$this->searchConditions["Patient.Iniciales >"] = "0";
				break;
				case "lowstock":
					/*$conditions["NOT"] = array("FirstFile.id" => null);
					$conditions[] = "FirstFile.created < DATE_SUB(NOW(), INTERVAL 1 YEAR)";
					$conditions["SecondFile.id"] = null;*/
					$this->searchConditions[] = "Patient.Iniciales < Patient.Iniciales";
					//$this->searchConditions["Coupon.Shipped"] = "0";
				break;
			}
		}

		if (!$this->UserAuth->isAdmin()) {
			$this->searchConditions["Patient.user_id"] = $this->UserAuth->getUserId();
		}

		parent::index();
	}

	public function form($id = null) {
	    
        $this->Patient->contain(array(
			"PatientFile" => array("SmokingHistory", "AatDetermination", "ClinicalHistory", "OtherDiagnostic", "ChestTac", "CurrentTreatment", "SustitutiveTreatment", "PulmonaryStudy", "HepaticEnzyme", "StGeorgeCuestionnaire", "WorkingHistory", "BloodSample", "FinalDate"),
			"User"
		));

		if ($this->request->is('post') || $this->request->is('put')) {
			// check and set the user id of the patient
			if (isset($this->request->data["Patient"])) {
				$this->request->data["Patient"]["user_id"] = $this->UserAuth->getUserId();
			} else {
				$this->request->data["user_id"] = $this->UserAuth->getUserId();
			}
		}
		parent::form($id);
		
		/*if ((isset($this->request->data["product_type_id"])  || isset($this->request->data["Product"]["product_type_id"])  ) && !isset($this->request->data["ProductType"]["id"])) {
			$product_type_id = isset($this->request->data["product_type_id"]) ? $this->request->data["product_type_id"] : $this->request->data["Product"]["product_type_id"];
			$this->Product->ProductType->contain(array("Property" => array("PropertyValue")));
			$productType = $this->Product->ProductType->read(null, $product_type_id);
			//Entity::_setEntityPath("ProductType");
			$this->request->data["ProductType"] = Entity::transposeData($productType, "ProductType", "");
			//Entity::_revertEntityPath();
		}*/
	}

	public function add() {

		// si no se indica el profile id y el usuario esta logueado usar el del usuario
		$user_id = $this->UserAuth->getUserId();
		
		if ($this->request->is('post')) {
			$this->request->data["Contact"]["user_id"] = $user_id;
			$this->Contact->saveAssociated($this->request->data, array("deep" => true));
		}
		
		$this->render('form');
	}
	
	public function add2() {
	  
		// si no se indica el profile id y el usuario esta logueado usar el del usuario
		$user_id = $this->UserAuth->getUserId();
		$profile = $this->Contact->Profile->find('first', array("conditions" => array("Profile.user_id" => $user_id)));
		
		if (!$profile) {
			throw new NotFoundException(__('Invalid profile'));
		}
		
		// check if there already is an album to finish storing
		$album = $this->Contact->find('first', array("conditions" => array("Temp" => "1")));
		
		if (!$album) {
			throw new NotFoundException(__('Invalid album'));
		}
		
		if ($album) {
			$this->request->data["Contact"]["id"] = $album["Contact"]["id"];
		}
		
		if ($this->request->is('post')) {
			$this->request->data["Contact"]["profile_id"] = $profile["Profile"]["id"];
			if (!isset($this->request->data["Contact"]["Temp"])) {
				$this->request->data["Contact"]["Temp"] = "1";
			}
			
			if ($this->request->data["Contact"]["Temp"] == 0) {
				// get the files from the ajax upload directory if they exist and move them as frontimage
				$files = $this->Upload->listing("Contact", $this->request->data["Contact"]["id"]);
				if (count($files["files"])) {
					// copy the file to the images Directory
					$frontimagedir = ROOT . DS . APP_DIR . DS . "webroot" . DS . "img" . DS . "album" . DS . "FrontImage" . DS . $this->request->data["Contact"]["id"];
					mkdir( $frontimagedir );
					
					$filename = substr($files["files"][0], strlen($files["directory"])+1 );
					
					rename( $files['files'][0], $frontimagedir . DS . $filename );
					
					$this->request->data["Contact"]["FrontImage"] = $filename;
					$this->request->data["Contact"]["FrontImageDir"] = $this->request->data["Contact"]["id"];
				}
			}
			
			$this->Contact->save($this->request->data);
			if ($this->request->data["Contact"]["Temp"] == 0) {
				$this->redirect(array("controller" => "contacts", "action" => "index"));
				return;
			}
		} else {
			$this->request->data = $album;
		}
		
	}
	
    
   
	public function view($id) {
		// si no se indica el profile id y el usuario esta logueado usar el del usuario
		//$this->Patient->contain(array());
        
        $this->Patient->contain(array(
            "PatientFile" => array("SmokingHistory", "AatDetermination", "ClinicalHistory", "OtherDiagnostic", "ChestTac", "CurrentTreatment", "SustitutiveTreatment", 
            "PulmonaryStudy", "HepaticEnzyme", "StGeorgeCuestionnaire", "WorkingHistory", "BloodSample", "FinalDate"),
            "User"
        ));

        if ($this->request->is('post') || $this->request->is('put')) {
            // check and set the user id of the patient
            if (isset($this->request->data["Patient"])) {
                $this->request->data["Patient"]["user_id"] = $this->UserAuth->getUserId();
                
            } else {
                $this->request->data["user_id"] = $this->UserAuth->getUserId();
            }
        }
        parent::form($id);
                   
        
		/*$album = $this->Contact->find('first', array("conditions" => array("Contact.id" => $album_id)));
		
		if (!$album) {
			throw new NotFoundException(__('Invalid album'));
		}
		
		$this->set("dashboard", $this->UserAuth->isLogged() && ( $this->UserAuth->getUserId() == $album["Profile"]["user_id"] ) );
		*/
		//$this->set("contact", $album);
		
	}
  

    
}