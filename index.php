<?php
require ('references.php');
$dao= DAOFactory::get_obj_DAO(DAOenum::MySQLDAO);
$table= new Table();
	switch (TableView::table_case()){

		case'del':
			$id=$_POST['button'][0];
			$table->delete_car_from_table($id);
		break;

		case'update':
			$difference=$_POST['difference'];
			$table->update_car_price_in_table($difference);
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
			$table->add_car_to_table($new);
		break;
		}
$view= new TableView($table);
$view->render();

	
	
	
	
	










?>