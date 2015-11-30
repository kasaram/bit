<?php

defined('BIT') or die;

class AdminVideoController extends AdminBase
{
	
	public function actionIndex()
	{
		self::checkAdmin();
		$listVideo = Video::getVideoOnAdmin(['DESC', 'id']);
		require_once ROOT.'/'.Config::VIEW.'admin/video.php';
		return true;
	}

	public function actionCreate()
	{
		self::checkAdmin();
		if(isset($_POST['submit'])) {
			$title = Validate::cleanStr($_POST['title']);
			$descr = htmlspecialchars($_POST['descr']);
			$result = Video::addVideo(['title', 'descr', 'pubTime'], [$title, $descr, time()]);
			$res = isset($result) ? 'sucCrt' : 'failCrt';
		} else $res = 'failCrt';
		header('Location:'.Config::ADDRESS.'admin/video/?'.$res);
	}

	public function actionUpdate($id)
	{
		self::checkAdmin();
		if (isset($id)) {
			$publish = isset($_POST['publish']) ? '1' : '0';
			$result = Video::updateStatusVideo($id, $publish);
			$res = isset($result) ? 'sucUpd' : 'failUpd';
		} else $res = 'failUpd';
		header('Location:'.Config::ADDRESS.'admin/video/?'.$res);
	}

	public function actionDelete($id)
	{
		self::checkAdmin();
		if(isset($id)) {
			$result = Video::removeVideo($id);
			$res = isset($result) ? 'sucDel' : 'failDel';
		} else $res = 'failDel';
		header('Location:'.Config::ADDRESS.'admin/video/?'.$res);
	}


}
