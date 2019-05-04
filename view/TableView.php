<?php
class TableView{
	public $table;
	
	public function __construct(Table $table){
		$this->table=$table;
		
	}
	
	public function render(){
	
	//формируем селект для вставки производителя
	
	$select_man='<select size="0"  name="manufacturer[]">';
	foreach($this->table->arr_man as $available_man){
		$select_man.="<option value=\"$available_man\">$available_man</option>";
	}
    $select_man.='</select>';
	//формируем селект для вставки типа кузова
	
	$select_bt='<select size="0"  name="body_type[]">';
	foreach($this->table->arr_bt as $available_bt){
		$select_bt.="<option value=\"$available_bt\">$available_bt</option>";
	}
    $select_bt.='</select>';
	
	
	$action=$_SERVER['PHP_SELF'];
	print"<form  name=\"dele\" method=\"post\" action=\"$action\" align=\"center\" style=\"width:800\" > ";
	print'<table align="center" border="1" >';
	foreach($this->table->arr_car as $ex){
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
	"<td>".$select_man."</td>".
	"<td>".$select_bt."</td>".
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
	print "<tr>".
	"<td>"."</td>".
	"<td>"."</td>".
	"<td>"."</td>".
	"<td>"."</td>".
	"<td>"."</td>".
	"<td>"."<a href=\"DataMigrationController.php\">Migration</a>"."</td>".
	"</tr>";
	print"</table>".'</form>';
}
	
	public static function show_errors($errors){
		
		foreach($errors as $place=>$error){
			print'Error in '.$place.' text: '.$error.'</br>';
		}
	}
	public static function table_case(){
	if($_POST['button'][0]){return 'del';}
	if($_POST['add']){return 'add';}
	if($_POST['update']){return 'update';}
	}
}



?>