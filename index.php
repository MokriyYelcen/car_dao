<?php
require ('references.php');
$dao= DAOFactory::get_obj_DAO(DAOenum::MongoDBDAO);
	
	switch (TableView::table_case()){
		
		
		case'del':
			$id=$_POST['button'][0];
			if (count($errors=Car::delete_row_by_id($id,$dao))==0){
				$table= new Table($dao);
				$view= new TableView($table);
				$view->render();
			}
			else{
				TableView::show_errors($errors);
			}
		break;
				
				
		case'add':
			// для создания экземпляра машины вызываем конструктор модли
			$new = new Car(
							htmlspecialchars($_POST['model']),
							htmlspecialchars($_POST['year']),
							htmlspecialchars($_POST['price_day']),
							htmlspecialchars($_POST['manufacturer'][0]),
							htmlspecialchars($_POST['body_type'][0])
							);
			//
			if (count($errors=$new->add_car($dao))==0){
				$table= new Table($dao);
				$view= new TableView($table);
				$view->render();
			}
			else{
				TableView::show_errors($errors);
			}
		break;
		
		
		case'update':
			$difference=$_POST['difference'];
			if (count($errors=Car::update_price($difference,$dao))==0){
				$table= new Table($dao);
				$view= new TableView($table);
				$view->render();
			}
			else{
				TableView::show_errors($errors);
			}
		break;
		
		case'':
			$table= new Table($dao);
			$view= new TableView($table);
			$view->render();
		break;
		}


	
	
	
	
	










?>