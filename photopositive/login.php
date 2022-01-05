<?php
/*
Template Name: ByNextPr - User Login
*/
?>
<?php
// проверка переходи с формы логина или регистрации

// форма логина
if(isset($_POST['login-submit']) && isset($_POST['login']) && isset($_POST['pass'])) {
	print_r($_POST);
	echo "форма логина";
}

// форма регистрации
if(isset($_POST)) {
	print_r($_POST);
	echo "форма регистрации";
}
?>
