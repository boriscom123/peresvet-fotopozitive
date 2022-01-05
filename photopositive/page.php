<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photopositive
 */

get_header();
?>

	<div class="bunner-left" onclick="ym(73524736, 'reachGoal', 'baner'); return true;">
		<div class="bunner-left-content">
			<?php
			$page_title = 'Баннер Слева';
			$bunner_left = get_page_by_title( $page_title );
			//print_r($left_bunner);
			$bunner_left_link = strstr(strstr($bunner_left->post_content, 'http'), '">', true);
			$bunner_left_image = get_the_post_thumbnail_url($bunner_left, 'full');
			//print_r($left_bunner_image);
			//echo $left_bunner_link;
			?>
			<a href="<?php echo $bunner_left_link; ?>" target="_blank"><img src="<?php echo $bunner_left_image; ?>" alt="bunner"></a>
		</div>
		<div class="bunner-left-mini-content">
			<?php
			$page_title = 'Баннер Слева Мини';
			$bunner_left_mini = get_page_by_title( $page_title );
			//print_r($left_bunner);
			$bunner_left_mini_link = strstr(strstr($bunner_left_mini->post_content, 'http'), '">', true);
			$bunner_left_mini_image = get_the_post_thumbnail_url($bunner_left_mini, 'full');
			//print_r($left_bunner_image);
			//echo $left_bunner_link;
			?>
			<a href="<?php echo $bunner_left_mini_link; ?>" target="_blank" class=""><img src="<?php echo $bunner_left_mini_image; ?>" alt="bunner"></a>
		</div>
	</div>

	<div class="bunner-right d-none">
		<div class="bunner-right-content">
			<?php
			$page_title = 'Баннер Справа';
			$bunner_right = get_page_by_title( $page_title );
			//print_r($left_bunner);
			$bunner_right_link = strstr(strstr($bunner_right->post_content, 'http'), '">', true);
			$bunner_right_image = get_the_post_thumbnail_url($bunner_right, 'full');
			//print_r($left_bunner_image);
			//echo $left_bunner_link;
			?>
			<a href="<?php echo $bunner_right_link; ?>" target="_blank"><img src="<?php echo $bunner_right_image; ?>" alt="bunner"></a>
		</div>
		<div class="bunner-right-mini-content">
			<?php
			$page_title = 'Баннер Справа Мини';
			$bunner_right_mini = get_page_by_title( $page_title );
			//print_r($left_bunner);
			$bunner_right_mini_link = strstr(strstr($bunner_right_mini->post_content, 'http'), '">', true);
			$bunner_right_mini_image = get_the_post_thumbnail_url($bunner_right_mini, 'full');
			//print_r($left_bunner_image);
			//echo $left_bunner_link;
			?>
			<a href="<?php echo $bunner_right_mini_link; ?>" target="_blank" class=""><img src="<?php echo $bunner_right_mini_image; ?>" alt="bunner"></a>
		</div>
	</div>

	<div class="bunner">
		<div class="navi-container flex-end">
			<div class="navigation-line step-5"><div class="navigation-line step-6"></div></div>
		</div>
		<div class="bunner-flex">
			<div class="bunner__content">
				<?php
					echo do_shortcode('[supsystic-slider id=2 position="center"]');
					// echo do_shortcode('[nextcodeslider id="1"]'); // видео слайдер
					// echo do_shortcode('[smartslider3 slider="2"]');

					/*<img src="<?php echo get_template_directory_uri(); ?>/assets/image/banner.jpg" alt="Изображение">*/
				?>
			</div>
		</div>
		<div class="navi-container flex-start">
			<div class="navigation-line step-7"><div class="navigation-line step-8"></div></div>
		</div>
	</div>

	<div class="steps">

		<div class="steps__one">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/image/step-1.png" alt="step-1">
			<div>
				<h3>1</h3>
				<div class=""><p>Сделай крутое фото согласно условиям акции</p></div>
			</div>
		</div>

		<div class="navi-container flex-end">
			<div class="navigation-line step-9"><div class="navigation-line step-10"></div></div>
		</div>


		<div class="steps__two">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/image/step-2.png" alt="step-2">
			<div>
				<h3>2</h3>
				<div class=""><p>Загрузи фото на сайт и подпиши креативным комментарием</p></div>
			</div>
		</div>

		<div class="navi-container flex-start">
			<div class="navigation-line step-11"><div class="navigation-line step-12"></div></div>
		</div>

		<div class="steps__three">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/image/step-3.png" alt="step-3">
			<div>
				<h3>3</h3>
				<div class=""><p>Набирай максимальное количество лайков</p></div>
			</div>
		</div>

		<div class="navi-container flex-end">
			<div class="navigation-line step-13"><div class="navigation-line step-14"></div></div>
		</div>

		<div class="steps__four">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/image/step-4.png" alt="step-4">
			<div>
				<h3>4</h3>
				<div class=""><p>Забирай свой приз в <span>50 000</span> рублей!</p></div>
			</div>
		</div>

		<div class="navi-container flex-start">
			<div class="navigation-line step-15"><div class="navigation-line step-16"></div></div>
		</div>


		<div class="steps__five">
			<div class="navi-container flex-end">
				<div class="navigation-line step-17"><div class="navigation-line step-18"></div></div>
			</div>
		</div>

	</div>

	<div class="forms" id="forms">
		<h2 class="forms__title">Получай деньги, следуя за позитивом!</h2>
		<div class="forms-flex">
			<form class="form__reg" action="" method="post">
				<h2>Для регистрации введите номер телефона российского оператора</h2>
				<h3></h3>
				<div class="form__reg_login" title="Используйте только цифры">
					<input id="input-reg-tel" type="text" name="login" value="" placeholder="8 913 504 47 02" required></div>
				<!-- <h3>Введите Ф.И.О.</h3>
				<div class="form__reg_name" title="Используйте русские буквы"><input type="text" name="last-name" value="" placeholder="ФИО (ru)" pattern="^[А-Яа-яЁё\s]+$" required></div> -->
				<p>Регистрируясь, вы соглашаетесь с</p>
				<a href="<?php echo get_template_directory_uri(); ?>/privacy.pdf" target="_blank">Политикой обработки персональных данных</a>
				<h6>
					После нажатия на кнопку на указанный Вами номер телефона поступит смс с паролем для подтверждения регистрации.
				</h6>
				<?php
					// если пользователь залогинен - отправляем на страницу загрузка фотографии
					if ( is_user_logged_in() ) { // проверяем зарегистринованный это пользователь или нет
						echo "<button type='submit' name='go-to-add-foto' form='go-to-add-foto' value='3'>Добавить работу</button>";
					} else {
						echo '<button type="submit" name="reg-submit" id="reg-form-button" onclick="ym(73524736, \'reachGoal\', \'uchastie\'); return true;">Принять участие</button>';
					}
				?>
			</form>
			<div class="form-border"></div>
			<?php
				if ( is_user_logged_in() ) {
					echo "<form class='d-none' action='https://pv-foto.ru/%d0%bb%d0%b8%d1%87%d0%bd%d1%8b%d0%b9-%d0%ba%d0%b0%d0%b1%d0%b8%d0%bd%d0%b5%d1%82/' method='post' id='go-to-add-foto'></form>";
				}
			?>
			<form class="form__login" action="" method="post">
				<h2>Уже зарегистрированы?</h2>
				<div class="" title="Используйте латинские буквы или цифры"><input id="input-login-tel" type="text" name="login" value="" placeholder="Логин - номер телефона" pattern="^[0-9A-Za-z\+\-\(\)]+$" required></div>
				<div class=""><input type="password" name="pass" value="" placeholder="Пароль"></div>
				<p class="foget-password">Забыли пароль?</p>
				<button type="submit" name="login-submit">Войти</button>
			</form>
		</div>
	</div>

	<div class="forms-after-space">
		<div class="navigation-line step-19">
			<div class="navigation-line step-20"></div>
			<div class="navigation-line step-21"></div>
		</div>
		<div class="navigation-line step-22"></div>
	</div>

<?php
/**get_sidebar();*/
get_footer();
