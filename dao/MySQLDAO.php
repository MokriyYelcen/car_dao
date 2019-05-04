<?php



class MySQLDAO implements IMyDao{
	private  $connection;
	public function __construct(){
		$this->connection= mysqli_connect('127.0.0.1','root','','test_db') ;
	}
	
	public  function _add(Car $item){
		$errors=array();
		if($this->connection){
			$manuf=$item->manufacturer;
			$body_type=$item->body_type;
			if(!is_numeric($manuf)&& !is_numeric($body_type)){
				if($tmp=mysqli_query($this->connection,"SELECT `id_manufacturer_car` FROM `manufacturer_car` WHERE `name` LIKE'%$manuf%'")){
					$row=mysqli_fetch_assoc($tmp);
					$id_manufacturer=$row['id_manufacturer_car'];
				}
				else{
					$errors['obj car']='no such manufecturer in db';
				}
				if($tmp1=mysqli_query($this->connection,"SELECT `id_body_type` FROM `body_type` WHERE `name` LIKE'%$body_type%'")){
					$row=mysqli_fetch_assoc($tmp1);
					$id_body_type=$row['id_body_type'];
				}
				else{
					$errors['obj car']= $OS.' -> no such body type in db';
				}
			}
			else{
				$errors['obj car']='manufecturer and body_type are numeric';
			}
			
			
			if(mysqli_query($this->connection,"INSERT INTO `car`(`model`,
																		   `year`,
																		   `price_day`,
																		   `id_manufacturer`,
																		   `id_body_type`) VALUES".'('.
																								"'".$item->model ."',".
																								"'".$item->year ."',".
																								"'".$item->price_day ."',".
																								"'".$id_manufacturer ."',".
																								"'".$id_body_type ."')"
																															)){
				
				
			}
			else{
				$errors['insert']='can`t insert 1row';
			}
		}
		else{
			$errors['connection']='can`t connect';
		}
		return $errors;
	}
	
	
	public  function _delete($id){
		$errors=array();
		if($this->connection){
			if(mysqli_query($this->connection,"DELETE FROM `car` WHERE `id_car`=$id ")){
				
			}
			else{
				$errors['delete']='can`t delete';
			}
			
		}
		else{
			$errors['connection']='can`t connect mysql';
				
		}
		return $errors;
	}
	public  function _search($searched=null){
		$errors=array();
		if($searched==null){
			if($this->connection){
				if($res=mysqli_query($this->connection,"
														SELECT `id_car`,`model`,`year`,`price_day`,`manufacturer_car`.`name` as 'manufacturer',`body_type`.`name` as'body_type'
														FROM `car` 
														INNER JOIN `manufacturer_car`ON(`car`.`id_manufacturer`=`manufacturer_car`.`id_manufacturer_car`)
														INNER JOIN `body_type` ON(`car`.`id_body_type`=`body_type`.`id_body_type`)
														")
				)
				{
					$arr=array();
					while($row=mysqli_fetch_assoc($res)){
						$arr[]=new Car(
										 $row['model'],
										 $row['year'],
										 $row['price_day'],
										 $row['manufacturer'],
										 $row['body_type'],
										 $row['id_car']);
					}
					
					return $arr;
				}
				else{
					$errors['read']='can`t read';
				}
			}
			else{
				$errors['connection']='can`t connect mysql';
			}
		}
		
		
		
		
		
		return $errors;
	}
	public  function _change_price($difference){
		$errors=array();
		if($this->connection){
			if(mysqli_query($this->connection,"UPDATE `car` SET `price_day`=`price_day`+ $difference")){}
			else {
				$errors['update']='can`t update';
				
			}
				
				
		}
		else{
			$errors['connection']='can`t connect mysql';
		}
		return $errors;
	}
	
	public  function _available_manufacturer(){
		$errors=array();
		if($this->connection){
			if($res=mysqli_query($this->connection,"SELECT `name` FROM `manufacturer_car` ")){
				$arr=array();
				while($row=mysqli_fetch_assoc($res)){
					$arr[]=$row['name'];
				}
				return $arr;
			}
			else{
				$errors['read']='can`t read manufacturers';
			}
		}
		else{
			$errors['connection']='can`t connect mysql';
		}
		return $errors;
	}
	
	public  function _available_body_type(){
		$errors=array();
		if($this->connection){
			if($res=mysqli_query($this->connection,"SELECT `name` FROM `body_type` ")){
				$arr=array();
				while($row=mysqli_fetch_assoc($res)){
					$arr[]=$row['name'];
				}
				return $arr;
			}
			else{
				$errors['read']='can`t read body_type';
			}
		}
		else{
			$errors['connection']='can`t connect mysql';
		}
		return $errors;
	}
	public function _clear_db(){
		$errors=array();
		if($this->connection){
			$delcar=mysqli_query($this->connection,"DELETE FROM `car` WHERE `id_car` IS NOT NULL");
			
			if($delcar){
				$delman=mysqli_query($this->connection,"DELETE FROM `manufacturer_car` WHERE `name` IS NOT NULL");
				$delbt=mysqli_query($this->connection,"DELETE FROM `body_type` WHERE `name` IS NOT NULL");
				if($delman&&$delbt){
				
				}
				else{
					$errors['delete']='can`t delete all from body_type manufecturers';
				}
			}
			else{
					$errors['delete']='can`t delete all from car';
				}
			
		}
		else{
			$errors['connection']='can`t connect mysql';
				
		}
		return $errors;
	}
	public  function _add_manufacturer($new){
		$errors=array();
		if($this->connection){
			if($res=mysqli_query($this->connection,"INSERT INTO`manufacturer_car`(`name`) VALUES ('$new')")){
				
			}
			else{
				$errors['insert']='can`t insert manufacturer';
			}
		}
		else{
			$errors['connection']='can`t connect mysql';
		}
		return $errors;
	}
	public  function _add_body_type($new){
		$errors=array();
		if($this->connection){
			if($res=mysqli_query($this->connection,"INSERT INTO`body_type`(`name`) VALUES ('$new')")){
				
			}
			else{
				$errors['insert']='can`t insert body_type';
			}
		}
		else{
			$errors['connection']='can`t connect mysql';
		}
		return $errors;
	}
	public  function _delete_test(){
		$errors=array();
		if($res=mysqli_query($this->connection,"DELETE FROM `manufacturer_car` WHERE `name` = 'test'")){
			
		}
		else{
			$errors['connection']='can`t connect MongoDB(delete)';
		}
		print_r ($errors);
	}
}
?>