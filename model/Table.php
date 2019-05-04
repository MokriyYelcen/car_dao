<?php
class Table{
	
	public $arr_car;
	public $arr_man;
	public $arr_bt;
	
	public function __construct($dao,$params=null){
		
		$this->arr_man=$dao->_available_manufacturer();
		$this->arr_bt=$dao->_available_body_type();
		if($params==null){
			$arr=[];
			$content=$dao->_search();
			foreach($content as $row){
				$arr[]= new Car(
								$row['model'],
								$row['year'],
								$row['price_day'],
								$row['manufacturer'],
								$row['body_type'],
								$row['_id']
									);
			}
			$this->arr_car=$arr;
		}
		else{
			$this->arr_car=$dao->_search();
		}
	}
	
	

}
?>