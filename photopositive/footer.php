<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photopositive
 */

?>

	<footer class="footer">
		<div class="footer-flex">
			<div class="">
				<h2>Проект Фотопозитив</h2>
				<a class="" href="https://pv-foto.ru/%d0%b3%d0%b0%d0%bb%d0%b5%d1%80%d0%b5%d1%8f/">Галерея</a>
				<a class="" href="https://pv-foto.ru/%d0%bf%d0%be%d0%b1%d0%b5%d0%b4%d0%b8%d1%82%d0%b5%d0%bb%d0%b8/">Победители</a>
				<a class="footer-link__enter" href="https://pv-foto.ru/#forms">Войти</a>
				<h3><a class="open-rules" href="<?php echo get_template_directory_uri(); ?>/rules.pdf">Правила участия</a></h3>
			</div>
			<div class="text-right">
				<a href="http://peresvet-group.com/"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo.png" alt="logo"></a>
				<p>Мы в соцсетях:</p>
				<div class="">
					<?php
						$page_title = 'facebook';
						$vk_page = get_page_by_title( $page_title);
						$facebook = strstr(strstr($vk_page->post_content, 'http'), '">', true);
						?>
					<a class="circle" href="<?php echo $facebook; ?>"><i class="fab fa-facebook-f"></i></a>
					<?php
						$page_title = 'vk';
						$vk_page = get_page_by_title( $page_title);
						$vk = strstr(strstr($vk_page->post_content, 'http'), '">', true);
						?>
					<a class="circle" href="<?php echo $vk; ?>"><i class="fab fa-vk"></i></a>
					<?php
						$page_title = 'instagram';
						$insta_page = get_page_by_title( $page_title);
						$instagram = strstr(strstr($insta_page->post_content, 'http'), '">', true);
						?>
					<a class="circle" href="<?php echo $instagram; ?>" onclick="ym(73524736, 'reachGoal', 'insta'); return true;"><i class="fab fa-instagram"></i></a>
				</div>
				<?php
					$page_title = 'tel';
					$tel_page = get_page_by_title( $page_title);
					// print_r($tel_page);
					$tel = substr(strstr(strstr($tel_page->post_content, '</p>', true), '<p>'), 3);
					// echo strstr(strstr($insta_page->post_content, 'http'), '">', true);
				?>
				<a class="footer-link__tel" href="tel:<?php echo $tel; ?>"><?php echo $tel; ?></a>
				<?php
					$page_title = 'email';
					$email_page = get_page_by_title( $page_title);
					// print_r($email_page);
					$email = substr(strstr(strstr($email_page->post_content, '</p>', true), '<p>'), 3);
				?>
				<a class="footer-link__email" href="mailto:<?php echo $email; ?>?subject=Обращение с сайта Фотопозитив"><?php echo $email; ?></a>
			</div>
		</div>
		<div class="footer-madeby">
			<p>Создание и поддержка ресурса: <a href="https://github.com/boriscom123">#bynextpr</a></p>
		</div>
	</footer>

	<div class="modal d-none">

		<div class="d-none">
			<div class="recover-password">
				<i class="far fa-times-circle close-fp"></i>
				<h2>Восстановить пароль</h2>
				<a href="<?php echo wp_login_url(); ?>">Восстановить пароль</a>
			</div>
		</div>

		<div class="d-none">
			<div class="rules">
				<i class="far fa-times-circle close-rules"></i>
				<?php
					$page_title = 'Правила участия';
					$rules_page = get_page_by_title( $page_title);
					echo $rules_page->post_content;
				?>
			</div>
		</div>

		<div class="d-none">
			<div class="reg-password-form">
				<i class="far fa-times-circle close-fp"></i>
				<h2>Для продолжения регистрации</h2>
				<h2>Введите пароль из СМС</h2>
				<form class="reg-form-password" action="" method="post">
					<input type="password" name="pass" value="" placeholder="Введите пароль" required>
					<input type="submit" name="reg-form-password-submit" value="Отправить">
				</form>
			</div>
		</div>

		<div class="d-none">
			<div class="reg-password-form">
				<i class="far fa-times-circle close-fp"></i>
				<h2>Для продолжения введите номер телефона</h2>
				<p></p>
				<form class="reg-form-password" action="" method="post">
					<input id="input-foget-tel" type="text" name="tel" value="" placeholder="Введите номер телефона" required>
					<button type="button" name="foget-password-submit">Отправить</button>
				</form>
			</div>
		</div>

	</div>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
