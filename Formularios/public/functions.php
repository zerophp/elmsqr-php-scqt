<?php


/**
 *	Show array values
 * 	
 * @param array $array
 * @return boolean
 */

function muestraArray($array)
{
	foreach ($array as $key => $value)
	{
		echo $key.": ";
		if(is_array($value))
			echo implode(',', $value);
		else
			echo $value;
		echo "<br/>";
	}
	return TRUE;
}