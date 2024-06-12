<?php
	
	$routes = [];

	$controller = '/ForgetPasswordController';
	
	$routes['forget-pw'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'send'   => $controller.'/send',
		'resetPassword' => $controller .'/resetPassword '
	];

	_routeInstance('dashboard', 'Dashboard', $routes);

	_routeInstance('user', 'UserController', $routes, [
		'edit-credentials' => 'editCredentials',
		'profile' => 'profile'
	]);

	_routeInstance('viewer', 'ViewerController', $routes,[
		'delete' => 'delete'
	]);

	_routeInstance('wifi', 'WifiDeviceController', $routes);
	_routeInstance('user-wifi-access', 'UserWifiAccessController', $routes);
	
	$routes['auth'] = [
		'logout' => '/Logout/index',
		'login'  => '/Login/index',
		'submit-login'  => '/Login/punchLogin'
	];
	return $routes;
?>