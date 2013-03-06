<?php

function debug($var, $label='')
{
	echo "<pre>".$label.": ";
	print_r($var);
	echo "</pre>";
}