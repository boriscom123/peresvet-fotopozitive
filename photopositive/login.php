<?php
/*
Template Name: ByNextPr - User Login
*/
?>
<?php
if(isset($_POST['login-submit']) && isset($_POST['login']) && isset($_POST['pass'])) {
	print_r($_POST);
	echo "форма логина";
}

if(isset($_POST)) {
	print_r($_POST);
	echo "форма регистрации";
}
?>