<?
App::uses('MenuHelper', 'UI.View/Helper');

class Alfa1MenuHelper extends MenuHelper {
	
	protected $main = null;
	protected $user = null;
	
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		
		$this->admin = array(
			__("Ingresar") => array("url" => array("controller" => "users", "action" => "login", "plugin" => "usermgmt", "admin" => false)),
			"<i class='icon-plus'></i>" . __("Pacientes") => array("url" => array("controller" => "patients", "action" => "index", "plugin" => false)),
			"<i class='icon-tags'></i>" . __("Fichas") => array("url" => array("controller" => "patient_files", "action" => "index", "plugin" => false), "children" => array(
				__("Incompletas") => array("url" => array("controller" => "patient_files", "action" => "index", "status" => "incomplete", "plugin" => false)),
				__("En Aprobaci&oacute;n") => array("url" => array("controller" => "patient_files", "action" => "index", "status" => "open", "plugin" => false)),
				__("Completas") => array("url" => array("controller" => "patient_files", "action" => "index", "status" => "complete", "plugin" => false)),
				__("Aprobadas") => array("url" => array("controller" => "patient_files", "action" => "index", "status" => "closed", "plugin" => false)),
			)),
			"<i class='icon-user'></i>" . __("Usuarios") => array("url" => array("controller" => "users", "action" => "index", "plugin" => "usermgmt", "admin" => false)), 
			"<i class='icon-user'></i>" . __("Mi Cuenta") => array("url" => array("controller" => "users", "action" => "myprofile", "plugin" => "usermgmt", "admin" => false)), // Marta: agragado para que se pueda ver desde la cuanta del usuario
			//__("Estadísticas") => array("url" => array("controller" => "categories", "action" => "index", "plugin" => false)),
			/*"Eventos" => array("url" => array("controller" => "events", "action" => "index", "plugin" => false), "children" => array(
				__("Próximos") => array("url" => array("controller" => "events", "action" => "index", "type" => "upcoming", "plugin" => false)),
			)),
			"Menúes" => array("url" => array("controller" => "menus", "action" => "index", "plugin" => false)),
			"Estadísticas" => array("url" => array("controller" => "pages", "action" => "statistics", "admin" => false, "plugin" => false)),*/
			"<i class='icon-arrow-left'></i>" . __("Salir") => array("url" => array("controller" => "users", "action" => "logout", "plugin" => "usermgmt", "admin" => false), "direct" => true)
		);
		
		$this->contacts = array(
			__("Agregar") => array("url" => array("controller" => "profiles", "action" => "view"), "direct" => true),
			__("Fotos/Videos") => array("url" => array("controller" => "albums", "action" => "index"), "direct" => true),
			__("Clicempleo") => array("url" => "/", "direct" => true),
			__("Gomaps") => array("url" => "/", "direct" => true),
		);
		
		$this->dashboard = array(
			__("Información") => array("url" => array("controller" => "profiles", "action" => "dashboard"), "direct" => true),
			__("Fotos/Videos") => array("url" => array("controller" => "albums", "action" => "index"), "direct" => true),
			__("Clicempleo") => array("url" => "/", "direct" => true),
			__("Gomaps") => array("url" => "/", "direct" => true),
		);
		
		$this->home = array(
			__("Poner al tanto") => array("url" => "/"),
			__("Gritar al mundo lo nuevo") => array("url" => "/"),
			__("Forma parte") => array("url" => "/register", "direct" => true),
		);
		
		$this->footer = array(
			__("Acerca de CliccGo") => array("url" => "/"),
			__("Privacidad") => array("url" => "/"),
			__("Sistema de difusión") => array("url" => "/"),
			__("Incremento de ganancias") => array("url" => "/"),
			/*//"Login" => array("url" => array("controller" => "users", "action" => "login", "plugin" => "usermgmt"), "direct" => true),
			"Principal" => array("url" => array("controller" => "pages", "action" => "dashboard", "admin" => true, "plugin" => false)),
			//"Usuarios" => array("url" => array("controller" => "users", "action" => "index", "plugin" => "usermgmt")),
			"Clientes" => array("url" => array("controller" => "customers", "action" => "index", "plugin" => false), "children" => array(
			)),
			"Eventos" => array("url" => array("controller" => "events", "action" => "index", "plugin" => false), "children" => array(
				__("Próximos") => array("url" => array("controller" => "events", "action" => "index", "type" => "upcoming", "plugin" => false)),
			)),
			"Menúes" => array("url" => array("controller" => "menus", "action" => "index", "plugin" => false)),
			"Estadísticas" => array("url" => array("controller" => "pages", "action" => "statistics", "admin" => false, "plugin" => false)),
			//"Logout" => array("url" => array("controller" => "users", "action" => "logout", "plugin" => "usermgmt"), "direct" => true)*/
		);
		
		$this->user = array(
			__("Panel") => array("url" => "/"),
		);
	}
	
	public function home() {
		return $this->menu($this->home);
	}
	
	public function contacts($profile_id) {
		foreach ($this->profile as $key => &$value) {
			if (is_array($value["url"])) {
				$value["url"][] = $profile_id;
			}
		}
		return $this->menu($this->profile);
	}
	
	public function user() {
		return $this->menu($this->user);
	}
	
	public function footer() {
		return $this->menu($this->footer);
	}
	
	public function dashboard() {
		return $this->menu($this->dashboard);
	}
}
