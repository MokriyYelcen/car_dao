<?

use MongoDB\BSON\ObjectID;
use MongoDB\Driver\Query;
class MongoDAO implements IMyDao{
	private $client;
	private $db;
	public function __construct(){
		$this->client=new MongoClient();
		$this->db=$this->client->car;
	}
	public  function _add(Car $item){
		
		$errors=array();
		//$query= new Query([],);
		$doc=array(
					 "model" =>$item->model,
					 "year" =>$item->year,
					 "price_day" =>$item->price_day*1,
					 "manufacturer" =>$item->manufacturer,
					 "body_type" =>$item->body_type,
					 );
		if($res=$this->db->car->insert($doc)){
			
		}
		else{
			$errors['connection']='can`t connect MongoDB(insert)';
		}
		return $errors;
	}
	public  function _delete($id){
		$errors=array();
		//$query= new Query([],);
		if($res=$this->db->car->remove(array('_id' => new MongoId($id)), array("justOne" => true))){
			
		}
		else{
			$errors['connection']='can`t connect MongoDB(delete)';
		}
		return $errors;
	}
	public  function _search($searched=null){
		$errors=array();
		if($searched==null){
			
			if($res=$this->db->car->find()){
				$arr=array();
				foreach($res as $doc ){
					
					$arr[]=new Car(
										 $doc['model'],
										 $doc['year'],
										 $doc['price_day'],
										 $doc['manufacturer'],
										 $doc['body_type'],
										 $doc['_id']
								);

				}
			return $arr;
			}
			else{
				$errors['connection']='can`t connect MongoDB';
			}
		}
		return $errors;
	}
	public  function _change_price($difference){
		$errors=array();
		//$query= new Query([],);
		if($res=$this->db->car->update([],array('$inc'=>array("price_day"=>$difference*1)),['multiple'=>true])){
			
		}
		else{
			$errors['connection']='can`t connect MongoDB(update)';
		}
		return $errors;
	}
	public  function _available_manufacturer(){
		$errors=array();
		if($res=$this->db->manufacturer->find()){
			$arr=array();
			foreach($res as $doc){
				$arr[]=$doc['manufacturer'];
			}
			return $arr;
		}
		else{
			$errors['connection']='can`t connect MongoDB';
		}
		return $errors;
	}
	public  function _available_body_type(){
		$errors=array();
		if($res=$this->db->body_type->find()){
			$arr=array();
			foreach($res as $doc){
				$arr[]=$doc['body_type'];
			}
			return $arr;
		}
		else{
			$errors['connection']='can`t connect MongoDB';
		}
		return $errors;
	}
	public function _clear_db(){
		$errors=array();
		$delman=$this->db->manufacturer->remove(array(), array("justOne" => false));
		$delbt=$this->db->body_type->remove(array(), array("justOne" => false));
		if($delman&&$delbt){
			if($res=$this->db->car->remove(array(), array("justOne" => false))){

			}
			else{
				$errors['connection']='can`t connect MongoDB(delete all from car)';
			}
		}else{
			$errors['connection']='can`t connect MongoDB(delete all from body_type, manufacturers)';
		}
		return $errors;
	}
	public  function _add_manufacturer($new){
		$errors=array();
		if($res=$this->db->manufacturer->insert(array('manufacturer'=>$new))){
			
		}
		else{
			$errors['connection']='can`t connect MongoDB(insert_manufacturer)';
		}
		return $errors;
	}
	public  function _add_body_type($new){
		$errors=array();
		if($res=$this->db->body_type->insert(array('body_type'=>$new))){
			
		}
		else{
			$errors['connection']='can`t connect MongoDB(insert_body_type)';
		}
		return $errors;
	}
	public  function _delete_test(){
		$errors=array();
		//$query= new Query([],);
		if($res=$this->db->manufacturer->remove(array('manufacturer' => 'test'))){
			
		}
		else{
			$errors['connection']='can`t connect MongoDB(delete)';
		}
		print_r ($errors);
	}
}
?>








