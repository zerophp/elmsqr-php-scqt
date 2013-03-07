<?php 
$usuario=$viewVars['usuario'];
?>

<ul>
<li><a href="/index/index">Home</a></li>
<li><a href="/author/login">Login</a></li>
<li><a href="/users/select">Backend</a></li>

</ul>
<form method="POST" enctype="multipart/form-data">
<ul>
<li>Email <input type="text" name="email" value="<?=(isset($usuario['email']))?$usuario['email']:'';?>" /></li>
<li>Password <input type="password" name="password" /></li>
<li>Submit <input type="submit" name="submit" value="Enviar" /></li>
</ul>
</form>

