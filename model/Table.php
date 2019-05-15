<?php
class Table extends Publisher{
	
	public $arr_car;
	public $arr_man;
	public $arr_bt;
	protected $Events=['onDelete','onUpdate_price','onAdd'];
	
	public function __construct($params=null){
		$dao=$GLOBALS['dao'];
		$this->arr_man=$dao->_available_manufacturer();
		$this->arr_bt=$dao->_available_body_type();
		if($params==null){
			$content=$dao->_search();
			foreach($content as $row){
				$next=new Car(
								$row['model'],
								$row['year'],
								$row['price_day'],
								$row['manufacturer'],
								$row['body_type'],
								$row['_id']
									);
				// Подписываем каждую следующую машину на события таблицы
				$reflection_car=new ReflectionClass($next);
				$this->onDelete= $reflection_car->getMethod('delete_row_by_id')->getClosure($next);
				$this->onUpdate_price= $reflection_car->getMethod('update_price')->getClosure($next);
				$this->onAdd= $reflection_car->getMethod('add_car')->getClosure($next);
				$this->arr_car[$next->id]=$next;
			}
		}
		else{
			$this->arr_car=$dao->_search();
		}
	}
	
	public function delete_car_from_table($id){
		//удаляем из таблицы
		unset($this->arr_car[$id]);
		//запускаем событие
		$this->executeEvent('onDelete',$id);
	}
	public function update_car_price_in_table($difference){
		//изменяем цену машин таблице
		foreach($this->arr_car as $car){
			$car->price_day+=$difference;
		}
		//запускаем событие
		$this->executeEvent('onUpdate_price',$difference);
	}
	public function add_car_to_table($car){
		//добавляем в таблицу
		$this->arr_car[]=$car;
		//запускаем событие
		$this->executeEvent('onAdd',$car);
	}

}
?>