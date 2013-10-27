<?

App::uses('ModelBehavior', 'Model');

class UIModelBehavior extends ModelBehavior {
	public function afterValidate(Model $model) { //file_put_contents("validation.txt", "afterValidate {$model->alias}\n", FILE_APPEND); 
		CakeSession::write("validationError", CakeSession::read("validationError") || (!empty($model->validationErrors)) );
		//file_put_contents("validation.txt", print_r($model->validationErrors, true), FILE_APPEND);
		return parent::afterValidate($model);
	}
}
