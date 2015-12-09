<?php
defined('BIT') or die;

class AdminVideoController extends AdminBase
{
	/**
	 * Отображает страницу видео для админки
	 */
	public function actionIndex()
	{
		self::checkAdmin();
		$listVideo = Video::getVideoOnAdmin(['DESC', 'id']);
		require_once ROOT.'/'.Config::VIEW.'admin/video.php';
		return true;
	}

	/**
	 * Создает новое видео 
	 */
	public function actionCreate()
	{
		self::checkAdmin();
		if(isset($_POST['submit'])) {
			$title = Validate::cleanStr($_POST['title']);
			$descr = Validate::cleanStr($_POST['descr']);
			if(!empty($title) && !empty($descr)) {
				//выбираем код видео из ссылки ютуб
				preg_match('/(http)?s?:?\/\/(www)?\.?[a-zA-z0-9\.]*\/(embed\/)?(watch\?v=)?([a-zA-z0-9-\_]*)/', $descr, $video);
				$result = Video::addVideo(['title', 'descr', 'pubTime'], [$title, $video[5], time()]);
			}
			$res = isset($result) ? 'suc_video_create' : 'fail_video_create';
		} else $res = 'fail_video_create';
		header('Location:'.Config::ADDRESS.'admin/video/?res='.$res);
	}

	/**
	 * Обновляет статус нового видео
	 */
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

	/**
	 * Удаляет указанное видео
	 */
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