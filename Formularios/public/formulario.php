<form action="procesar.php" method="POST" 
enctype="multipart/form-data">
<ul>
<li>Id <input type="hidden" name="id" value="1" /></li>
<li>Name <input type="text" name="name" value="1" /></li>
<li>Email <input type="text" name="email" value="1" /></li>
<li>Password <input type="password" name="password" value="1" /></li>
<li>Description <textarea name="description" row="10"></textarea>
<li>Address <input type="text" value="1" /></li>
<li>City <select name="city">
	<option value="vigo">Vigo</option>
	<option value="scq">Santiago</option>
	<option value="bcn">Barcelona</option>
</select></li>
<li>Sports <select multiple name="sports[]">
	<option value="beisbol">Besibol</option>
	<option value="natacion">Natacion</option>
	<option value="futbol">Futbol</option>
</select></li>
<li>Pets dog: <input type="checkbox" name="pets[]" value="dog" />
wolf: <input type="checkbox" name="pets[]" value="wolf" />
whale: <input type="checkbox" name="pets[]" value="whale" />
</li>
<li>Sexo M:<input type="radio" name="sex" value="M" />
H:<input type="radio" name="sex" value="H" />
O:<input type="radio" name="sex" value="O" />
</li>
<li>Photo <input type="file" name="photo"/></li>
<li>Submit <input type="submit" name="submit" value="Enviar" /></li>
<li>Button <input type="button" name="button" value="Button" /></li>
<li>Reset <input type="reset" name="reset" value="Reset" /></li>



</ul>
</form>
