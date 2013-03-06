<form method="POST" enctype="multipart/form-data">
<ul>
<li>Id <input type="hidden" name="id" value="<?=(isset($_GET['id']))?$_GET['id']:''?>" /></li>
<li>Name <input type="text" name="name" value="<?=(isset($usuario['name']))?$usuario['name']:'';?>" /></li>
<li>Email <input type="text" name="email" value="<?=(isset($usuario['email']))?$usuario['email']:'';?>" /></li>
<li>Password <input type="password" name="password" /></li>
<li>Description <textarea name="description" row="10"><?=(isset($usuario['description']))?$usuario['description']:'';?></textarea>
<li>Address <input type="text" name="address" value="<?=(isset($usuario['address']))?$usuario['address']:'';?>"/></li>
<li>City 
	<?=selectboxFromDB($config, 'cities', 'city', 'idcity','cities_idcity', array($usuario['cities_idcity']), FALSE);?>
</li>
<li>Sports 
	<?=selectboxFromDB($config, 'sports', 'sport', 'idsport','sport', array($usuario['sports']), TRUE);?>
</li>
<li>Pets 
	<?=radioCheckFromDB($config, 'pets', 'pet', 'idpet', 'pets', $usuario['pets'], TRUE);?>
</li>
<li>Sexo 
	<?=radioCheckFromDB($config, 'genders', 'gender', 'idgender', 'genders_idgender', array($usuario['genders_idgender']), FALSE);?>
</li>
<li>
	Photo <input type="file" name="photo"/>
	<?php if(isset($usuario[11])):?>
		<img src="/uploads/<?php echo $usuario[11];?>"/>		
	<?php endif;?>
</li>
<li>Submit <input type="submit" name="submit" value="Enviar" /></li>
<li>Button <input type="button" name="button" value="Button" /></li>
<li>Reset <input type="reset" name="reset" value="Reset" /></li>
</ul>
</form>




	
























