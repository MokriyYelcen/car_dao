<?
include ('migration.php');
$action=$_SERVER['PHP_SELF'];
$form="<form name=\"form\" method=\"post\" action=\"$action\" align=\"center\" id=\"#help\">";
$form.="<div id=\"button\">"."<input type=\"submit\" name=\"to_mysql\" value=\"migrate to MySql\" id=\"iinput\" >"."</div>";
$form.="<div id=\"button\">"."<input type=\"submit\" name=\"to_mongo\" value=\"migrate to MongoDB\" id=\"iinput\" >"."</div>";
$form.="</form>";
$html='<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Идентификаторы</title>
  <style>
   #help {
    position: absolute; /* Абсолютное позиционирование */
    left: 160px; /* Положение элемента от левого края */
    top: 50px; /* Положение от верхнего края */
    width: 225px; /* Ширина блока */
    padding: 5px; /* Поля вокруг текста */
    background: #f0f0f0; /* Цвет фона */ 
	margin: center; 
   }
   #button{
	   width: 50px;
	   length:20px;
   }
   #iinput{
	   margin: center;
   }
  </style>
 </head> 
 <body> 
  <div id="help">
   '.$form.'
  </div>
 </body> 
</html>';

if('POST'==$_SERVER['REQUEST_METHOD']){
	switch(controll()){
		case 'to_mysql':Migration::to_mysql();break;
		case 'to_mongo':Migration::to_mongo();break;
		case '':print"Something went wrong";break;
	}
}
print $html;
function controll(){
	
	if($_POST['to_mysql']){return 'to_mysql';}
	if($_POST['to_mongo']){return 'to_mongo';}
}
