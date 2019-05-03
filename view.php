<?php
function show_car_table($dao){
	
	//формируем селект для вставки производителя
	$range_m=$dao->_available_manufacturer();
	$select_manuf='<select size="0"  name="manufacturer[]">';
	foreach($range_m as $available){
		$select_manuf.="<option value=\"$available\">$available</option>";
	}
    $select_manuf.='</select>';
	//формируем селект для вставки типа кузова
	$range_b=$dao->_available_body_type();
	$select_b='<select size="0"  name="body_type[]">';
	foreach($range_b as $available1){
		$select_b.="<option value=\"$available1\">$available1</option>";
	}
    $select_b.='</select>';
	
	$arr=$dao->_search();
	$action=$_SERVER['PHP_SELF'];
	print"<form  name=\"dele\" method=\"post\" action=\"$action\" align=\"center\" style=\"width:800\" > ";
	print'<table align="center" border="1" >';
	foreach($arr as $ex){
		$id=$ex->id;
		$model=$ex->model;
		$year=$ex->year;
		$price_day=$ex->price_day;
		$manufacturer=$ex->manufacturer;
		$body_type=$ex->body_type;
		
	$r='<tr>'.
									"<td>$model</td>".
									"<td>$year</td>".
									"<td>$price_day</td>".
									"<td>$manufacturer</td>".
									"<td>$body_type</td>".
									"<td><button name=\"button[]\" value=\"$id\" ><strong style=\"color:RED;background:YELLOW;font-size:30px;\">&#10008</strong></button></td>".
									
			'</tr>';
		print $r;
	}
	
	
	print"<tr>".
	"<td>"."<input type=\"text\" name=\"model\" placeholder=\"model\" >"."</td>".
	"<td>"."<input type=\"text\" name=\"year\" placeholder=\"year\" >"."</td>".
	"<td>"."<input type=\"text\" name=\"price_day\" placeholder=\"price day\" >"."</td>".
	"<td>".$select_manuf."</td>".
	"<td>".$select_b."</td>".
	"<td>"."<input type=\"submit\" name=\"add\" value=\"add new car\" style=\"font-size:30px;\" >"."</td>".
	"</tr>";
	print "<tr>".
	"<td>"."</td>".
	"<td>"."</td>".
	"<td>"."<input type=\"text\" name=\"difference\" placeholder=\"difference\" >"."</td>".
	"<td>"."</td>".
	"<td>"."</td>".
	"<td>"."<input type=\"submit\" name=\"update\" value=\"Change price\" style=\"font-size:30px;\" >"."</td>".
	"</tr>";
	print"</table>".'</form>';
}

function delete_row_by_id($dao){
	$id=$_POST['button'][0];
	$errors=$dao->_delete($id);
	if(0==count($errors)){
		return true;
	}
	else{
		foreach($errors as $ex =>$value){
			$GLOBALS['errors'][$ex]=$value;
		}
		return false;
	}
}

function add_car($dao,$valid_new_car){
	
		$errors=$dao->_add($valid_new_car);
		if(count ($errors)==0){
			return true;
		}
		else{
			foreach($errors as $key=>$value){
				$GLOBALS['errors'][$key]=$value;
			}
			return false;

		}
	
}

function validate_input(){
	
	$val_errors=0;
	
 	if(strlen(trim($model=$_POST['model']))<=255){
		$inputmodel=htmlspecialchars($model);
	}else{
		$GLOBALS["errors"]['model']='lengths must be less than 255 symbols';
		$val_errors++;
	}
	$year=$_POST['year'];
	if($year<=2019&&$year>=1806){
		$inputyear=$year;
	}else{
		$GLOBALS["errors"]['year']='must be between 1806 and 2019';
		$val_errors++;
	}
	$price_day=$_POST['price_day'];
	if(is_numeric($price_day)&&$price_day<=100000000){
		$inputprice_day=$price_day;
	}else{
		$GLOBALS["errors"]['price per day']=' must be numeric and less than 100000000';
		$val_errors++;
	}
	

	if(count($_POST['manufacturer'])!=0){
		$inputmanufacturer=htmlspecialchars($_POST['manufacturer'][0]);
	}else{
		$GLOBALS["errors"]['manufacturer']='select it please';
		$val_errors++;
	}
	
	if(count($_POST['body_type'])!=0){
		$inputbody_type=htmlspecialchars($_POST['body_type'][0]);
	}else{
		$GLOBALS["errors"]['body type']='select it please';
		$val_errors++;
	} 
	 
	
	
	$input=new Car(
										 $inputmodel,
										 $inputyear,
										 $inputprice_day,
										 $inputmanufacturer,
										 $inputbody_type,
										 null);
	
	
	
	if($val_errors==0){
		return $input;
	}else{
		return false;
	}
}

function update_price($dao){
	$difference=$_POST['difference'];
	$errors=$dao->_change_price($difference);
	if(0==count($errors)){
		return true;
	}
	else{
		foreach($errors as $ex =>$value){
			$GLOBALS['errors'][$ex]=$value;
		}
		return false;
	}
}
function show_errors(){
	$errors=$GLOBALS["errors"];
	foreach($errors as $place=>$error){
		print'Error in '.$place.' text: '.$error;
	}
}

function control(){
	if($_POST['button'][0]){return 'del';}
	if($_POST['add']){return 'add';}
	if($_POST['update']){return 'update';}
}
?>