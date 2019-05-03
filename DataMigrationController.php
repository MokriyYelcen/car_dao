<?php
require ('references.php');

class Migration{
	public static function to_mongo(){
		$dao_my=DAOFactory::get_obj_DAO(DAOenum::MySQLDAO);
		$dao_mon=DAOFactory::get_obj_DAO(DAOenum::MongoDBDAO);
		
		$content=$dao_my->_search();
		$count=count($content);
		$i=0;
		foreach($content as $ex){
			if(count($dao_mon->_add($ex))==0){
			$i++;
			}
		}
		print $i." records from ".$count."inserted to mongo";
	}
	
	public static function to_mysql(){
		$dao_my=DAOFactory::get_obj_DAO(DAOenum::MySQLDAO);
		$dao_mon=DAOFactory::get_obj_DAO(DAOenum::MongoDBDAO);
		
		$content=$dao_mon->_search();
		$count=count($content);
		$i=0;
		foreach($content as $ex){
			if(count($dao_my->_add($ex))==0){
			$i++;
			}
		}
		print $i." records from ".$count."inserted to mysql";
	}
}
?>