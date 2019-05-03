<?php
require ('references.php');
$dao= DAOFactory::get_obj_DAO(DAOenum::MySQLDAO);
$errors=array();

	if('POST'==$_SERVER['REQUEST_METHOD']){
		
		//////////////////////////////////////////////////////////////////////////////////////////////
		
		
		switch (control()){
			case'del':
			
			
			if(delete_row_by_id($dao)){//в этой функции запрос на удаление
				 show_car_table($dao);
			}else{
				 show_errors();
			}
			
			break;
			case'add':
			
			if($input=validate_input()){
				//print'validation went well </br>';
				 if(add_car($dao,$input)){
					show_car_table($dao);
				}else{
					show_errors();
				}
				
				
			}else{print'validation didnt go well </br>';show_errors();}
			
			break;
			case'update':

			if(update_price($dao)){
				show_car_table($dao);
			}
			else{
				show_errors();
			}
		}
		
	}else{
		show_car_table($dao);
	}
	
	
	
	
	










?>