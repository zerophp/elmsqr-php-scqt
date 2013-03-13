<?php 
$usuario=$viewVars['usuario'];
?>
<form method="POST"
enctype="multipart/form-data">
	<ul>
		<li>Id <input type="hidden" name="id" value="<?=(isset($_GET['id']))?$_GET['id']:''?>" /></li>
		<li>SEGURO QUE DESEA BORRAR EL USUARIO: <?=$usuario['name'];?></li>
		<li>Submit <input type="submit" name="submit" value="Si" /></li>
		<li>Submit <input type="submit" name="submit" value="No" /></li>
	</ul>
</form>