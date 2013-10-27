<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Comment $Comment
 */
class PatientFilesController extends AppController {
	public $paginate = array(
		"contain" => array("Patient")
	);
    
  //  public $components = array('Search');
	
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
			    // Menu: Incompletas - Tabla patient_files, campo Complete = 0
				case "incomplete":
					$this->searchConditions["PatientFile.Complete"] = "0";
				break;
                // Menu: En Aplobacion - Tabla patient_files, campo Closed = 0
				case "open":
					$this->searchConditions["PatientFile.Closed"] = "0";
					/*$conditions["NOT"] = array("FirstFile.id" => null);
					$conditions[] = "FirstFile.created < DATE_SUB(NOW(), INTERVAL 1 YEAR)";
					$conditions["SecondFile.id"] = null;
					$this->searchConditions["Coupon.Redeemed"] = "1";
					$this->searchConditions["Coupon.Shipped"] = "0";*/
				break;
                // Menu: Completas - Tabla patient_files, campo Complete = 1
                case "complete":
                    $this->searchConditions["PatientFile.Complete"] = "1";
                break;            
                // Menu: Aprobadas - Tabla patient_files, campo Closed = 1
                case "closed":
                    $this->searchConditions["PatientFile.Closed"] = "1";
                break;                 
			}
		}
      
		if (!$this->UserAuth->isAdmin()) {
			$this->searchConditions["Patient.user_id"] = $this->UserAuth->getUserId();
		}else{
		  /*
      $options['joins'] = array(
          array('table' => 'patients',
              'alias' => 'Patient',
              'type' => 'inner',
              'conditions' => array(
                  'Patient.id = PatientFile.patient_id',
              )
          )

      );
       
      $this->set('PatientFiles', $this->PatientFiles->find('first', $options));
       */
       
       
      // $fichas = $this->PatientFile->getFichas(0);
      // $this->set('patient_files', $fichas);
      
      // $options['conditions'] = array(
          // 'Tag.tag' => 'Novel'
      // );
      
      // $patient_files = $PatientFile->find('all', $options);		

      // print_r($patientFile); die();
		  
		}
		
		parent::index();

	}

	public function form($id = null) {

		if ($this->request->is('post') || $this->request->is('put')) {
			// check and set the user id of the patient
			if (isset($this->request->data["Patient"])) {
				$this->request->data["Patient"]["user_id"] = $this->UserAuth->getUserId();
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
  
  
  public function view($id) {
    // si no se indica el profile id y el usuario esta logueado usar el del usuario
    
     // $this->Patient->contain(array(
          // "PatientFile" => array("SmokingHistory", "AatDetermination", "ClinicalHistory", "OtherDiagnostic", "ChestTac", "CurrentTreatment", "SustitutiveTreatment", 
          // "PulmonaryStudy", "HepaticEnzyme", "StGeorgeCuestionnaire", "WorkingHistory", "BloodSample", "FinalDate"),
          // "User"
      // ));

      if ($this->request->is('post') || $this->request->is('put')) {
              
        // print '<pre>';
        // print_r($this->request->data);
        // print '</pre>';     
        // die();            
          
        
          // check and set the user id of the patient
          if (isset($this->request->data["Patient"])) {
              $this->request->data["Patient"]["user_id"] = $this->UserAuth->getUserId();
              
          } else {
              $this->request->data["user_id"] = $this->UserAuth->getUserId();
          }
      }
      parent::form($id);
       
    
  }  
  
  
}