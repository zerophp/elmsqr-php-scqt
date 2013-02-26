
<?php
echo "<pre>Post:";
print_r($_POST);
echo "</pre>";

echo "<pre>Get:";
print_r($_GET);
echo "</pre>";

//Config
$userFilename="usuarios.txt";

// Leer datos del archivo de usuarios
$datos=file_get_contents($userFilename);

// Convertir los datos en array
$datos=explode("\r", $datos);

// Leer datos del usuario id
$usuario=$datos[$_GET['id']];

// Convertir datos usuario en array
$usuario=explode('|', $usuario);

// Hacer array sports
$sports=explode(',',$usuario[7]);

// Hacer array pets
$pets=explode(',',$usuario[8]);


echo "<pre>";
print_r($usuario);
echo "</pre>";


// Rellenar el formulario












?>

<form action="<?=(isset($_GET['id']))?'procesar_update.php':'procesar.php';?>" method="POST" 
enctype="multipart/form-data">
<ul>
<li>Id <input type="hidden" name="id" value="1" /></li>
<li>Name <input type="text" name="name" value="<?=$usuario[1];?>" /></li>
<li>Email <input type="text" name="email" value="<?=$usuario[2];?>" /></li>
<li>Password <input type="password" name="password" /></li>
<li>Description <textarea name="description" row="10"><?=$usuario[4];?></textarea>
<li>Address <input type="text" name="address" value="<?=$usuario[5];?>"/></li>
<li>City <select name="city">
	<option value="vigo" <?=($usuario[6]=='vigo')?'selected':'';?> >Vigo</option>
	<option value="scq" <?=($usuario[6]=='scq')?'selected':'';?> >Santiago</option>
	<option value="bcn" <?=($usuario[6]=='bcn')?'selected':'';?>>Barcelona</option>
</select></li>
<li>Sports <select multiple name="sports[]">
	<option value="beisbol" <?=(in_array('beisbol',$sports))?'selected':'';?>>Besibol</option>
	<option value="natacion" <?=(in_array('natacion',$sports))?'selected':'';?>>Natacion</option>
	<option value="futbol" <?=(in_array('futbol',$sports))?'selected':'';?>>Futbol</option>
</select></li>
<li>Pets dog: <input type="checkbox" name="pets[]" value="dog" <?=(in_array('dog',$pets))?'checked':'';?>/>
wolf: <input type="checkbox" name="pets[]" value="wolf" <?=(in_array('wolf',$pets))?'checked':'';?>/>
whale: <input type="checkbox" name="pets[]" value="whale" <?=(in_array('whale',$pets))?'checked':'';?>/>
</li>
<li>Sexo M:<input type="radio" name="sex" value="M" <?=($usuario[9]=='M')?'checked':'';?>/>
H:<input type="radio" name="sex" value="H" <?=($usuario[9]=='H')?'checked':'';?>/>
O:<input type="radio" name="sex" value="O" <?=($usuario[9]=='O')?'checked':'';?>/>
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




	
























