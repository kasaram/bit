<?php

defined('BIT') or die;

class AdminReclamaController
{
	
	public function actionIndex()
	{
		$listReclama = Reclama::getReclamaOnAdmin(['DESC', 'id']);
		require_once ROOT.'/'.Config::VIEW.'admin/reclama.php';
		return true;
	}

	public function actionCreate()
	{
		if(isset($_POST['submit'])) {
			$title = Validate::cleanStr($_POST['title']);
			$descr = htmlspecialchars($_POST['descr']);
			$result = Reclama::addReclama(['title', 'descr', 'pubTime'], [$title, $descr, time()]);
			$res = isset($result) ? 'sucCrt' : 'failCrt';
		} else $res = 'failCrt';
		header('Location:'.Config::ADDRESS.'admin/reclama/?'.$res);
	}

	public function actionUpdate($id)
	{
		if (isset($id)) {
			$publish = isset($_POST['publish']) ? '1' : '0';
			$result = Reclama::updateStatusReclama($id, $publish);
			$res = isset($result) ? 'sucUpd' : 'failUpd';
		} else $res = 'failUpd';
		header('Location:'.Config::ADDRESS.'admin/reclama/?'.$res);
	}

	public function actionDelete($id)
	{
		if(isset($id)) {
			$result = Reclama::removeReclama($id);
			$res = isset($result) ? 'sucDel' : 'failDel';
		} else $res = 'failDel';
		header('Location:'.Config::ADDRESS.'admin/reclama/?'.$res);
	}


}
