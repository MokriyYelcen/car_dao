<?php



class DAOFactory{
	
	public static function get_obj_DAO( $type){
		if ($type=='mysql'){
			
			return new MySQLDAO();
		}
		if ($type=='MongoDB'){
			
			return new MongoDAO();
		}
	}
}
?>