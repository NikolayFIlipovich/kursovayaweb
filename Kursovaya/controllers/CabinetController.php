<?php

class CabinetController
{

	public static function actionIndex()
	{
		$documentsList = Document::getDocumentsList();
		// вызов функции проверки сессии
		$userid = User::checkSession();
		$user = User::getUserById($userid);
		$currentDate = Date::getCurrentDateRu();

		$typeList = DocumentType::getCategoriesList();
		$statusList = DocumentStatus::getCategoriesList();
		$authorList = DocumentAuthor::getCategoriesList();

		// Переменные для формы
		$type_documents = false;
		$status_documents = false;
		$result = false;
		$id = false;

		// Обработка формы добавления CREATE
		if (isset($_POST['submit'])) {
			// Если форма отправлена

			$type_documents = $_POST['type_documents'];
			$status_documents = $_POST['status_documents'];

			$id = Document::documentCreate($type_documents, $status_documents, $userid);


			// Если запись добавлена
			if ($id) {
				// Проверим, загружалось ли через форму изобр ажение
				if (is_uploaded_file($_FILES['file']['tmp_name'])) {
					// Если загружалось, переместим его в нужную папке, дадим новое имя
					move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/documents/{$id}.pdf");
				}
			};

			header("Location: /cabinet");
		}

		$user_filter = false;
		$status_filter = false;
		$type_filter = false;
		$sort_by = false;
		$sort_type = false;

		if (isset($_POST['filter'])) {
			// Если форма отправлена

			$user_filter = $_POST['user_filter'];
			$status_filter = $_POST['status_filter'];
			$type_filter = $_POST['type_filter'];
			$sort_by = $_POST['sort_by'];
			$sort_type = $_POST['sort_type'];


			$documentsList = Document::getDocumentFilter($user_filter, $status_filter, $type_filter, $sort_by, $sort_type);

			// header("Location: /cabinet");
		}


		require_once(ROOT . '/views/cabinet/index.php');
		return true;
	}

	public static function actionDelete($id)
	{
		$userid = User::checkSession();
		$user = User::getUserById($userid);
		$currentDate = Date::getCurrentDateRu();

		if (isset($_POST['submit'])) {
			Document::documentDelete($id);

			header("Location: /cabinet");
		}

		require_once(ROOT . '/views/cabinet/delete.php');
		return true;
	}

	public static function actionShow($id)
	{

		$userid = User::checkSession();
		$user = User::getUserById($userid);
		$currentDate = Date::getCurrentDateRu();

		require_once(ROOT . '/views/cabinet/show.php');
		return true;
	}
}
