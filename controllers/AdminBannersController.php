<?php

defined('BIT') or die;

class AdminBannersController extends AdminBase
{

	public function actionIndex()
	{
		self::checkAdmin();
		$listBanners = Banners::getBannersOnAdmin(['DESC', 'id']);
		require_once ROOT.'/'.Config::VIEW.'admin/banners.php';
		return true;
	}

	public function actionCreate()
	{
		self::checkAdmin();
		if(isset($_POST['submit'])) {
			$title = Validate::cleanStr($_POST['title']);
			$descr = htmlspecialchars($_POST['descr']);
			$result = Banners::addBanner(['title', 'descr', 'pubTime'], [$title, $descr, time()]);
			$res = isset($result) ? 'sucCrt' : 'failCrt';
		} else $res = 'failCrt';
		header('Location:'.Config::ADDRESS.'admin/banners/?'.$res);
	}

	public function actionUpdate($id)
	{
		self::checkAdmin();
		if (isset($id)) {
			$publish = isset($_POST['publish']) ? '1' : '0';
			$result = Banners::updateStatusBanner($id, $publish);
			$res = isset($result) ? 'sucUpd' : 'failUpd';
		} else $res = 'failUpd';
		header('Location:'.Config::ADDRESS.'admin/banners/?'.$res);
	}

	public function actionDelete($id)
	{
		self::checkAdmin();
		if(isset($id)) {
			$result = Banners::removeBanner($id);
			$res = isset($result) ? 'sucDel' : 'failDel';
		} else $res = 'failDel';
		header('Location:'.Config::ADDRESS.'admin/banners/?'.$res);
	}

	public function actionAdd()
	{
		self::checkAdmin();
		if (isset($_POST['save']) || isset($_POST['default'])) {
			$default = isset($_POST['default']) ? true : null;
			$post = array_map(function($v){return htmlspecialchars($v);}, $_POST);
			$result = Admin::saveConfig($post, $default);
			$res = isset($result) ? 'sucAdd' : 'failAdd';
			header('Location:'.Config::ADDRESS.'admin/banners/?'.$res);
		}
		require_once ROOT.'/'.Config::VIEW.'admin/banners.php';
		return true;
	}


}
