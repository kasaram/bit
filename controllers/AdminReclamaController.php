<?php
defined('BIT') or die;

class AdminReclamaController extends AdminBase
{
	
	/**
	 * Отображает страницу рекламы для админки
	 */
	public function actionIndex()
	{
		self::checkAdmin();
		$listReclama = Reclama::getReclamaOnAdmin(['DESC', 'id']);
		require_once ROOT.'/'.Config::VIEW.'admin/reclama.php';
		return true;
	}

	/**
	 * Создает рекламу 
	 */
	public function actionCreate()
	{
		self::checkAdmin();
		if(isset($_POST['submit'])) {
			$title = Validate::cleanStr($_POST['title']);
			$descr = htmlspecialchars(Validate::cleanCode($_POST['descr']));
			if(!empty($title) && !empty($descr)) {
				$result = Reclama::addReclama(['title', 'descr', 'pubTime'], [$title, $descr, time()]);
			}
			$res = isset($result) ? 'suc_reclama_create' : 'fail_reclama_create';
		} else $res = 'fail_reclama_create';
		header('Location:'.Config::ADDRESS.'admin/reclama/?res='.$res);
	}

	/**
	 * Обновляет статус рекламы
	 */
	public function actionUpdate($id)
	{
		self::checkAdmin();
		if (isset($id)) {
			$publish = isset($_POST['publish']) ? '1' : '0';
			$result = Reclama::updateStatusReclama($id, $publish);
			$res = isset($result) ? 'suc_reclama_change' : 'fail_reclama_change';
		} else $res = 'fail_reclama_change';
		header('Location:'.Config::ADDRESS.'admin/reclama/?res='.$res);
	}

	/**
	 * Удаляет указанную рекламу
	 */
	public function actionDelete($id)
	{
		self::checkAdmin();
		if(isset($id)) {
			$result = Reclama::removeReclama($id);
			$res = isset($result) ? 'suc_reclama_delete' : 'fail_reclama_delete';
		} else $res = 'fail_reclama_delete';
		header('Location:'.Config::ADDRESS.'admin/reclama/?res='.$res);
	}
}