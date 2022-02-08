<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class WY_Loader extends CI_Loader {
	/**
	* removes the model from the list of models
	* @param $model
	*/
	public function unload($model) {
		
		if (in_array($model, $this->_ci_models, true)) {
			unset($this->_ci_models[0]);
			$CI =& get_instance();
			unset($CI->$model);
			// dump($this->_ci_models);
			// $this->_ci_models = array_diff($this->_ci_models, array($model));
		}
	}
}