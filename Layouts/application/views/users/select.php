<?php 
$arrayUsers=$viewVars['arrayUsers'];
$title=$viewVars['title'];
?>


<ul>
<li><a href="/index/index">Home</a></li>
<li><a href="/author/login">Login</a></li>
<li><a href="/author/logout">Logout</a></li>
<li><a href="/users/select">Backend</a></li>
<li>Hola <?=$_SESSION['iduser']?></li>

</ul>
<a href="?controller=users&action=insert">Add</a>
<table border="1">
	<tr>
		<th>id</th>
		<th>name</th>
		<th>email</th>
		<th>password</th>
		<th>description</th>
		<th>address</th>
		<th>pets</th>
		<th>photo</th>
		<th>city</th>
		<th>sex</th>
		<th>sports</th>
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
	
