<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Excel{
	
	function __construct(){
		//parent::__construct();
		require_once APPPATH.'third_party/PHPExcel/PHPExcel.php';
		/*$excel=new PHPExcel();
		$ci=&get_instance();
		$ci->excel=$excel;*/
	}

}
?>