<?php 
debug($arrayUsers);
?>
<a href="users.php?action=insert">Add</a>
<table border="1">
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
<?php foreach ($arrayUsers as $key => $rows): ?>
	<tr>
	<?php foreach($rows as $key2 => $row):?>
		<td><?=$row;?></td>
	<?php endforeach;?>
		<td>
			<a href="users.php?action=update&id=<?=$rows['iduser'];?>">update</a>
				&nbsp;
			<a href="users.php?action=delete&id=<?=$rows['iduser'];?>">delete</a>
		</td>
	</tr>
<?php endforeach;?>
</table>
	
