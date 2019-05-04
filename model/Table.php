<?php
class Table{
	private $dao;
	public $arr_car;
	public $arr_man;
	public $arr_bt;
	
	public function __construct($dao,$params=null){
		$this->dao=$dao;
		$this->arr_man=$dao->_available_manufacturer();
		$this->arr_bt=$dao->_available_body_type();
		if($params=null){
			$this->arr_car=$dao->_search();
		}
		else{
			$this->arr_car=$dao->_search();
		}
	}
	public function update_price($difference){
	$errors = $this->dao->_change_price($difference);
	
	return $errors;
	}
}
?>