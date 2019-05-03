<?php
class Car{
	public $id;
	public $model;
	public $year;
	public $price_day;
	public $manufacturer;
	public $body_type;
	
	/*
	public function __construct(){
		$this->id=0;
		$this->manufacturer=0;
		$this->OS=0;
		$this->price=0;
		$this->memory=0;
		$this->screen=0;
		$this->model=0;
		$this->sim_card=0;
	}*/
	
	public function __construct($model,$year,$price_day,$manufacturer,$body_type,$id=null){
		$this->id=$id;
		$this->model=$model;
		$this->year=$year;
		$this->price_day=$price_day;
		$this->manufacturer=$manufacturer;
		$this->body_type=$body_type;
	}
	
	public function get_arr(){
		return array(
					 "model" =>$this->model,
					 "year" =>$this->year,
					 "price_day" =>$this->price_day*1,
					 "manufacturer" =>$this->manufacturer,
					 "body_type" =>$this->body_type,
					 );
	}
	public function info(){
		$arr=$this->get_arr();
		foreach($arr as $key=>$value){
			
			print '"'.$key.'": "'.$value.'"'."<br>";
		}
		
	}

	
	
}
?>