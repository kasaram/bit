<?php

defined('BIT') or die;

class AdminController extends AdminBase
{

	public function actionIndex()
	{
		require_once 'config/AdminConfig.php';
		require_once ROOT.'/'.Config::VIEW.'admin/index.php';
		return true;
	}

	public function actionLogin()
	{	
		if (isset($_POST['authSubmit'])) {
			require_once 'config/AdminConfig.php';
			$log = Validate::cleanStr($_POST['adm_log']);
			$pass = Validate::cleanStr($_POST['adm_pass']);
			$result = Admin::loginAdmin($log, $pass);
			$res = !empty($result) ? '' : '/?'.Config::SECRET.'&res=fail_admin_auth';
		} else self::checkAdmin();
		header('Location: '.Config::ADDRESS.'admin'.$res);
	}

	public function actionLogout()
	{
		if(session_status() !== PHP_SESSION_ACTIVE) session_start();
		unset($_SESSION['adm_log']);
		unset($_SESSION['adm_pass']);
		if(empty($_SESSION)) {
			setcookie(session_name(), '', 0);
			session_unset();
			session_destroy();
		}
		header('Location: '.Config::ADDRESS);
	}


	public function actionGame()
	{
		self::checkAdmin();
		if (isset($_POST['default']) || isset($_POST['save'])) {
			$default = isset($_POST['default']) ? true : null;
			$post = array_map(function($v){return Validate::cleanStr($v);}, $_POST);
			$result = Admin::saveConfig($post, $default);
			$res = isset($result) ? 'suc_game_change' : 'fail_game_change';
			header('Location:'.Config::ADDRESS.'admin/game/?res='.$res);
		}
		require_once ROOT.'/'.Config::VIEW.'admin/game.php';
		return true;
	}

	public function actionDesign()
	{
		self::checkAdmin();
		if (isset($_POST['default']) || isset($_POST['save'])) {
			$default = isset($_POST['default']) ? true : null;
			$post = array_map(function($v){return Validate::cleanStr($v);}, $_POST);
			$result = Admin::saveConfig($post, $default);
			$res = isset($result) ? 'suc_design_change' : 'fail_design_change';
			header('Location:'.Config::ADDRESS.'admin/design/?res='.$res);
		}
		require_once ROOT.'/'.Config::VIEW.'admin/design.php';
		return true;
	}

	public function actionService()
	{
		self::checkAdmin();
		if (isset($_POST['default']) || isset($_POST['save'])) {
			$default = isset($_POST['default']) ? true : null;
			$post = array_map(function($v){return Validate::cleanStr($v);}, $_POST);
			$result = Admin::saveConfig($post, $default);
			$res = isset($result) ? 'suc_service_change' : 'fail_service_change';
		} elseif (isset($_POST['saveAdmin'])) {
			require_once ROOT.'/config/AdminConfig.php';
			$post = array_map(function($v){return Validate::cleanStr($v);}, $_POST);
			$result = Admin::saveConfig($post, null, 'AdminConfig', 'config/AdminConfig.php');
			$res = isset($result) ? 'suc_admin_change' : 'fail_admin_change';
		} else {
			require_once ROOT.'/'.Config::VIEW.'admin/service.php';
			return true;
			die();
		}
		header('Location:'.Config::ADDRESS.'admin/service/?res='.$res);
	}

	public function actionPage()
	{
		$listBanners = Banners::getBannersOnSite('rand');
		$listReclama = Reclama::getReclamaOnSite('rand');
		$listVideo = Video::getVideoOnSite('rand');
		require_once ROOT.'/'.Config::VIEW.'admin/page.php';
		return true;
	}


}
