<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'vendor/smarty/smarty/libs/Smarty.class.php' );

function minify_html($tpl_output, Smarty_Internal_Template $template) {
	$tpl_output = preg_replace('![\t ]*[\r\n]+[\t ]*!', '', $tpl_output);
	return $tpl_output;
}
class Smartty extends Smarty {

    public function __construct() {
        parent::__construct();
        $CI =& get_instance();
        $this->setTemplateDir(VIEWPATH);
        $this->setCompileDir('tmp/' . $CI->router->class);
	    // $this->loadFilter('output', 'trimwhitespace');
	    // $this->registerFilter("output", "minify_html");
    }
}
/* End of file Smartty.php */