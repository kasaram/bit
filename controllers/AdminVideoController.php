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
			if(!empty($title) && !empty($descr)) {
				$result = Video::addVideo(['title', 'descr', 'pubTime'], [$title, $descr, time()]);
			}
			$res = isset($result) ? 'suc_video_create' : 'fail_video_create';
		} else $res = 'fail_video_create';
		header('Location:'.Config::ADDRESS.'admin/video/?res='.$res);
	}

	public function actionUpdate($id)
	{
		self::checkAdmin();
		if (isset($id)) {
			$publish = isset($_POST['publish']) ? '1' : '0';
			$result = Video::updateStatusVideo($id, $publish);
			$res = isset($result) ? 'suc_video_change' : 'fail_video_change';
		} else $res = 'fail_video_change';
		header('Location:'.Config::ADDRESS.'admin/video/?res='.$res);
	}

	public function actionDelete($id)
	{
		self::checkAdmin();
		if(isset($id)) {
			$result = Video::removeVideo($id);
			$res = isset($result) ? 'suc_video_delete' : 'fail_video_delete';
		} else $res = 'fail_video_delete';
		header('Location:'.Config::ADDRESS.'admin/video/?res='.$res);
	}


}
