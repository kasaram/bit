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
			if(!empty($title) && !empty($descr)) {
				$result = Banners::addBanner(['title', 'descr', 'pubTime'], [$title, $descr, time()]);
			}
			$res = isset($result) ? 'suc_banner_create' : 'fail_banner_create';
		} else $res = 'fail_banner_create';
		header('Location:'.Config::ADDRESS.'admin/banners/?res='.$res);
	}

	public function actionUpdate($id)
	{
		self::checkAdmin();
		if (isset($id)) {
			$publish = isset($_POST['publish']) ? '1' : '0';
			$result = Banners::updateStatusBanner($id, $publish);
			$res = isset($result) ? 'suc_banner_change' : 'fail_banner_change';
		} else $res = 'fail_banner_change';
		header('Location:'.Config::ADDRESS.'admin/banners/?res='.$res);
	}

	public function actionDelete($id)
	{
		self::checkAdmin();
		if(isset($id)) {
			$result = Banners::removeBanner($id);
			$res = isset($result) ? 'suc_banner_delete' : 'fail_banner_delete';
		} else $res = 'fail_banner_delete';
		header('Location:'.Config::ADDRESS.'admin/banners/?res='.$res);
	}

	public function actionAdd()
	{
		self::checkAdmin();
		if (isset($_POST['save']) || isset($_POST['default'])) {
			$default = isset($_POST['default']) ? true : null;
			$post = array_map(function($v){return htmlspecialchars($v);}, $_POST);
			$result = Admin::saveConfig($post, $default);
			$res = isset($result) ? 'suc_banner_instal' : 'fail_banner_instal';
			header('Location:'.Config::ADDRESS.'admin/banners/?res='.$res);
		}
		require_once ROOT.'/'.Config::VIEW.'admin/banners.php';
		return true;
	}


}
