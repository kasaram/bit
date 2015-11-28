<?php

defined('BIT') or die;

class AdminBannersController
{

	public function actionIndex()
	{
		$listBanners = Banners::getBannersOnAdmin(['DESC', 'id']);
		require_once ROOT.'/'.Config::VIEW.'admin/banners.php';
		return true;
	}

	public function actionCreate()
	{
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
		if (isset($id)) {
			$publish = isset($_POST['publish']) ? '1' : '0';
			$result = Banners::updateStatusBanner($id, $publish);
			$res = isset($result) ? 'sucUpd' : 'failUpd';
		} else $res = 'failUpd';
		header('Location:'.Config::ADDRESS.'admin/banners/?'.$res);
	}

	public function actionDelete($id)
	{
		if(isset($id)) {
			$result = Banners::removeBanner($id);
			$res = isset($result) ? 'sucDel' : 'failDel';
		} else $res = 'failDel';
		header('Location:'.Config::ADDRESS.'admin/banners/?'.$res);
	}


}
