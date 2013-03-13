<?php


/**
 * Create a select box from DB
 * 
 * @param array $config
 * @param string $table 
 * @param string $labelColumn 
 * @param string $idColumn
 * @param string $name
 * @param array $data
 * @param boolean $multiple
 * @return string $html
 */
function selectboxFromDB($config, $table, $labelColumn, $idColumn, 
						$name, array $data, $multiple=FALSE)
{
	
	$html='';
	
	// Conectar al servidor y a la BD
	$link=mysqli_connect($config['db.server'], $config['db.user'],
			$config['db.password'],$config['db.database']);
	
	// Leer datos de table
	$query = "SELECT * FROM ".$table;
	$result=mysqli_query($link, $query);
	
	if($multiple===TRUE)
		$html.="<select multiple name=\"".$name."[]\">";
	else
		$html.="<select name=\"".$name."\">";
	
	
	
	while($row=mysqli_fetch_assoc($result))
	{
		$html.="<option value=\"".$row[$idColumn]."\"";
					if(in_array($row[$idColumn],$data))
						$html.='selected';
					else
						$html.=''; 
		$html.=">".$row[$labelColumn]."</option>";
	}
	
	$html.="</select>";
	// Recorrer el recordset creando el html
		
	return $html;
}




function radioCheckFromDB ($config, $table, $labelColumn, $idColumn, 
						$name, $data, $checkbox=FALSE)
{
	
	if(!is_array($data))
		$data=explode(',',$data);

	$html='';
	
	// Conectar al servidor y a la BD
	$link=mysqli_connect($config['db.server'], $config['db.user'],
			$config['db.password'],$config['db.database']);
	
	// Leer datos de table
	$query = "SELECT * FROM ".$table;
	
	if($checkbox===TRUE)
	{
		$fieldType="checkbox";
		$name=$name."[]";
	}
	else
	{
		$fieldType="radio";
	}
	
	// Recorrer el recordset creando el html
	$result=mysqli_query($link, $query);
	
	
	while($row=mysqli_fetch_assoc($result))
	{
		$html.= $row[$labelColumn].": ";
		$html.="<input type=\"".$fieldType."\" name=\"".$name."\" value=\"".$row[$idColumn]."\""; 
		 	if(in_array($row[$idColumn],$data))
		 		$html.="checked";
		 	else
		 		$html.="";
		$html.="/>";
	}
	
	
	
	return $html;
}





