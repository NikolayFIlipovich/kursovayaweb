<?php
return array(
	'login' => 'user/login', // actionLogin in UserController
	'register' => 'user/register', // actionRegister in UserController

	'cabinet/document/show/([0-9]+)' => 'cabinet/show/$1',
	'cabinet/document/delete/([0-9]+)' => 'cabinet/delete/$1',
	'cabinet' => 'cabinet/index', // actionIndex in CabinetController
	
	'' => 'site/index', // actionIndex in SiteController
	
	'logout' => 'user/logout', // actionLogout in UserController
);
