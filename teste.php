<?php $nome = "vazio"?>
<form method="POST" action="">
	<input type="text" id="name" name="name" value=""></input>
	<input type="submit"></input>
	<?php echo $nome ?>
</form>

<?php
if(isset($_POST['name']) && !empty($_POST['name'])) {
	echo 'Welcome, ' . $_POST['name']; 
	$nome = $_POST['name']; 
}
?>