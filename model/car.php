<?php
class Car{
	public $id;
	public $model;
	public $year;
	public $price_day;
	public $manufacturer;
	public $body_type;
	
	
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

	//Хуки - методы которые мы навесим на таблицу, класс Table будет их дергать по наступлению события
	public function delete_row_by_id(EventArgument $arg){
	$dao=$GLOBALS['dao'];
	$id=$arg->argument;
	$errors=$dao->_delete($id);
	}
	
	public function update_price(EventArgument $arg){
		$dao=$GLOBALS['dao'];
		$difference=$arg->argument;
		if(is_numeric($difference)){
			$errors = $dao->_change_price($difference);
		}

	}
	
	public function add_car(EventArgument $arg){
		$dao=$GLOBALS['dao'];
		$car=$arg->argument;
		$errors=$this->validate();
		if(count($errors)==0){
			$errors=$dao->_add($car->get_arr());
		}

		
	}
	
	//Валидатор вернет 
	public function validate(){
		
		$errors=[];
	
		if(strlen(trim($this->model))<=255&&strlen(trim($this->model))>=1){
			
		}else{
			$errors['model']='can`t be empty and lengths must be less than 255 symbols';
		
		}
	
		if($this->year<=2019&&$this->year>=1806){
			
		}else{
		$errors['year']='must be between 1806 and 2019';
		}
		
		if(is_numeric($this->price_day)&&$this->price_day<=100000000){
		
		}else{
		$errors['price per day']=' must be numeric and less than 100000000';
		}
	
		if(!empty($this->manufacturer)){
		
		}else{
			$errors['manufacturer']='select it please';
		}
	
		if(!empty($this->body_type)){
		
		}else{
			$errors['body type']='select it please';
		} 
	 
		return $errors;
	}
}
?>