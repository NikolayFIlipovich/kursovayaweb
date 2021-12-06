<?php

class UserController
{


	public function actionLogin()
	{

		// Переменные для формы
		$email = false;
		$password = false;

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Получаем данные из формы для полей email и password

			$email = $_POST['email'];
			$password = $_POST['password'];

			// Флаг ошибки
			$errors = false;

			// Запуск валидации полей				
			if (User::checkEmail($email) == false) {
				$errors[] = 'Неправильный E-mail!';
			}

			if (User::checkPassword($password) == false) {
				$errors[] = 'Неправильный пароль!';
			}

			// Получаем id пользователя, если пользователь не найден получаем
			$userid = User::checkUser($email, $password);

			if ($userid == false) {

				$errors[] = 'Пользователь не существует!';
			} else {

				User::userAuth($userid);

				header("Location: /cabinet");
			}
		}

		require_once(ROOT . '/views/user/login.php');
		return true;
	}

	public function actionRegister()
	{

		// Переменные для формы
		$email = false;
		$password = false;
		$name = false;
		$result = false;


		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Получаем данные из формы для полей email и password

			$email = $_POST['email'];
			$password = $_POST['password'];
			$name = $_POST['name'];


			// Флаг ошибки
			$errors = false;


			// Запуск валидации полей				
			if (User::checkEmail($email) == false) {
				$errors[] = 'Неправильный E-mail!';
			}

			if (User::checkPassword($password) == false) {
				$errors[] = 'Неправильный пароль!';
			}

			if (User::checkName($name) == false) {
				$errors[] = 'Некорректное имя пользователя!';
			}

			if (User::checkEmailRepetition($email) == true) {
				$errors[] = 'Такой E-mail уже существует!';
			}

			// Если ошибок нет - регистрируем
			if ($errors == false) {
				$result = User::userRegister($name, $email, $password);
			}
		}
		require_once(ROOT . '/views/user/register.php');
		return true;
	}

	public static function actionLogout()
	{
		 // Стартуем сессию
		 session_start();
        
		 // Удаляем информацию о пользователе из сессии
		 unset($_SESSION["user"]);
		 
		 // Перенаправляем пользователя на главную страницу
		 header("Location: /");
	}
}
