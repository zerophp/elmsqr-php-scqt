<form method="POST" enctype="multipart/form-data">
<ul>
<li>Id <input type="hidden" name="id" value="<?=(isset($_GET['id']))?$_GET['id']:''?>" /></li>
<li>Name <input type="text" name="name" value="<?=(isset($usuario[1]))?$usuario[1]:'';?>" /></li>
<li>Email <input type="text" name="email" value="<?=(isset($usuario[2]))?$usuario[2]:'';?>" /></li>
<li>Password <input type="password" name="password" /></li>
<li>Description <textarea name="description" row="10"><?=(isset($usuario[4]))?$usuario[4]:'';?></textarea>
<li>Address <input type="text" name="address" value="<?=(isset($usuario[5]))?$usuario[5]:'';?>"/></li>
<li>City <select name="city">
	<option value="vigo" <?=(isset($usuario[6])&&$usuario[6]=='vigo')?'selected':'';?> >Vigo</option>
	<option value="scq" <?=(isset($usuario[6])&&$usuario[6]=='scq')?'selected':'';?> >Santiago</option>
	<option value="bcn" <?=(isset($usuario[6])&&$usuario[6]=='bcn')?'selected':'';?>>Barcelona</option>
</select></li>
<li>Sports <select multiple name="sports[]">
	<option value="beisbol" <?=(isset($usuario[7])&&in_array('beisbol',$sports))?'selected':'';?>>Besibol</option>
	<option value="natacion" <?=(isset($usuario[7])&&in_array('natacion',$sports))?'selected':'';?>>Natacion</option>
	<option value="futbol" <?=(isset($usuario[7])&&in_array('futbol',$sports))?'selected':'';?>>Futbol</option>
</select></li>
<li>Pets dog: <input type="checkbox" name="pets[]" value="dog" <?=(isset($usuario[8])&&in_array('dog',$pets))?'checked':'';?>/>
wolf: <input type="checkbox" name="pets[]" value="wolf" <?=(isset($usuario[8])&&in_array('wolf',$pets))?'checked':'';?>/>
whale: <input type="checkbox" name="pets[]" value="whale" <?=(isset($usuario[8])&&in_array('whale',$pets))?'checked':'';?>/>
</li>
<li>Sexo M:<input type="radio" name="sex" value="M" <?=(isset($usuario[9])&&$usuario[9]=='M')?'checked':'';?>/>
H:<input type="radio" name="sex" value="H" <?=(isset($usuario[9])&&$usuario[9]=='H')?'checked':'';?>/>
O:<input type="radio" name="sex" value="O" <?=(isset($usuario[9])&&$usuario[9]=='O')?'checked':'';?>/>
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




	
























