<a href="formulario.php">Add</a>
<?php 
$filename="usuarios.txt";
$content=file_get_contents($filename);

$files=explode("\r", $content);

echo "<table border=\"1\">
	<tr>
		<th>id</th>
		<th>name</th>
		<th>email</th>
		<th>password</th>
		<th>description</th>
		<th>address</th>
		<th>city</th>
		<th>sports</th>
		<th>pets</th>
		<th>sex</th>
		<th>enviar</th>
		<th>photo</th>		
		<th>options</th>
	</tr>
	";

foreach($files as $key => $file)
{
	$rows=explode("|",$file);
	echo "<tr>";
	foreach($rows as $key2 => $row)
	{
		echo "<td>".$row."</td>";		
		
	}
	echo "<td>
			<a href=\"formulario.php\">update</a>
				&nbsp;
			<a href=\"#\">delete</a>
		</td>";
	echo "</tr>";
}
	
echo "</table>";
	
