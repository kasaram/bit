<?php

defined('BIT') or die;

class AdminController
{

	public function actionIndex()
	{


		require_once ROOT.'/'.Config::VIEW.'admin/index.php';
		return true;
	}


	public function actionGame()
	{
		if (isset($_POST['default']) || isset($_POST['save'])) {
			$default = isset($_POST['default']) ? true : null;
			$result = Admin::saveConfig($_POST, $default);
			$res = isset($result) ? 'suc' : 'fail';
			header('Location:'.Config::ADDRESS.'admin/game/?'.$res);
		}
		require_once ROOT.'/'.Config::VIEW.'admin/game.php';
		return true;
	}

	public function actionUsers()
	{

		require_once ROOT.'/'.Config::VIEW.'admin/users.php';
		return true;
	}

	public function actionReclama()
	{

		require_once ROOT.'/'.Config::VIEW.'admin/reclama.php';
		return true;
	}

	public function actionBanners()
	{
		$listBanners = Banners::getBannersOnAdmin(['DESC', 'id']);

		//удаление баннера
		if(isset($_GET['del']) && !empty($_GET['del'])) {
			$result = Banners::removeBanner($_GET['del']);
			$res = isset($result) ? 'sucDel' : 'failDel';
			header('Location:'.Config::ADDRESS.'admin/banners/?'.$res);
		}

		require_once ROOT.'/'.Config::VIEW.'admin/banners.php';
		return true;
	}

	public function actionDesign()
	{
		if (isset($_POST['default']) || isset($_POST['save'])) {
			$default = isset($_POST['default']) ? true : null;
			$result = Admin::saveConfig($_POST, $default);
			$res = isset($result) ? 'suc' : 'fail';
			header('Location:'.Config::ADDRESS.'admin/design/?'.$res);
		}
		require_once ROOT.'/'.Config::VIEW.'admin/design.php';
		return true;
	}

	public function actionService()
	{
		if (isset($_POST['default']) || isset($_POST['save'])) {
			$default = isset($_POST['default']) ? true : null;
			$result = Admin::saveConfig($_POST, $default);
			$res = isset($result) ? 'suc' : 'fail';
			header('Location:'.Config::ADDRESS.'admin/service/?'.$res);
		}
		require_once ROOT.'/'.Config::VIEW.'admin/service.php';
		return true;
	}


}
